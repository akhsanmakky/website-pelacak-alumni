<?php

namespace App\Services;

class ExtractorService
{
    public function extractSignals(string $title, string $snippet, string $url): array
    {
        $signals = [
            'name_match' => 0.0,
            'affiliation' => [],
            'job' => null,
            'location' => null,
            'year_activity' => null,
        ];

        // Simple regex extraction (improve with LLM later)
        if (preg_match('/(UMM|Universitas Muhammadiyah Malang)/i', $title . $snippet)) {
            $signals['affiliation'][] = 'UMM';
        }

        // Extract years
        if (preg_match('/20\d{2}/', $snippet, $matches)) {
            $signals['year_activity'] = (int) $matches[0];
        }

        $signals['score'] = rand(10,90)/100; // Placeholder

        return $signals;
    }
}

