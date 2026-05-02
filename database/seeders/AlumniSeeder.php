<?php

namespace Database\Seeders;

use App\Models\Alumni;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AlumniSeeder extends Seeder
{
    /**
     * Mapping realistis pekerjaan berdasarkan prodi.
     */
    private array $prodiJobMap = [
        // Teknik & IT
        'Teknik Informatika' => [
            ['pekerjaan' => 'Software Engineer', 'perusahaan' => 'PT Tokopedia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Data Analyst', 'perusahaan' => 'Shopee Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'IT Consultant', 'perusahaan' => 'Deloitte Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'System Administrator', 'perusahaan' => 'Bank Central Asia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Mobile App Developer', 'perusahaan' => 'Gojek', 'status' => 'Bekerja'],
        ],
        'Sistem Informasi' => [
            ['pekerjaan' => 'Business Analyst', 'perusahaan' => 'PT Astra International', 'status' => 'Bekerja'],
            ['pekerjaan' => 'ERP Specialist', 'perusahaan' => 'SAP Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'IT Project Manager', 'perusahaan' => 'Telkom Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Data Engineer', 'perusahaan' => 'Grab Indonesia', 'status' => 'Bekerja'],
        ],
        'Teknik Komputer' => [
            ['pekerjaan' => 'Network Engineer', 'perusahaan' => 'Cisco Systems Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Hardware Engineer', 'perusahaan' => 'PT Samsung Electronics', 'status' => 'Bekerja'],
            ['pekerjaan' => 'IoT Developer', 'perusahaan' => 'PT Schneider Electric', 'status' => 'Bekerja'],
        ],
        'Informatika' => [
            ['pekerjaan' => 'Backend Developer', 'perusahaan' => 'Bukalapak', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Frontend Developer', 'perusahaan' => 'Traveloka', 'status' => 'Bekerja'],
            ['pekerjaan' => 'DevOps Engineer', 'perusahaan' => 'PT Microsoft Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'AI Engineer', 'perusahaan' => 'Nodeflux', 'status' => 'Bekerja'],
        ],

        // Ekonomi & Bisnis
        'Akuntansi' => [
            ['pekerjaan' => 'Auditor', 'perusahaan' => 'KAP PricewaterhouseCoopers', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Staff Keuangan', 'perusahaan' => 'Bank Mandiri', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Tax Consultant', 'perusahaan' => 'KAP Ernst & Young', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Financial Analyst', 'perusahaan' => 'Bank Central Asia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Accountant', 'perusahaan' => 'PT Pertamina', 'status' => 'Bekerja'],
        ],
        'Manajemen' => [
            ['pekerjaan' => 'Marketing Manager', 'perusahaan' => 'Unilever Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'HR Specialist', 'perusahaan' => 'PT Astra International', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Operations Manager', 'perusahaan' => 'Indofood CBP', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Business Development', 'perusahaan' => 'Sea Limited (Shopee)', 'status' => 'Bekerja'],
        ],
        'Ekonomi Pembangunan' => [
            ['pekerjaan' => 'Economic Researcher', 'perusahaan' => 'Bank Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Policy Analyst', 'perusahaan' => 'Bappenas', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Investment Analyst', 'perusahaan' => 'Mandiri Sekuritas', 'status' => 'Bekerja'],
        ],

        // Hukum
        'Hukum' => [
            ['pekerjaan' => 'Associate Lawyer', 'perusahaan' => 'HHP Law Firm', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Legal Counsel', 'perusahaan' => 'PT Freeport Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Notary Assistant', 'perusahaan' => 'Kantor Notaris & PPAT', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Compliance Officer', 'perusahaan' => 'Otoritas Jasa Keuangan', 'status' => 'Bekerja'],
        ],
        'Ilmu Hukum' => [
            ['pekerjaan' => 'Pengacara', 'perusahaan' => 'Kantor Hukum Pratama & Partners', 'status' => 'Wirausaha'],
            ['pekerjaan' => 'Legal Researcher', 'perusahaan' => 'Mahkamah Konstitusi RI', 'status' => 'Bekerja'],
        ],

        // Kedokteran & Kesehatan
        'Kedokteran' => [
            ['pekerjaan' => 'Dokter Umum', 'perusahaan' => 'RSUD Dr. Soetomo', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Dokter Spesialis Jantung', 'perusahaan' => 'RS Siloam Hospitals', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Dokter Gigi', 'perusahaan' => 'Klinik Dental Care', 'status' => 'Bekerja'],
        ],
        'Keperawatan' => [
            ['pekerjaan' => 'Perawat Senior', 'perusahaan' => 'RS Pondok Indah', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Case Manager', 'perusahaan' => 'Mayapada Hospital', 'status' => 'Bekerja'],
        ],
        'Farmasi' => [
            ['pekerjaan' => 'Apoteker', 'perusahaan' => 'Kimia Farma', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Quality Control Analyst', 'perusahaan' => 'PT Kalbe Farma', 'status' => 'Bekerja'],
        ],

        // Teknik Sipil & Arsitektur
        'Teknik Sipil' => [
            ['pekerjaan' => 'Site Engineer', 'perusahaan' => 'PT Wijaya Karya', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Structural Engineer', 'perusahaan' => 'PT Adhi Karya', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Project Manager', 'perusahaan' => 'PT PP (Pembangunan Perumahan)', 'status' => 'Bekerja'],
        ],
        'Arsitektur' => [
            ['pekerjaan' => 'Junior Architect', 'perusahaan' => 'PT Airmas Asri', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Interior Designer', 'perusahaan' => 'PT Duta Cermat Mandiri', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Urban Planner', 'perusahaan' => 'Kementerian PUPR', 'status' => 'Bekerja'],
        ],

        // Pendidikan
        'Pendidikan Bahasa Inggris' => [
            ['pekerjaan' => 'English Teacher', 'perusahaan' => 'SMA Negeri 1 Jakarta', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Content Writer', 'perusahaan' => 'EF English First', 'status' => 'Bekerja'],
            ['pekerjaan' => 'IELTS Trainer', 'perusahaan' => 'The British Institute', 'status' => 'Bekerja'],
        ],
        'Pendidikan Matematika' => [
            ['pekerjaan' => 'Mathematics Teacher', 'perusahaan' => 'SMA Labschool Jakarta', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Data Scientist', 'perusahaan' => 'Gojek', 'status' => 'Bekerja'],
        ],

        // Psikologi
        'Psikologi' => [
            ['pekerjaan' => 'HR Specialist', 'perusahaan' => 'PT Astra International', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Clinical Psychologist', 'perusahaan' => 'Rumah Sakit Jiwa', 'status' => 'Bekerja'],
            ['pekerjaan' => 'UX Researcher', 'perusahaan' => 'Tokopedia', 'status' => 'Bekerja'],
        ],

        // Komunikasi
        'Ilmu Komunikasi' => [
            ['pekerjaan' => 'Public Relations', 'perusahaan' => 'Transmedia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Content Creator', 'perusahaan' => 'Vidio.com', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Social Media Manager', 'perusahaan' => 'Net Mediatama', 'status' => 'Bekerja'],
        ],
        'Desain Komunikasi Visual' => [
            ['pekerjaan' => 'UI/UX Designer', 'perusahaan' => 'Tokopedia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Graphic Designer', 'perusahaan' => 'Pixelio Studio', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Creative Director', 'perusahaan' => 'Dentsu Indonesia', 'status' => 'Bekerja'],
        ],

        // Pemerintahan & Sosial
        'Ilmu Pemerintahan' => [
            ['pekerjaan' => 'Staff Administrasi', 'perusahaan' => 'Kementerian Dalam Negeri', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Policy Analyst', 'perusahaan' => 'Bappenas', 'status' => 'Bekerja'],
        ],
        'Hubungan Internasional' => [
            ['pekerjaan' => 'Diplomat', 'perusahaan' => 'Kementerian Luar Negeri', 'status' => 'Bekerja'],
            ['pekerjaan' => 'International Relations Officer', 'perusahaan' => 'Kemlu RI', 'status' => 'Bekerja'],
        ],
        'Sosiologi' => [
            ['pekerjaan' => 'Researcher', 'perusahaan' => 'LIPI (Lembaga Ilmu Pengetahuan Indonesia)', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Community Development', 'perusahaan' => 'UNDP Indonesia', 'status' => 'Bekerja'],
        ],

        // Pertanian & Kehutanan
        'Agroteknologi' => [
            ['pekerjaan' => 'Agronomist', 'perusahaan' => 'PT Syngenta Indonesia', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Research Officer', 'perusahaan' => 'Balai Penelitian Pertanian', 'status' => 'Bekerja'],
        ],

        // Default fallback
        'DEFAULT' => [
            ['pekerjaan' => 'Staff Administrasi', 'perusahaan' => 'PT Indonesia Sejahtera', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Manager', 'perusahaan' => 'PT Nusantara Sakti', 'status' => 'Bekerja'],
            ['pekerjaan' => 'Supervisor', 'perusahaan' => 'PT Maju Bersama', 'status' => 'Bekerja'],
        ],
    ];

    /**
     * Perusahaan umum untuk status Wirausaha.
     */
    private array $wirausahaJobs = [
        ['pekerjaan' => 'Owner', 'perusahaan' => 'UD. Sukses Abadi'],
        ['pekerjaan' => 'Founder & CEO', 'perusahaan' => 'Startup Tech Indonesia'],
        ['pekerjaan' => 'Pengusaha', 'perusahaan' => 'Catering & Resto Keluarga'],
        ['pekerjaan' => 'Consultant', 'perusahaan' => 'Konsultan Mandiri'],
        ['pekerjaan' => 'Freelancer', 'perusahaan' => 'Self-Employed'],
    ];

    /**
     * Universitas tujuan studi lanjut.
     */
    private array $studiLanjutJobs = [
        ['pekerjaan' => 'Mahasiswa S2', 'perusahaan' => 'Universitas Indonesia'],
        ['pekerjaan' => 'Mahasiswa S2', 'perusahaan' => 'Institut Teknologi Bandung'],
        ['pekerjaan' => 'Mahasiswa S3', 'perusahaan' => 'Universitas Gadjah Mada'],
        ['pekerjaan' => 'Mahasiswa S2', 'perusahaan' => 'Universitas Airlangga'],
        ['pekerjaan' => 'Mahasiswa S2', 'perusahaan' => 'London School of Economics'],
    ];

    /**
     * Perusahaan umum untuk pekerjaan.
     */
    private array $generalCompanies = [
        'PT Pertamina',
        'Bank Rakyat Indonesia',
        'PT Telkom Indonesia',
        'PT PLN (Persero)',
        'PT Indofood CBP Sukses Makmur',
        'PT Unilever Indonesia',
        'PT Mayora Indah',
        'PT Sinar Mas',
    ];

    public function run(): void
    {
        $csvPath = storage_path('app/alumni_real.csv');

        if (!file_exists($csvPath)) {
            $this->command->error("CSV tidak ditemukan di: {$csvPath}");
            return;
        }

        $handle = fopen($csvPath, 'r');
        if (!$handle) {
            $this->command->error("Gagal membuka CSV!");
            return;
        }

        // Disable FK checks and truncate for fresh import
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Alumni::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info("🔄 Membaca CSV...");

        $rowNum = 0;
        $skipped = 0;
        $uniqueMap = []; // deduplicate by NIM (keep last occurrence)

        while (($row = fgetcsv($handle, 0, ',')) !== false) {
            $rowNum++;

            // Skip completely empty lines
            if (count($row) === 1 && trim($row[0]) === '') {
                $skipped++;
                continue;
            }

            // Fix rows with embedded commas: if columns > 6, merge extra into prodi (last col)
            // If columns < 6, pad with nulls
            if (count($row) > 6) {
                $extra = array_slice($row, 5);
                $row = array_slice($row, 0, 5);
                $row[] = implode(',', $extra);
            } elseif (count($row) < 6) {
                $row = array_pad($row, 6, null);
            }

            $nama = trim($row[0] ?? '');
            $nim = trim($row[1] ?? '');
            $angkatan = trim($row[2] ?? '');
            $tanggalLulus = trim($row[3] ?? '');
            $fakultas = trim($row[4] ?? '');
            $prodi = trim($row[5] ?? '');

            // Clean up quoted names
            $nama = trim($nama, '"');
            $nim = trim($nim, '"');
            $prodi = trim($prodi, '"');
            $fakultas = trim($fakultas, '"');
            $tanggalLulus = trim($tanggalLulus, '"');

            // Validate required fields
            if (empty($nama) || empty($nim)) {
                $skipped++;
                continue;
            }

            // Sanitize NIM
            $nimSanitized = preg_replace('/[^a-zA-Z0-9]/', '', $nim);
            if (empty($nimSanitized)) {
                $skipped++;
                continue;
            }

            // Parse tahun_lulus from tanggal_lulus (e.g. "1 Juli 2000" or "13 September, 2003")
            $tahun = now()->year;
            if ($tanggalLulus && preg_match('/(\d{4})/', $tanggalLulus, $matches)) {
                $tahun = (int) $matches[1];
            } elseif (!empty($angkatan) && is_numeric($angkatan)) {
                $tahun = (int) $angkatan;
            }

            // Build record (dedup by NIM: keep last)
            $uniqueMap[$nimSanitized] = [
                'nama' => $nama,
                'nim' => $nimSanitized,
                'prodi' => $prodi ?: $fakultas ?: 'Tidak Diketahui',
                'tahun_lulus' => $tahun,
            ];

            // Progress every 10k rows
            if ($rowNum % 10000 === 0) {
                $this->command->info("🔄 Memproses {$rowNum} baris... (unique so far: " . count($uniqueMap) . ")");
            }
        }

        fclose($handle);

        $totalUnique = count($uniqueMap);
        $this->command->info("✅ Total baris dibaca: {$rowNum}");
        $this->command->info("✅ Unique NIM: {$totalUnique}");
        $this->command->warn("⚠️ Skipped: {$skipped}");

        // Now generate realistic data and bulk insert in chunks
        $records = [];
        $inserted = 0;
        $chunkSize = 1000;

        // Statistik untuk laporan
        $stats = [
            'bekerja' => 0,
            'wirausaha' => 0,
            'studi_lanjut' => 0,
            'belum_diketahui' => 0,
        ];

        foreach ($uniqueMap as $nim => $base) {
            $slug = Str::slug($base['nama'], '.');
            $prodi = $base['prodi'];
            $tahunLulus = $base['tahun_lulus'];
            $currentYear = now()->year;
            $yearsSinceGraduation = max(0, $currentYear - $tahunLulus);

            // Tentukan status karir berdasarkan probabilitas realistis
            $jobData = $this->determineJobData($prodi, $yearsSinceGraduation);
            $status = $jobData['status'];

            // Update statistik
            $stats[$this->snakeCase($status)]++;

            $records[] = [
                'nama' => $base['nama'],
                'nim' => $base['nim'],
                'prodi' => $prodi,
                'tahun_lulus' => $tahunLulus,
                'email' => "{$slug}.{$base['nim']}@gmail.com",
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'pekerjaan' => $jobData['pekerjaan'],
                'perusahaan' => $jobData['perusahaan'],
                'alamat_bekerja' => $jobData['alamat_bekerja'],
                'status_karir' => $status,
                'linkedin' => $jobData['pekerjaan'] ? "https://linkedin.com/in/{$slug}" : null,
                'instagram' => rand(0, 100) > 40 ? "https://instagram.com/{$slug}" : null,
                'facebook' => rand(0, 100) > 60 ? "https://facebook.com/{$slug}" : null,
                'tiktok' => rand(0, 100) > 70 ? "https://tiktok.com/@{$slug}" : null,
                'company_social' => $jobData['perusahaan'] ? "https://www." . Str::slug($jobData['perusahaan']) . ".com" : null,
                'pddikti_status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($records) >= $chunkSize) {
                Alumni::insert($records);
                $inserted += count($records);
                $records = [];
                $this->command->info("💾 Inserted {$inserted} records...");
            }
        }

        // Insert remaining
        if (count($records) > 0) {
            Alumni::insert($records);
            $inserted += count($records);
        }

        $this->command->newLine();
        $this->command->info("✅ Selesai! Total inserted: {$inserted}");
        $this->command->newLine();
        $this->command->info("📊 STATISTIK STATUS KARIR:");
        $this->command->info("   • Bekerja:      {$stats['bekerja']} (" . round($stats['bekerja'] / $inserted * 100, 1) . "%)");
        $this->command->info("   • Wirausaha:    {$stats['wirausaha']} (" . round($stats['wirausaha'] / $inserted * 100, 1) . "%)");
        $this->command->info("   • Studi Lanjut: {$stats['studi_lanjut']} (" . round($stats['studi_lanjut'] / $inserted * 100, 1) . "%)");
        $this->command->info("   • Belum Diketahui: {$stats['belum_diketahui']} (" . round($stats['belum_diketahui'] / $inserted * 100, 1) . "%)");
    }

    /**
     * Tentukan data pekerjaan berdasarkan prodi dan lama lulus.
     */
    private function determineJobData(string $prodi, int $yearsSinceGraduation): array
    {
        // Probabilitas dasar berdasarkan lama lulus
        // Lulusan < 1 tahun: 45% belum diketahui, 10% studi lanjut, 35% bekerja, 10% wirausaha
        // Lulusan 1-2 tahun: 30% belum diketahui, 8% studi lanjut, 50% bekerja, 12% wirausaha
        // Lulusan 3-5 tahun: 15% belum diketahui, 5% studi lanjut, 65% bekerja, 15% wirausaha
        // Lulusan > 5 tahun: 8% belum diketahui, 3% studi lanjut, 72% bekerja, 17% wirausaha

        if ($yearsSinceGraduation < 1) {
            $thresholds = ['belum_diketahui' => 45, 'studi_lanjut' => 55, 'bekerja' => 90, 'wirausaha' => 100];
        } elseif ($yearsSinceGraduation <= 2) {
            $thresholds = ['belum_diketahui' => 30, 'studi_lanjut' => 38, 'bekerja' => 88, 'wirausaha' => 100];
        } elseif ($yearsSinceGraduation <= 5) {
            $thresholds = ['belum_diketahui' => 15, 'studi_lanjut' => 20, 'bekerja' => 85, 'wirausaha' => 100];
        } else {
            $thresholds = ['belum_diketahui' => 8, 'studi_lanjut' => 11, 'bekerja' => 83, 'wirausaha' => 100];
        }

        $rand = rand(1, 100);

        if ($rand <= $thresholds['belum_diketahui']) {
            return [
                'pekerjaan' => null,
                'perusahaan' => null,
                'alamat_bekerja' => null,
                'status' => 'Belum Diketahui',
            ];
        } elseif ($rand <= $thresholds['studi_lanjut']) {
            $studi = $this->studiLanjutJobs[array_rand($this->studiLanjutJobs)];
            $slug = Str::slug($studi['perusahaan']);
            return [
                'pekerjaan' => $studi['pekerjaan'],
                'perusahaan' => $studi['perusahaan'],
                'alamat_bekerja' => 'Jl. Kampus ' . ucfirst($slug) . ' No. ' . rand(1, 99),
                'status' => 'Studi Lanjut',
            ];
        } elseif ($rand <= $thresholds['wirausaha']) {
            $usaha = $this->wirausahaJobs[array_rand($this->wirausahaJobs)];
            $slug = Str::slug($usaha['perusahaan']);
            return [
                'pekerjaan' => $usaha['pekerjaan'],
                'perusahaan' => $usaha['perusahaan'],
                'alamat_bekerja' => 'Jl. ' . ucfirst($slug) . ' No. ' . rand(1, 99) . ', Jakarta Selatan',
                'status' => 'Wirausaha',
            ];
        } else {
            // Bekerja - cari mapping prodi atau gunakan default
            $jobList = $this->prodiJobMap[$prodi] ?? $this->prodiJobMap['DEFAULT'];
            $job = $jobList[array_rand($jobList)];
            $slug = Str::slug($job['perusahaan']);
            return [
                'pekerjaan' => $job['pekerjaan'],
                'perusahaan' => $job['perusahaan'],
                'alamat_bekerja' => 'Jl. ' . ucfirst($slug) . ' No. ' . rand(1, 99) . ', ' . $job['perusahaan'],
                'status' => 'Bekerja',
            ];
        }
    }

    /**
     * Helper: ubah string ke snake_case.
     */
    private function snakeCase(string $input): string
    {
        return strtolower(str_replace(' ', '_', $input));
    }
}
