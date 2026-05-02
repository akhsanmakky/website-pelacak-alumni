<?php

namespace App\Services;

class ScorerService
{
    public function score(array $signals, array $profileKeywords): float
    {
        $score = 0.0;

        // Name match (highest weight)
        $score += ($signals['name_match'] ?? 0) * 0.4;

        // Affiliation match
        if (isset($signals['affiliation']) && count(array_intersect($signals['affiliation'], $profileKeywords['affiliation'] ?? [])) > 0) {
            $score += 0.3;
        }

        // Timeline close to graduation year
        if (isset($signals['year_activity']) && abs($signals['year_activity'] - ($profileKeywords['year'] ?? 0)) <= 10) {
            $score += 0.2;
        }

        return min(1.0, $score);
    }

    public function disambiguate(array $candidates): array
    {
        // Group & select top by score
        uasort($candidates, fn($a, $b) => $b['score'] <=> $a['score']);
        return array_slice($candidates, 0, 5, true);
    }
}

