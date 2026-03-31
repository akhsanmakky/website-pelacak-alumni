<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_alumni' => Alumni::count(),
            'terlacak' => Alumni::whereNotNull('pekerjaan')->orWhere('status_karir', '!=', 'Belum Diketahui')->count(),
            'bekerja' => Alumni::where('status_karir', 'Bekerja')->count(),
            'wirausaha' => Alumni::where('status_karir', 'Wirausaha')->count(),
            'studi_lanjut' => Alumni::where('status_karir', 'Studi Lanjut')->count(),
            'belum_diketahui' => Alumni::where('status_karir', 'Belum Diketahui')->count(),
        ];

        $recentAlumni = Alumni::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentAlumni'));
    }
}

