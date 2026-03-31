<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PddiktiService
{
    private $baseUrl = 'https://api.data.utdi.kemdikbud.go.id'; // Contoh endpoint PDDIKTI

    public function validateAlumni($nim)
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/v2/mahasiswa/nim/{$nim}");

            if ($response->successful()) {
                $data = $response->json();
                
                // Assume response structure: nama, prodi, tahun_lulus etc.
                return [
                    'status' => 'verified',
                    'data' => $data,
                    'message' => 'Alumni verified from PDDIKTI.'
                ];
            } elseif ($response->status() == 404) {
                return [
                    'status' => 'not_found',
                    'data' => null,
                    'message' => 'NIM not found in PDDIKTI.'
                ];
            } else {
                return [
                    'status' => 'error',
                    'data' => null,
                    'message' => 'API error: ' . $response->status()
                ];
            }
        } catch (\Exception $e) {
            Log::error('PDDIKTI API error: ' . $e->getMessage());
            return [
                'status' => 'error',
                'data' => null,
                'message' => 'Connection error.'
            ];
        }
    }
}
