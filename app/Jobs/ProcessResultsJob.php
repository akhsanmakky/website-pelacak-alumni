<?php

namespace App\Jobs;

use App\Models\SearchJob;
use App\Services\ExtractorService;
use App\Services\ScorerService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessResultsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public SearchJob $job) {}

    public function handle(ExtractorService $extractor, ScorerService $scorer): void
    {
        $results = [];
        foreach ($this->job->results as $raw) {
            $signals = $extractor->extractSignals($raw['title'], $raw['snippet'], $raw['link']);
            $signals['score'] = $scorer->score($signals, $this->job->profile->keywords);
            
            $result = $this->job->results()->create([
                'title' => $raw['title'],
                'url' => $raw['link'],
                'snippet' => $raw['snippet'],
                'signals' => $signals,
                'score' => $signals['score'],
                'is_match' => $signals['score'] > 0.5,
            ]);

            $results[] = $result;
        }

        // Top candidates
        $top = $scorer->disambiguate(collect($results)->map(fn($r) => ['score' => $r->score, 'signals' => $r->signals])->toArray());

        UpdateProfileJob::dispatch($this->job->profile, $top);
    }
}

