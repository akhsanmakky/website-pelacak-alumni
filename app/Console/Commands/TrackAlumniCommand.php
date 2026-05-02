<?php

namespace App\Console\Commands;

use App\Models\Alumni;
use App\Services\ProfileGeneratorService;
use App\Services\QueryGeneratorService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TrackAlumniCommand extends Command
{
    protected $signature = 'track:alumni {--limit=50 : Max alumni to process} {--test : Dry-run mode}';
    protected $description = 'Run automated alumni tracking job per scheduler (pseudocode steps 1-4)';

    public function handle(ProfileGeneratorService $profileGen, QueryGeneratorService $queryGen): int
    {
        $limit = (int) $this->option('limit');
        $test = $this->option('test');

        $alumni = Alumni::autoReady()->limit($limit)->get();

        $this->info("Found {$alumni->count()} alumni ready for tracking.");

        foreach ($alumni as $alum) {
            $this->info("Processing {$alum->nama} ({$alum->nim})");

            // Step 1: Create/ensure profile
            $profile = $profileGen->createProfile($alum);
            $this->line("  Profile ID: {$profile->id}, status: {$profile->status}");

            // Step 2-4: Generate queries (in job later)
            $queries = $queryGen->generate($profile);
            $this->line("  Generated " . count($queries) . " queries");

            if (!$test) {
                // Dispatch jobs for searches
                foreach (['google', 'scholar'] as $source) {
                    \App\Jobs\PerformSearchJob::dispatch($profile, $queries, $source);
                }
            }

            $profile->update(['status' => 'processing']);
        }

        $this->info('Tracking jobs dispatched!');
        return self::SUCCESS;
    }
}

