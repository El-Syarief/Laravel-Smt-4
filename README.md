# SIMANIS - Sistem Informasi Manajemen dan Transaksi (Semester 4)

Aplikasi SIMANIS adalah sistem manajemen stok barang, pencatatan transaksi, dan pelaporan keuangan berbasis web yang dikembangkan menggunakan framework Laravel dan Vite sebagai aset bundler untuk memenuhi tugas atau proyek kuliah Semester 4.

## Fitur Utama

Sistem ini dilengkapi dengan berbagai modul backend dan tampilan kustom untuk mempermudah operasional toko atau manajemen inventaris:

*   **Autentikasi Pengguna**: Fitur registrasi, login, sistem proteksi session, serta pengaturan lupa kata sandi.
*   **Dasbor Interaktif**: Halaman beranda khusus backend untuk memantau ringkasan data inventaris dan penjualan secara cepat.
*   **Manajemen Kategori & Barang**: Fitur untuk menambah, mengubah, melihat daftar barang, serta menambah jumlah stok barang secara dinamis.
*   **Pencatatan Transaksi**: Fitur transaksi penjualan/pembelian lengkap dengan riwayat (*history*) transaksi mendetail untuk melacak performa toko.
*   **Manajemen Beban & Pengeluaran**: Pencatatan pengeluaran operasional di luar transaksi barang untuk kalkulasi neraca keuangan yang akurat.
*   **Laporan Keuangan & Ekspor PDF**: Pembuatan laporan berkala yang dapat diunduh langsung dalam format file PDF menggunakan template cetak kustom.
*   **Manajemen Profil**: Halaman khusus bagi pengguna yang sedang masuk untuk memperbarui informasi akun mereka sendiri.

## Teknologi yang Digunakan

*   **Framework PHP**: Laravel (v10 / v11)
*   **Build Tool / Asset Bundler**: Vite (untuk efisiensi kompilasi CSS dan JavaScript)
*   **Database Server**: MySQL / MariaDB
*   **Bahasa Pemrograman Backend**: PHP, JavaScript
*   **Bahasa Pemrograman Frontend**: Blade (Laravel Template Engine), HTML5, CSS3 kustom

## Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan aplikasi ini di komputer Anda:

### 1. Prasyarat Sistem
Pastikan perangkat lunak berikut sudah terinstal di komputer Anda:
*   PHP (Minimal versi 8.1 atau versi terbaru)
*   Composer
*   Node.js & NPM
*   Aplikasi Database Server (seperti XAMPP, Laragon, atau MySQL CLI)

### 2. Langkah Pemasangan

1. **Clone Proyek & Masuk ke Direktori**
```bash
   cd laravel-smt-4
```

2. **Instal Dependensi Backend (Composer)**
```bash
   composer install

3. **Instal Dependensi Frontend (NPM)**
```bash
   npm install
```

4. **Membuat File Konfigurasi .env Baru**
   Buat file baru bernama .env di direktori utama proyek, lalu salin dan tempel konfigurasi dasar di bawah ini:
   APP_NAME=Laravel
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=true
   APP_URL=http://localhost

   LOG_CHANNEL=stack
   LOG_DEPRECATIONS_CHANNEL=null
   LOG_LEVEL=debug

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_simanis
   DB_USERNAME=root
   DB_PASSWORD=

   BROADCAST_DRIVER=log
   CACHE_DRIVER=file
   FILESYSTEM_DISK=local
   QUEUE_CONNECTION=sync
   SESSION_DRIVER=file
   SESSION_LIFETIME=120

5. **Generate Application Key**
   Buat kunci enkripsi unik untuk aplikasi Anda dengan menjalankan perintah:
```bash
   php artisan key:generate
```

6. **Jalankan Migrasi & Data Seeder**
   Kirimkan semua skema tabel dan isi data awal (seperti akun bawaan) ke dalam database Anda:
```bash
   php artisan migrate --seed
```

## Cara Menjalankan Aplikasi
Untuk menjalankan aplikasi dengan performa penuh dan memuat style tampilan dengan benar, Anda harus mengaktifkan dua terminal secara bersamaan:

### Terminal 1: Server Lokal Laravel
Jalankan perintah ini untuk menyalakan server lokal PHP Laravel:
```bash
php artisan serve
```

### Terminal 2: Vite Development Server
Jalankan perintah ini untuk mengompilasi dan memantau perubahan pada file CSS dan JavaScript secara real-time:
```bash
npm run dev
```
Terminal ini harus tetap aktif selama Anda mengembangkan atau menggunakan aplikasi agar aset visual kustom termuat dengan sempurna.