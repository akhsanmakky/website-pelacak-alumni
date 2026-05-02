<?php

namespace App\Jobs;

use App\Models\AlumniProfile;
use App\Models\AlumniTracking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UpdateProfileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public AlumniProfile $profile,
        public array $topCandidates
    ) {}

    public function handle(): void
    {
        $maxScore = max(array_column($this->topCandidates, 'score') ?? [0]);
        
        if ($maxScore >= 0.8) {
            $this->profile->update([
                'status' => 'identified',
                'confidence' => $maxScore,
                'last_tracked_at' => now(),
            ]);
            $this->profile->alumni->update([
                'auto_tracking_status' => 'identified',
                'auto_confidence' => $maxScore,
                'last_auto_tracked_at' => now(),
            ]);
        } elseif ($maxScore >= 0.5) {
            $this->profile->update([
                'status' => 'needs_manual',
                'confidence' => $maxScore,
                'last_tracked_at' => now(),
            ]);
            $this->profile->alumni->update([
                'auto_tracking_status' => 'needs_manual',
                'auto_confidence' => $maxScore,
                'last_auto_tracked_at' => now(),
            ]);
        } else {
            $this->profile->update([
                'status' => 'not_found',
                'confidence' => $maxScore,
                'last_tracked_at' => now(),
            ]);
        }

        // Log as tracking record (auto source)
        AlumniTracking::create([
            'alumni_id' => $this->profile->alumni_id,
            'status_karir_old' => null, // Auto discovery
            'status_karir_new' => 'Auto: ' . $this->profile->status,
            'updated_by' => 'AutoTracking System',
        ]);
    }
}

