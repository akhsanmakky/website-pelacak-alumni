<?php

namespace App\Services;

use App\Models\AlumniProfile;

class QueryGeneratorService
{
    public function generate(AlumniProfile $profile): array
    {
        $queries = [];
        foreach ($profile->name_variations as $name) {
            $queries[] = "\"{$name}\" \"Universitas Muhammadiyah Malang\"";
            $queries[] = "\"{$name}\" UMM";
            $queries[] = "\"{$name}\" \"{$profile->keywords['prodi'][0]}\"";
        }

        // Site specific
        $queries[] = $profile->name_variations[0] . ' site:scholar.google.com';
        $queries[] = $profile->name_variations[0] . ' ORCID';

        return array_slice(array_unique($queries), 0, 10);
    }
}

