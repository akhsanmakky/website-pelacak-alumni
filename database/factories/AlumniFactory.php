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

        // Realistic distribution: ~25% no job, 10% studi lanjut, 15% wirausaha, 50% bekerja
        $status = fake()->randomElement([
            'Bekerja', 'Bekerja', 'Bekerja', 'Bekerja', 'Bekerja',
            'Wirausaha', 'Wirausaha', 'Wirausaha',
            'Studi Lanjut', 'Studi Lanjut',
            'Belum Diketahui', 'Belum Diketahui', 'Belum Diketahui',
        ]);

        $pekerjaan = null;
        $perusahaan = null;

        if ($status === 'Bekerja') {
            $pekerjaan = fake()->jobTitle();
            $perusahaan = fake()->company();
        } elseif ($status === 'Wirausaha') {
            $pekerjaan = fake()->randomElement(['Owner', 'Founder', 'Pengusaha', 'Freelancer']);
            $perusahaan = fake()->randomElement(['UD. ' . fake()->lastName(), 'PT ' . fake()->company(), 'Self-Employed']);
        } elseif ($status === 'Studi Lanjut') {
            $pekerjaan = fake()->randomElement(['Mahasiswa S2', 'Mahasiswa S3', 'Research Assistant']);
            $perusahaan = fake()->randomElement(['Universitas Indonesia', 'ITB', 'UGM', 'Universitas Airlangga']);
        }

        return [
            'nama' => $fullName,
            'nim' => $nim,
            'prodi' => $prodiList[$prodiIndex],
            'tahun_lulus' => fake()->numberBetween(2020, 2025),
            'email' => fake()->unique()->safeEmail(),
            'no_hp' => '08' . fake()->numerify('#########'),
            'pekerjaan' => $pekerjaan,
            'perusahaan' => $perusahaan,
            'status_karir' => $status,
        ];
    }

    /**
     * State for alumni without a job.
     */
    public function unemployed(): static
    {
        return $this->state(fn (array $attributes) => [
            'pekerjaan' => null,
            'perusahaan' => null,
            'status_karir' => 'Belum Diketahui',
        ]);
    }

    /**
     * State for alumni currently working.
     */
    public function working(): static
    {
        return $this->state(fn (array $attributes) => [
            'pekerjaan' => fake()->jobTitle(),
            'perusahaan' => fake()->company(),
            'status_karir' => 'Bekerja',
        ]);
    }

    /**
     * State for alumni pursuing further studies.
     */
    public function studying(): static
    {
        return $this->state(fn (array $attributes) => [
            'pekerjaan' => 'Mahasiswa S2',
            'perusahaan' => fake()->randomElement(['Universitas Indonesia', 'ITB', 'UGM']),
            'status_karir' => 'Studi Lanjut',
        ]);
    }
}
