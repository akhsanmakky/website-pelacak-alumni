<?php

namespace Database\Factories;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni>
 */
class AlumniFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Alumni::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstNamesMale = ['Budi', 'Ahmad', 'Muhammad', 'Sutrisno', 'Agus', 'Hendra', 'Joko', 'Eko', 'Dedi', 'Fajar'];
        $firstNamesFemale = ['Siti', 'Nur', 'Dewi', 'Sri', 'Ani', 'Rina', 'Lina', 'Maya', 'Fitri', 'Yuni'];
        $lastNames = ['Santoso', 'Widodo', 'Prabowo', 'Setiawan', 'Wibowo', 'Susanto', 'Rahayu', 'Nurhayati', 'Sari', 'Putri'];

        $gender = fake()->randomElement(['male', 'female']);
        $firstName = $gender === 'male' ? fake()->randomElement($firstNamesMale) : fake()->randomElement($firstNamesFemale);
        $fullName = $firstName . ' ' . fake()->randomElement($lastNames);

        $prodiList = ['Informatika', 'Sistem Informasi', 'Teknik Komputer'];
        $prodiCode = ['IF', 'SI', 'TK'];
        $prodiIndex = fake()->numberBetween(0, 2);
        $nim = '20' . $prodiCode[$prodiIndex] . fake()->numberBetween(1001, 1999);

        return [
            'nama' => $fullName,
            'nim' => $nim,
            'prodi' => $prodiList[$prodiIndex],
            'tahun_lulus' => fake()->numberBetween(2020, 2025),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => '08' . fake()->numerify('#########'),
            'pekerjaan' => fake()->jobTitle(),
            'perusahaan' => fake()->company(),
            'status_karir' => fake()->randomElement(['Bekerja', 'Wirausaha', 'Studi Lanjut', 'Belum Diketahui']),
        ];
    }
}
