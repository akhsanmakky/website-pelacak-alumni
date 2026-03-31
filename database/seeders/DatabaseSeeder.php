<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@alumni.com',
            'password' => Hash::make('admin123'),
        ]);

        // $this->call([
            //     AlumniSeeder::class,
            // ]);
    }
}
