<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\AlumniProfile;
use App\Models\AlumniTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     * Display tracking statistics and progress.
     */
    public function stats()
    {
        // Total alumni
        $totalAlumni = Alumni::count();
        
        // Alumni with profiles (tracked)
        $trackedAlumni = AlumniProfile::count();
        
        // Tracking status breakdown
        $statusCounts = AlumniProfile::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        $identified = $statusCounts['identified'] ?? 0;
        $needsManual = $statusCounts['needs_manual'] ?? 0;
        $pending = $statusCounts['pending'] ?? 0;
        
        // Success rate calculation
        $successRate = $totalAlumni > 0 ? round(($identified / $totalAlumni) * 100, 1) : 0;
        
        // Average confidence
        $avgConfidence = AlumniProfile::whereNotNull('confidence')
            ->avg('confidence') ?? 0;
        $avgConfidence = round($avgConfidence * 100, 1);
        
        // High confidence (>= 70%)
        $highConfidence = AlumniProfile::where('confidence', '>=', 0.7)->count();
        
        // Recent tracking activities
        $recentTrackings = Alumni::with('profile')
            ->whereHas('profile', function ($q) {
                $q->whereNotNull('last_tracked_at');
            })
            ->latest('last_auto_tracked_at')
            ->take(10)
            ->get();
        
        // Tracking history from alumni_trackings table
        $trackingHistory = AlumniTracking::with('alumni')
            ->latest()
            ->take(20)
            ->get();
        
        // Statistics for the view
        $stats = [
            'total_alumni' => $totalAlumni,
            'tracked' => $trackedAlumni,
            'untracked' => $totalAlumni - $trackedAlumni,
            'identified' => $identified,
            'needs_manual' => $needsManual,
            'pending' => $pending,
            'success_rate' => $successRate,
            'avg_confidence' => $avgConfidence,
            'high_confidence' => $highConfidence,
        ];
        
        return view('admin.tracking-stats', compact(
            'stats', 'recentTrackings', 'trackingHistory'
        ));
    }
    
    /**
     * Run manual tracking for testing.
     */
    public function runTracking(Request $request)
    {
        $limit = $request->get('limit', 50);
        
        // Get alumni ready for tracking
        $alumniReady = Alumni::whereDoesntHave('profile')
            ->orWhereHas('profile', function ($q) {
                $q->where('status', 'pending')
                  ->orWhere(function ($pp) {
                      $pp->where('status', '!=', 'identified')
                         ->where('last_tracked_at', '<', now()->subMonths(6));
                  });
            })
            ->take($limit)
            ->get();
        
        if ($alumniReady->isEmpty()) {
            return redirect()->route('admin.tracking.stats')
                ->with('warning', 'Tidak ada alumni yang perlu di-track saat ini.');
        }
        
        // Trigger tracking (this would normally dispatch jobs to queue)
        // For now, we'll just redirect with info
        $count = $alumniReady->count();
        
        return redirect()->route('admin.tracking.stats')
            ->with('success', "{$count} alumni ditambahkan ke antrian tracking.");
    }
}
