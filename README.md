# Website Pelacak Alumni

Website ini dirancang untuk melacak dan mengelola data alumni dengan fitur lengkap untuk administrator.

## Fitur Utama

- **Dashboard Admin**: Overview data alumni dan statistik.
- **Manajemen Alumni**: Tambah, edit, hapus, dan lihat detail alumni (CRUD).
- **Autentikasi Aman**: Login dan registrasi admin dengan reset password.
- **Integrasi PDDIKTI**: Sinkronisasi status alumni dari PDDIKTI.
- **Tracking Alumni**: Riwayat aktivitas dan pelacakan alumni.

## Persyaratan Sistem

- PHP 8.1+
- Composer
- Node.js & NPM
- MySQL (via XAMPP direkomendasikan)
- Laravel 11

## Instalasi dan Penggunaan

1. **Clone Repository**:
   ```
   git clone https://github.com/akhsanmakky/website-pelacak-alumni.git
   cd website-pelacak-alumni
   ```

2. **Install Dependencies**:
   ```
   composer install
   npm install
   ```

3. **Konfigurasi Environment**:
   ```
   cp .env.example .env
   php artisan key:generate
   ```
   Edit `.env` untuk database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=alumni_tracking
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Setup Database** (pastikan XAMPP MySQL running):
   ```
   php artisan migrate
   php artisan db:seed
   ```

5. **Build Assets**:
   ```
   npm run build
   ```

6. **Jalankan Aplikasi**:
   ```
   php artisan serve
   ```
   Atau via XAMPP: place in htdocs, access `http://localhost/website-pelacak-alumni/public`

## Akses Aplikasi

- **Admin Login**: `http://localhost:8000/login` atau `/admin/dashboard`
- Gunakan kredensial default dari seeder atau buat user baru.

## Halaman Utama

- `/` : Halaman welcome
- `/admin/alumni` : Daftar alumni
- `/admin/dashboard` : Dashboard

Untuk kontribusi atau issue, buka pull request atau issue di GitHub.

Terima kasih!
