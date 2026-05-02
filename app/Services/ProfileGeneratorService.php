<?php

namespace App\Services;

use App\Models\Alumni;
use App\Models\AlumniProfile;

class ProfileGeneratorService
{
    public function createProfile(Alumni $alumni)
    {
        // Generate variasi nama
        $nameVariations = [
            $alumni->nama,
            $this->shortName($alumni->nama),
            $this->reverseName($alumni->nama),
        ];

        // Generate keyword
        $keywords = [
            'affiliation' => [
                'Universitas Muhammadiyah Malang',
                'UMM',
                'Fakultas ' . $alumni->prodi
            ],
            'prodi' => [$alumni->prodi],
            'year' => $alumni->tahun_lulus,
            'location' => 'Malang'
        ];

        // 🔥 FIX UTAMA DI SINI
        return AlumniProfile::updateOrCreate(
            ['alumni_id' => $alumni->id], // UNIQUE KEY
            [
                'name_variations' => json_encode($nameVariations),
                'keywords' => json_encode($keywords),
                'status' => 'pending'
            ]
        );
    }

    // =========================
    // HELPER
    // =========================
    private function shortName($name)
    {
        $parts = explode(' ', $name);
        if (count($parts) > 1) {
            return substr($parts[0], 0, 1) . '. ' . end($parts);
        }
        return $name;
    }

    private function reverseName($name)
    {
        $parts = explode(' ', $name);
        return implode(' ', array_reverse($parts));
    }
}