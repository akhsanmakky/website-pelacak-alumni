<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Services\ProfileGeneratorService;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function run(Request $request)
    {
        $validated = $request->validate([
            'alumni_ids' => 'required|array|min:1',
            'alumni_ids.*' => 'exists:alumni,id'
        ]);

        $alumniIds = $validated['alumni_ids'];

        // 🔥 FIX: Defensive array check - convert string to array if needed
        if (is_string($alumniIds)) {
            $alumniIds = array_filter(explode(',', $alumniIds));
        }
        if (!is_array($alumniIds) || empty($alumniIds)) {
            throw new \InvalidArgumentException('alumni_ids must be a non-empty array');
        }

        foreach ($alumniIds as $id) {
            $alumni = Alumni::find($id);
            app(ProfileGeneratorService::class)->createProfile($alumni);
        }

        \Artisan::call('track:alumni', ['--limit' => count($alumniIds)]);

        return response()->json([
            'success' => true, 
            'message' => 'Tracking jobs dispatched for ' . count($alumniIds) . ' alumni'
        ]);
    }

    public function result($alumni_id)
    {
        $alumni = Alumni::with(['profile.searchJobs.results', 'trackings'])->findOrFail($alumni_id);
        return $alumni;
    }
}

