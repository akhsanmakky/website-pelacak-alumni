<?php

namespace Database\Seeders;

use App\Models\Alumni;
use App\Models\AlumniTracking;
use Illuminate\Database\Seeder;

class TestTrackingSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🧪 Testing tracking system with 12 alumni records...');

        // Clean test data first
        Alumni::where('nim', 'like', 'TEST%')->delete();
        AlumniTracking::whereHas('alumni', fn($q) => $q->where('nim', 'like', 'TEST%'))->delete();

        $testData = [
            // === Alumni yang SUDAH punya pekerjaan (8 orang) ===
            [
                'nama' => 'Ahmad Fauzi',
                'nim' => 'TEST001',
                'prodi' => 'Teknik Informatika',
                'tahun_lulus' => 2020,
                'email' => 'ahmad.fauzi@test.com',
                'no_hp' => '081234567890',
                'pekerjaan' => 'Software Engineer',
                'perusahaan' => 'PT Google Indonesia',
                'alamat_bekerja' => 'Jl. Sudirman No. 1, Jakarta Selatan',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/ahmadfauzi',
                'instagram' => 'https://instagram.com/ahmadfauzi',
                'facebook' => 'https://facebook.com/ahmadfauzi',
                'tiktok' => 'https://tiktok.com/@ahmadfauzi',
                'company_social' => 'https://linkedin.com/company/google',
            ],
            [
                'nama' => 'Budi Santoso',
                'nim' => 'TEST002',
                'prodi' => 'Manajemen',
                'tahun_lulus' => 2019,
                'email' => 'budi.santoso@test.com',
                'no_hp' => '082345678901',
                'pekerjaan' => 'Manager Keuangan',
                'perusahaan' => 'Bank Mandiri',
                'alamat_bekerja' => 'Jl. MH Thamrin No. 5, Jakarta Pusat',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/budisantoso',
                'instagram' => null,
                'facebook' => 'https://facebook.com/budisantoso',
                'tiktok' => null,
                'company_social' => 'https://linkedin.com/company/bankmandiri',
            ],
            [
                'nama' => 'Citra Lestari',
                'nim' => 'TEST003',
                'prodi' => 'Akuntansi',
                'tahun_lulus' => 2021,
                'email' => 'citra.lestari@test.com',
                'no_hp' => '083456789012',
                'pekerjaan' => 'Auditor',
                'perusahaan' => 'BPK RI',
                'alamat_bekerja' => 'Jl. Gatot Subroto No. 31, Jakarta Selatan',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/citralestari',
                'instagram' => 'https://instagram.com/citralestari',
                'facebook' => null,
                'tiktok' => null,
                'company_social' => null,
            ],
            [
                'nama' => 'Dedi Pratama',
                'nim' => 'TEST004',
                'prodi' => 'Hukum',
                'tahun_lulus' => 2018,
                'email' => 'dedi.pratama@test.com',
                'no_hp' => '084567890123',
                'pekerjaan' => 'Pengacara',
                'perusahaan' => 'Kantor Hukum Pratama & Partners',
                'alamat_bekerja' => 'Jl. Rasuna Said No. 10, Jakarta Selatan',
                'status_karir' => 'Wirausaha',
                'linkedin' => null,
                'instagram' => null,
                'facebook' => null,
                'tiktok' => null,
                'company_social' => null,
            ],
            [
                'nama' => 'Eka Wulandari',
                'nim' => 'TEST005',
                'prodi' => 'Psikologi',
                'tahun_lulus' => 2022,
                'email' => 'eka.wulandari@test.com',
                'no_hp' => '085678901234',
                'pekerjaan' => 'HR Specialist',
                'perusahaan' => 'PT Astra International',
                'alamat_bekerja' => 'Jl. Gaya Motor No. 8, Jakarta Utara',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/ekawulandari',
                'instagram' => 'https://instagram.com/ekawulandari',
                'facebook' => null,
                'tiktok' => 'https://tiktok.com/@ekawulandari',
                'company_social' => 'https://linkedin.com/company/astra',
            ],
            [
                'nama' => 'Fajar Nugroho',
                'nim' => 'TEST006',
                'prodi' => 'Teknik Sipil',
                'tahun_lulus' => 2017,
                'email' => 'fajar.nugroho@test.com',
                'no_hp' => '086789012345',
                'pekerjaan' => 'Site Manager',
                'perusahaan' => 'PT Wijaya Karya',
                'alamat_bekerja' => 'Jl. DI Panjaitan No. 45, Jakarta Timur',
                'status_karir' => 'Bekerja',
                'linkedin' => null,
                'instagram' => null,
                'facebook' => 'https://facebook.com/fajarnugroho',
                'tiktok' => null,
                'company_social' => null,
            ],
            [
                'nama' => 'Gita Maharani',
                'nim' => 'TEST007',
                'prodi' => 'Kedokteran',
                'tahun_lulus' => 2020,
                'email' => 'gita.maharani@test.com',
                'no_hp' => '087890123456',
                'pekerjaan' => 'Dokter Umum',
                'perusahaan' => 'RSUD Dr. Soetomo',
                'alamat_bekerja' => 'Jl. Mayjen Prof. Dr. Moestopo No. 6, Surabaya',
                'status_karir' => 'Bekerja',
                'linkedin' => null,
                'instagram' => 'https://instagram.com/gitamaharani',
                'facebook' => null,
                'tiktok' => null,
                'company_social' => null,
            ],
            [
                'nama' => 'Hendra Wijaya',
                'nim' => 'TEST008',
                'prodi' => 'Teknik Elektro',
                'tahun_lulus' => 2019,
                'email' => 'hendra.wijaya@test.com',
                'no_hp' => '088901234567',
                'pekerjaan' => 'Data Analyst',
                'perusahaan' => 'Shopee Indonesia',
                'alamat_bekerja' => 'Jl. Asia Afrika No. 19, Jakarta Pusat',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/hendrawijaya',
                'instagram' => null,
                'facebook' => null,
                'tiktok' => 'https://tiktok.com/@hendrawijaya',
                'company_social' => 'https://linkedin.com/company/shopee',
            ],

            // === Alumni dengan status STUDI LANJUT (2 orang) ===
            [
                'nama' => 'Indah Permata',
                'nim' => 'TEST009',
                'prodi' => 'Desain Komunikasi Visual',
                'tahun_lulus' => 2021,
                'email' => 'indah.permata@test.com',
                'no_hp' => '089012345678',
                'pekerjaan' => 'Mahasiswa S2',
                'perusahaan' => 'Institut Teknologi Bandung',
                'alamat_bekerja' => 'Jl. Ganesha No. 10, Bandung',
                'status_karir' => 'Studi Lanjut',
                'linkedin' => 'https://linkedin.com/in/indahpermata',
                'instagram' => 'https://instagram.com/indahpermata',
                'facebook' => null,
                'tiktok' => null,
                'company_social' => null,
            ],
            [
                'nama' => 'Joko Susilo',
                'nim' => 'TEST010',
                'prodi' => 'Ilmu Pemerintahan',
                'tahun_lulus' => 2022,
                'email' => 'joko.susilo@test.com',
                'no_hp' => '080123456789',
                'pekerjaan' => 'Mahasiswa S2',
                'perusahaan' => 'Universitas Gadjah Mada',
                'alamat_bekerja' => 'Jl. Bulaksumur No. 1, Yogyakarta',
                'status_karir' => 'Studi Lanjut',
                'linkedin' => null,
                'instagram' => null,
                'facebook' => 'https://facebook.com/jokosusilo',
                'tiktok' => null,
                'company_social' => null,
            ],

            // === Alumni yang BELUM PUNYA PEKERJAAN — untuk testing tracking (2 orang) ===
            [
                'nama' => 'Kirana Dewi',
                'nim' => 'TEST011',
                'prodi' => 'Ilmu Komunikasi',
                'tahun_lulus' => 2024,
                'email' => 'kirana.dewi@test.com',
                'no_hp' => '081112223334',
                'pekerjaan' => null,
                'perusahaan' => null,
                'alamat_bekerja' => null,
                'status_karir' => 'Belum Diketahui',
                'linkedin' => null,
                'instagram' => 'https://instagram.com/kiranadewi',
                'facebook' => null,
                'tiktok' => null,
                'company_social' => null,
            ],
            [
                'nama' => 'Lukman Hakim',
                'nim' => 'TEST012',
                'prodi' => 'Ekonomi Pembangunan',
                'tahun_lulus' => 2024,
                'email' => 'lukman.hakim@test.com',
                'no_hp' => '082223334445',
                'pekerjaan' => null,
                'perusahaan' => null,
                'alamat_bekerja' => null,
                'status_karir' => 'Belum Diketahui',
                'linkedin' => null,
                'instagram' => null,
                'facebook' => 'https://facebook.com/lukmanhakim',
                'tiktok' => 'https://tiktok.com/@lukmanhakim',
                'company_social' => null,
            ],
        ];

        $this->command->info('📥 Inserting 12 test alumni...');
        foreach ($testData as $i => $data) {
            $alumni = Alumni::create(array_merge($data, [
                'pddikti_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
            $tag = $data['status_karir'] === 'Belum Diketahui' ? '⚠️ BELUM BEKERJA' : '✅ ' . $data['status_karir'];
            $this->command->info("  [{$i}+1] {$tag} | {$alumni->nama} ({$alumni->nim})");
        }

        $this->command->newLine();
        $this->command->info('🔄 Simulating updates to test tracking system...');

        // === UPDATE 1: Alumni yang bekerja mendapat kenaikan ===
        $promotions = [
            'TEST001' => [
                'email' => 'ahmad.fauzi.updated@gmail.com',
                'no_hp' => '081111111111',
                'pekerjaan' => 'Senior Software Engineer',
                'perusahaan' => 'PT Google Indonesia (Promoted)',
                'alamat_bekerja' => 'Jl. Sudirman No. 1, Jakarta Selatan (Lantai 25)',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/ahmadfauzi-updated',
                'instagram' => null,
                'facebook' => 'https://facebook.com/ahmadfauzi.new',
                'tiktok' => 'https://tiktok.com/@ahmadfauzi.new',
                'company_social' => 'https://linkedin.com/company/google-indonesia',
            ],
            'TEST002' => [
                'email' => 'budi.santoso.new@mandiri.co.id',
                'no_hp' => '082222222222',
                'pekerjaan' => 'Senior Manager',
                'perusahaan' => 'Bank Mandiri (Kantor Pusat)',
                'alamat_bekerja' => 'Jl. MH Thamrin No. 5, Jakarta Pusat (Gedung Mandiri)',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/budisantoso-senior',
                'instagram' => 'https://instagram.com/budisantoso',
                'facebook' => null,
                'tiktok' => null,
                'company_social' => 'https://linkedin.com/company/bankmandiri',
            ],
        ];

        // === UPDATE 2: Alumni yang AWALNYA tidak bekerja, SEKARANG dapat pekerjaan ===
        $newJobs = [
            'TEST011' => [
                'email' => 'kirana.dewi@gmail.com',
                'no_hp' => '081112223334',
                'pekerjaan' => 'Content Writer',
                'perusahaan' => 'Transmedia',
                'alamat_bekerja' => 'Jl. Kapten Tendean No. 12, Jakarta Selatan',
                'status_karir' => 'Bekerja',
                'linkedin' => 'https://linkedin.com/in/kiranadewi',
                'instagram' => 'https://instagram.com/kiranadewi',
                'facebook' => null,
                'tiktok' => null,
                'company_social' => 'https://linkedin.com/company/transmedia',
            ],
            // TEST012 tetap tidak bekerja
        ];

        $allUpdates = array_merge($promotions, $newJobs);

        foreach ($allUpdates as $nim => $newData) {
            $alumni = Alumni::where('nim', $nim)->first();
            if (!$alumni) continue;

            $isNewJob = ($nim === 'TEST011');
            $label = $isNewJob ? '🎉 NEW JOB!' : '📝 Promotion';
            $this->command->info("  {$label} {$alumni->nama} ({$nim})...");

            $trackFields = [
                'status_karir', 'perusahaan', 'pekerjaan', 'alamat_bekerja',
                'company_social', 'linkedin', 'instagram', 'facebook', 'tiktok',
                'email', 'no_hp',
            ];
            $trackingData = [
                'alumni_id' => $alumni->id,
                'updated_by' => 'System Test',
            ];
            $hasChanges = false;

            foreach ($trackFields as $field) {
                $oldValue = $alumni->$field;
                $newValue = $newData[$field] ?? null;

                if ($oldValue != $newValue) {
                    $hasChanges = true;
                    $trackingData[$field . '_old'] = $oldValue;
                    $trackingData[$field . '_new'] = $newValue;
                }
            }

            if ($hasChanges) {
                AlumniTracking::create($trackingData);
                $this->command->info("     📊 Tracking record created");
            }

            $alumni->update($newData);
        }

        $this->command->newLine();
        $this->command->info('📋 TEST RESULTS:');
        $this->command->info('  Total test alumni: ' . Alumni::where('nim', 'like', 'TEST%')->count());
        $this->command->info('  Total tracking records: ' . AlumniTracking::whereHas('alumni', fn($q) => $q->where('nim', 'like', 'TEST%'))->count());

        // Show summary by status
        $statusSummary = Alumni::where('nim', 'like', 'TEST%')
            ->selectRaw('status_karir, count(*) as total')
            ->groupBy('status_karir')
            ->pluck('total', 'status_karir');

        $this->command->newLine();
        $this->command->info('  📊 Status Karir Summary:');
        foreach ($statusSummary as $status => $count) {
            $this->command->info("     • {$status}: {$count}");
        }

        // Show tracking detail for the "new job" case
        $this->command->newLine();
        $this->command->info('  📌 Tracking for Kirana Dewi (TEST011) — From Unemployed to Employed:');
        $kiranaTrack = AlumniTracking::whereHas('alumni', fn($q) => $q->where('nim', 'TEST011'))->first();
        if ($kiranaTrack) {
            foreach (['status_karir', 'perusahaan', 'pekerjaan'] as $field) {
                $old = $kiranaTrack->{$field . '_old'} ?? 'NULL';
                $new = $kiranaTrack->{$field . '_new'} ?? 'NULL';
                $this->command->info("     • {$field}: \"{$old}\" → \"{$new}\"");
            }
        }

        $this->command->newLine();
        $this->command->info('✅ Tracking test completed successfully!');
    }
}
