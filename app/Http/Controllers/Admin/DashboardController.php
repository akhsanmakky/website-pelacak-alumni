<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            // Main stats
            'total'           => Alumni::count(),
            'bekerja'         => Alumni::bekerja()->count(),
            'wirausaha'       => Alumni::wirausaha()->count(),
            'studi_lanjut'    => Alumni::studiLanjut()->count(),
            'belum_diketahui' => Alumni::belumDiketahui()->count(),

            // Auto-tracking stats (exact task labels)
            'teridentifikasi'     => Alumni::autoIdentified()->count(),
            'perlu_verifikasi'    => Alumni::autoNeedsManual()->count(),
            'belum_ditemukan'     => Alumni::autoReady()->count(),
            'tidak_valid'         => Alumni::whereNotNull('pddikti_status')
                                             ->where('pddikti_status', '!=', 'verified')
                                             ->count(),

            'auto_ready'      => Alumni::autoReady()->count(),
            'auto_identified' => Alumni::autoIdentified()->count(),
            'auto_needs_manual' => Alumni::autoNeedsManual()->count(),

            // PDDIKTI stats
            'pddikti_total'    => Alumni::count(),
            'pddikti_verified' => Alumni::where('pddikti_status', 'verified')->count(),
            'pddikti_notfound' => Alumni::where('pddikti_status', 'not_found')->count(),
            'pddikti_pending'  => Alumni::where(function ($q) {
                $q->whereNull('pddikti_status')
                  ->orWhere('pddikti_status', 'pending')
                  ->orWhere('pddikti_status', 'error');
            })->count(),
        ];

        $recentAlumni = Alumni::latest()->take(5)->get();

        // Alumni yang belum punya pekerjaan (untuk highlight tracking)
        $unemployedAlumni = Alumni::belumDiketahui()->latest()->take(5)->get();

        // Alumni yang perlu divalidasi (belum verified)
        $alumniNeedValidation = Alumni::where(function ($q) {
            $q->whereNull('pddikti_status')
              ->orWhere('pddikti_status', '!=', 'verified');
        })->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'recentAlumni', 'unemployedAlumni', 'alumniNeedValidation'
        ));
    }
}
