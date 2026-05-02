<?php

namespace App\Services;

class PddiktiService
{
    protected string $baseUrl = 'https://pddikti.fastapicloud.dev/api';
    protected string $universitas = 'Universitas Muhammadiyah Malang';

    public function validateAlumni(string $nama, string $nim): array
    {
        try {
            $query = urlencode("{$nama} {$this->universitas}");
            $url   = "{$this->baseUrl}/search/mhs/{$query}/";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['accept: application/json']);

            $response  = curl_exec($ch);
            $httpCode  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                return [
                    'status'  => 'timeout',
                    'message' => 'Koneksi ke PDDIKTI gagal: ' . $curlError,
                ];
            }

            if ($httpCode !== 200) {
                return [
                    'status'  => 'api_error',
                    'message' => "PDDIKTI mengembalikan HTTP {$httpCode}.",
                ];
            }

            $data = json_decode($response, true);

            // ✅ Response adalah array langsung, bukan { mahasiswa: [...] }
            $mahasiswaList = is_array($data) ? $data : [];

            if (empty($mahasiswaList)) {
                return [
                    'status'  => 'not_found',
                    'message' => "Alumni dengan nama \"{$nama}\" tidak ditemukan di PDDIKTI.",
                ];
            }

            // ✅ Cocokkan NIM — key: "nim", pastikan UMM
            foreach ($mahasiswaList as $mhs) {
                $nimPddikti  = strtolower(trim($mhs['nim'] ?? ''));
                $namaPt      = strtolower(trim($mhs['nama_pt'] ?? ''));

                $isUmm       = str_contains($namaPt, 'muhammadiyah malang');
                $nimCocok    = $nimPddikti === strtolower(trim($nim));

                if ($isUmm && $nimCocok) {
                    return [
                        'status'  => 'verified',
                        'message' => "Alumni \"{$mhs['nama']}\" ({$mhs['nama_prodi']}) berhasil diverifikasi di PDDIKTI.",
                    ];
                }
            }

            // Nama ditemukan tapi NIM / PT tidak cocok
            return [
                'status'  => 'not_found',
                'message' => "Nama \"{$nama}\" ditemukan di PDDIKTI, namun NIM atau universitas tidak cocok.",
            ];

        } catch (\Throwable $e) {
            return [
                'status'  => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }
}