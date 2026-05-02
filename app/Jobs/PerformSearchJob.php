<?php

namespace App\Jobs;

use App\Models\AlumniProfile;
use App\Services\QueryGeneratorService;
use App\Services\SearchService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class PerformSearchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public AlumniProfile $profile,
        public array $queries,
        public string $source
    ) {}

    public function handle(SearchService $search): void
    {
        $job = $this->profile->searchJobs()->create([
            'query' => implode(' OR ', $this->queries),
            'source' => $this->source,
            'status' => 'running',
        ]);

        $results = $search->search($job->query, $this->source);

        $job->update([
            'status' => 'completed',
            'results' => $results,
        ]);

        // Dispatch next
        ProcessResultsJob::dispatch($job);
    }
}

