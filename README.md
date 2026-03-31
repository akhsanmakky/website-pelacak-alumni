# Website Pelacak Alumni

Website ini digunakan untuk melacak dan mengelola data alumni secara efektif oleh administrator.

## Fitur Utama

- Dashboard admin dengan statistik alumni
- Manajemen alumni lengkap (lihat, tambah, edit, hapus)
- Autentikasi admin (login, register, reset password)
- Pelacakan aktivitas alumni
- Integrasi data PDDIKTI untuk verifikasi status

## Cara Menggunakan Website

### 1. Login Admin
- Buka `http://localhost:8000/login` (atau URL server Anda)
- Masukkan email dan password admin
- Klik "Login"

### 2. Dashboard
- Setelah login, otomatis ke `/admin/dashboard`
- Lihat ringkasan jumlah alumni, tracking, dll.

### 3. Kelola Alumni
- Klik menu **Alumni** di sidebar
- **Lihat Daftar** (`/admin/alumni`): Cari, filter, pagination
- **Tambah Alumni** (`/admin/alumni/create`): Isi form NIM, nama, angkatan, dll. lalu "Simpan"
- **Edit Alumni** (`/admin/alumni/{id}/edit`): Ubah data, update PDDIKTI status, "Update"
- **Detail Alumni** (`/admin/alumni/{id}`): Lihat riwayat tracking
- **Hapus**: Konfirmasi sebelum hapus

### 4. Logout
- Klik "Logout" di sidebar

### Navigasi
- Sidebar kiri: Dashboard, Alumni, Logout
- Setiap aksi punya konfirmasi dan validasi

Website siap digunakan setelah di-deploy. Hubungi admin untuk akses atau bantuan.

Terima kasih!
