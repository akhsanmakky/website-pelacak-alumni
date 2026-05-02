# AlumniTrace - Sistem Pelacakan Alumni

Website pelacakan alumni berbasis Laravel untuk mengelola dan memantau karir alumni secara efektif oleh administrator kampus/institusi.

## Teknologi yang Digunakan

- **Backend**: Laravel 10 / PHP 8.1+
- **Database**: MySQL / MariaDB
- **Frontend**: Blade Templates, Tailwind CSS
- **API**: Guzzle HTTP (integrasi PDDIKTI)
- **Auth**: Laravel Breeze / UI
- **Build Tools**: Vite, NPM
- **Charts**: Chart.js

## Fitur Utama

- ✅ Dashboard admin dengan statistik real-time
- ✅ Manajemen alumni lengkap (CRUD)
- ✅ Pencarian dan filter multi-kriteria
- ✅ Pelacakan karir alumni otomatis (Auto-Tracking)
- ✅ Integrasi PDDIKTI untuk verifikasi data
- ✅ Import data alumni dari CSV
- ✅ Export data ke Excel
- ✅ Bulk operations (track massal, verifikasi PDDIKTI)
- ✅ Manajemen media sosial alumni

---

## Cara Menggunakan Website

### 1. Menjalankan Server

```bash
# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
php artisan db:seed

# Jalankan server
php artisan serve
```

Buka `http://localhost:8000` di browser.

---

### 2. Login ke Admin Panel

1. Buka halaman login: `http://localhost:8000/login`
2. Gunakan kredensial default:
   - **Email**: `admin@alumni.com`
   - **Password**: `admin123`
3. Klik tombol "Masuk"

> 🔐 **Catatan Keamanan**: Ganti password default setelah login pertama kali!

---

### 3. Dashboard Admin

Setelah login, Anda akan diarahkan ke `/dashboard` yang menampilkan:

| Kart Stats | Keterangan |
|-----------|------------|
| Teridentifikasi | Alumni dengan status karir sudah diketahui |
| Perlu Verifikasi | Alumni yang butuh verifikasi lebih lanjut |
| Belum Ditemukan | Alumni yang belum berhasil dilacak |
| Tidak Valid (PDDIKTI) | Alumni dengan data tidak valid di PDDIKTI |

**Fitur Lainnya**:
- Statistik PDDIKTI (Terverifikasi, Tidak Ditemukan, Menunggu)
- Distribusi karir alumni (Bekerja, Wirausaha, Studi Lanjut, Lainnya)
- Grafik doughnut interaktif
- Aksi cepat (Tambah, Export, Verifikasi PDDIKTI Massal)
- Tabel alumni terbaru

---

### 4. Mengelola Data Alumni

#### 📋 Lihat Daftar Alumni
- **URL**: `http://localhost:8000/admin/alumni`
- Fitur: Pencarian, filter, pagination, bulk select
- Kolom: Nama, Prodi, Tahun Lulus, Status Karir, Auto-Tracking, Sosial Media

#### ➕ Tambah Alumni Baru
- **URL**: `http://localhost:8000/admin/alumni/create`
- Isi form: NIM, Nama, Prodi, Tahun Lulus, Email, No. HP
- Isi info karir: Perusahaan, Alamat, Posisi, Status
- Isi media sosial: LinkedIn, Instagram, Facebook, dll.

#### ✏️ Edit Alumni
- **URL**: `http://localhost:8000/admin/alumni/{id}/edit`
- Ubah data alumni, update status karir
- Update tautan media sosial
- Verifikasi ulang PDDIKTI

#### 👁️ Lihat Detail Alumni
- **URL**: `http://localhost:8000/admin/alumni/{id}`
- Riwayat tracking lengkap
-置信度 scoring (Auto-Tracking)
- Grafik progres karir

#### 🗑️ Hapus Alumni
- Klik ikon trash pada tabel
- Konfirmasi sebelum menghapus

---

### 5. Fitur Tambahan

#### 📥 Import dari CSV
1. Buka halaman Alumni (`/admin/alumni`)
2. Klik tombol **Import CSV**
3. Upload file CSV dengan format:
   ```
   nama,nim,prodi,tahun_lulus,email,no_hp
   ```
4. Klik **Import**

#### 📤 Export ke Excel
1. Buka halaman Alumni
2. Klik tombol **Export**
3. File Excel akan ter-download otomatis

#### 🔍 Pencarian Lanjutan
Di halaman Alumni, gunakan panel pencarian untuk filter:
- Nama
- Email
- No. HP
- Tempat Kerja
- Posisi
- Status Karir
- Alamat Bekerja
- Sosial Media

#### ⚡ Bulk Track (Pelacakan Massal)
1. Centang checkbox alumni yang ingin dilacak
2. Klik tombol **Bulk Track**
3. Sistem akan otomatis melacak info karir

#### 🔄 Verifikasi PDDIKTI Massal
1. Di Dashboard, klik **Verifikasi PDDIKTI Massal**
2. Sistem akan memverifikasi semua alumni ke database PDDIKTI

---

### 6. Navigasi Menu

```
Sidebar Kiri:
├── 📊 Dashboard       → /dashboard
├── 👥 Data Alumni    → /admin/alumni
└── 🚪 Keluar         → Logout
```

---

### 7. Endpoint Penting

| Fitur | URL | Method |
|-------|-----|--------|
| Landing Page | `/` | GET |
| Login | `/login` | GET/POST |
| Register | `/register` | GET/POST |
| Dashboard | `/dashboard` | GET |
| Daftar Alumni | `/admin/alumni` | GET |
| Tambah Alumni | `/admin/alumni/create` | GET/POST |
| Edit Alumni | `/admin/alumni/{id}/edit` | GET/PUT |
| Detail Alumni | `/admin/alumni/{id}` | GET |
| Hapus Alumni | `/admin/alumni/{id}` | DELETE |
| Import CSV | `/admin/alumni/import` | POST |
| Export Excel | `/admin/alumni/export` | GET |
| Bulk Track | `/admin/alumni/bulk-track` | POST |
| Validasi PDDIKTI | `/admin/alumni/{id}/validate` | POST |
| Bulk PDDIKTI | `/admin/alumni/bulk-pddikti-verify` | POST |
| Stats API | `/stats` | GET |

---

## Struktur Project

```
alumni-tracking/
├── app/
│   ├── Console/Commands/   → TrackAlumniCommand
│   ├── Http/Controllers/  → Admin, API Controllers
│   ├── Jobs/              → Background Jobs
│   ├── Models/           → Alumni, AlumniProfile, AlumniTracking
│   └── Services/         → Search, Extractor, ProfileGenerator
├── database/
│   ├── migrations/       → Schema tables
│   └── seeders/         → Sample data
├── resources/views/
│   ├── admin/          → Admin pages
│   ├── auth/          → Login, Register
│   └── layouts/        → Templates
└── routes/
    ├── web.php         → Web routes
    └── api.php        → API routes
```

---

## Support

Jika ada pertanyaan atau butuh bantuan:
- Email: admin@alumni.com
- Buka issue di GitHub repository

**Catatan**: Pastikan server MySQL/MariaDB berjalan sebelum menjalankan aplikasi.

Terima kasih telah menggunakan AlumniTrace!
