<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;

class StatsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $stats = [
            'total' => Alumni::count(),
            'pns' => Alumni::pns()->count(),
            'swasta' => Alumni::swasta()->count(),
            'wirausaha' => Alumni::wirausaha()->count(),
            'studi_lanjut' => Alumni::where('status_karir', 'Studi Lanjut')->count(),
            'belum_diketahui' => Alumni::where('status_karir', 'Belum Diketahui')->count(),
        ];

        return response()->json($stats);
    }
}
