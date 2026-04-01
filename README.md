# 🌐 Website Pelacakan Alumni

Website ini dirancang untuk membantu administrator kampus dalam **melacak, memverifikasi, dan mengelola data alumni secara efektif**. Sistem ini terintegrasi dengan sumber data eksternal seperti PDDIKTI untuk memastikan keakuratan informasi alumni.

---

## 🛠️ Teknologi yang Digunakan

* **Backend**: Laravel 10 / PHP 8.1+
* **Database**: MySQL / MariaDB
* **Frontend**: Blade Templates, Bootstrap 5
* **API Integration**: Guzzle HTTP (integrasi PDDIKTI)
* **Authentication**: Laravel Sanctum & Laravel UI
* **Build Tools**: Vite, NPM

---

## 🚀 Fitur Utama

* 📊 **Dashboard Admin**
  Menampilkan statistik jumlah alumni, status pelacakan, dan data penting lainnya.

* 👨‍🎓 **Manajemen Data Alumni**

  * Tambah data alumni
  * Edit data alumni
  * Hapus data alumni
  * Lihat detail & riwayat tracking

* 🔐 **Autentikasi Admin**

  * Login
  * Register
  * Reset Password

* 🔍 **Pelacakan Aktivitas Alumni**
  Mengumpulkan informasi dari berbagai sumber publik.

* ✅ **Integrasi PDDIKTI**
  Digunakan untuk **verifikasi status alumni secara resmi**.

---

## 🧭 Cara Menggunakan Website

### 1. 🔑 Login Admin

* Akses: `http://localhost:8000/login`
* **Email**: `admin@alumni.com`
* **Password**: `admin123`
* Klik tombol **Login**

---

### 2. 📊 Dashboard

Setelah login, Anda akan diarahkan ke:

```
/admin/dashboard
```

Di halaman ini, Anda dapat melihat:

* Total alumni
* Status pelacakan
* Ringkasan data lainnya

---

### 3. 👨‍💼 Kelola Data Alumni

Masuk ke menu **Alumni** pada sidebar:

#### 📄 Lihat Daftar Alumni

* URL: `/admin/alumni`
* Fitur:

  * Pencarian data
  * Filter
  * Pagination

#### ➕ Tambah Alumni

* URL: `/admin/alumni/create`
* Langkah:

  1. Isi data (NIM, nama, angkatan, dll.)
  2. Klik **Simpan**

#### ✏️ Edit Alumni

* URL: `/admin/alumni/{id}/edit`
* Fitur:

  * Update data alumni
  * Sinkronisasi status PDDIKTI
  * Klik **Update**

#### 📌 Detail Alumni

* URL: `/admin/alumni/{id}`
* Menampilkan:

  * Informasi lengkap
  * Riwayat pelacakan

#### 🗑️ Hapus Alumni

* Klik tombol **Hapus**
* Konfirmasi sebelum data dihapus

---

### 4. 🚪 Logout

* Klik menu **Logout** pada sidebar

---

## 🧭 Navigasi Sistem

* Sidebar kiri:

  * Dashboard
  * Alumni
  * Logout

* Setiap aksi dilengkapi dengan:

  * Validasi input
  * Konfirmasi tindakan

---

## 🔐 Catatan Keamanan

* Segera ganti password default setelah login pertama kali
* Gunakan password yang kuat untuk keamanan sistem
* Batasi akses hanya untuk admin yang berwenang

---

## 📌 Penutup

Website ini siap digunakan setelah proses deployment.
Jika mengalami kendala, silakan hubungi administrator sistem.

---

✨ *Terima kasih telah menggunakan sistem pelacakan alumni ini.*
