<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Seeder;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        Alumni::factory(20)->create([
'tahun_lulus' => fake()->numberBetween(2020, 2025),
            'status_karir' => fake()->randomElement(['Bekerja', 'Wirausaha', 'Studi Lanjut', 'Belum Diketahui']),
        ]);
    }
}

