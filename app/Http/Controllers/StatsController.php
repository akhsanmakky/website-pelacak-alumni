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
            'bekerja' => Alumni::bekerja()->count(),
            'wirausaha' => Alumni::wirausaha()->count(),
            'studi_lanjut' => Alumni::studiLanjut()->count(),
            'belum_diketahui' => Alumni::belumDiketahui()->count(),
        ];

        return response()->json($stats);
    }
}
