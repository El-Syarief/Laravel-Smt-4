# <img src="public/backend/images/simanis-doang.png" alt="SIMANIS Logo" width="50"> SIMANIS - Sistem Informasi Manajemen dan Transaksi (Semester 4)

[![Build Status](https://img.shields.io/github/workflow/status/El-Syarief/laravel-smt-4/CI?style=flat-square)](https://github.com/El-Syarief/laravel-smt-4/actions)
[![PHP Version](https://img.shields.io/badge/php-%22%23%2F%3E%2F8.1-%22%23%2F%3E%2F-777BB4.svg?style=flat-square)](https://php.net/)
[![Built with Laravel](https://img.shields.io/badge/built%20with-laravel-%22%23%2F%3E%2FFF2D20.svg?style=flat-square)](https://laravel.com/)
[![License](https://img.shields.io/github/license/El-Syarief/laravel-smt-4?style=flat-square)](https://github.com/El-Syarief/laravel-smt-4/blob/main/LICENSE)

<br/>

Aplikasi **SIMANIS** adalah sistem manajemen stok barang, pencatatan transaksi, dan pelaporan keuangan berbasis web yang dikembangkan menggunakan framework Laravel dan Vite sebagai aset bundler untuk memenuhi tugas atau proyek kuliah Semester 4.

---

## 🚀 Fitur Utama

Sistem ini dirancang dengan modul backend lengkap dan tampilan kustom yang modern untuk mempermudah operasional toko atau manajemen inventaris Anda:

| Icon | Fitur | Deskripsi |
| :--- | :--- | :--- |
| 🔑 | **Autentikasi Pengguna** | Registrasi, login aman, sistem proteksi session, dan fitur lupa kata sandi. |
| 📊 | **Dasbor Interaktif** | Halaman utama khusus backend untuk memantau ringkasan data inventaris dan penjualan secara *real-time*. |
| 📦 | **Manajemen Stok** | CRUD (Create, Read, Update, Delete) Kategori & Barang, serta fitur penambahan stok barang secara dinamis. |
| 💳 | **Pencatatan Transaksi** | Fitur transaksi penjualan/pembelian lengkap dengan riwayat (*history*) transaksi mendetail. |
| 💸 | **Beban & Pengeluaran** | Pencatatan pengeluaran operasional di luar transaksi barang untuk kalkulasi neraca keuangan yang akurat. |
| 📄 | **Laporan & Ekspor PDF** | Pembuatan laporan berkala yang dapat diunduh langsung dalam format file PDF menggunakan template cetak kustom. |
| 👤 | **Manajemen Profil** | Halaman khusus bagi pengguna untuk memperbarui informasi akun mereka sendiri. |

---

## 🛠️ Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan tumpukan teknologi modern:

| Teknologi | Detail | Logo |
| :--- | :--- | :--- |
| Framework PHP | Laravel (v10 / v11) | [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com/) |
| Build Tool / Aset Bundler | Vite | [![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vitejs.dev/) |
| Database Server | MySQL / MariaDB | [![MySQL](https://img.shields.io/badge/MySQL-00758F?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/) [![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=flat-square&logo=mariadb&logoColor=white)](https://mariadb.org/) |
| Backend Language | PHP, JavaScript | [![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net/) [![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript) |
| Frontend Language | Blade, HTML5, CSS3 kustom | [![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Glossary/HTML5) [![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Glossary/CSS) |

---

## ⚙️ Panduan Instalasi Lokal

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan aplikasi ini di komputer lokal Anda:

### 1. Prasyarat Sistem
Pastikan perangkat lunak berikut sudah terinstal di komputer Anda:
*   [**PHP**](https://php.net/) (Minimal versi 8.1 atau versi terbaru)
*   [**Composer**](https://getcomposer.org/)
*   [**Node.js & NPM**](https://nodejs.org/)
*   [**Aplikasi Database Server**](https://www.mysql.com/) (seperti XAMPP, Laragon, atau MySQL CLI)

### 2. Langkah Pemasangan

1.  **Clone** repositori ini ke komputer Anda dan masuk ke direktori proyek:
```bash
    git clone [https://github.com/El-Syarief/laravel-smt-4.git](https://github.com/El-Syarief/laravel-smt-4.git)
    cd laravel-smt-4
   ```

2.  **Instal** dependensi PHP menggunakan Composer:
```bash
    composer install
   ```

3.  **Instal** dependensi JavaScript menggunakan NPM:
```bash
    npm install
   ```

4.  **Konfigurasi Environment**:
    Buat file konfigurasi `.env` baru di direktori utama proyek, lalu salin dan tempel konfigurasi dasar di bawah ini. Sesuaikan kredensial database Anda jika diperlukan:
```bash
    # Salin dan tempel ke file .env
    APP_NAME=SIMANIS
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
   ```

5.  **Generate** kunci enkripsi aplikasi:
```bash
    php artisan key:generate
   ```

6.  **Jalankan** migrasi database dan isi data awal (seeder):
```bash
    php artisan migrate --seed
   ```

---

## 🏃‍♂️ Cara Menjalankan Aplikasi

Untuk menjalankan aplikasi dengan performa penuh dan memuat style tampilan kustom dengan benar, Anda harus mengaktifkan dua server secara bersamaan dalam dua jendela terminal:

1.  **Jalankan Server Lokal PHP Laravel** (Backend):
    Akses terminal pertama dan jalankan perintah:
```bash
    php artisan serve
   ```
    Aplikasi Anda sekarang dapat diakses di `http://127.0.0.1:8000`.

2.  **Jalankan Vite Development Server** (Frontend Assets):
    Akses terminal kedua dan jalankan perintah:
```bash
    npm run dev
   ```
   <div style="background-color: #2e3b4e; border-left: 5px solid #646cff; color: #fff; padding: 1em; border-radius: 5px; margin-top: 1em;">
        <strong>Perhatian:</strong> Terminal ini <u>harus tetap aktif</u> selama Anda mengembangkan atau menggunakan aplikasi agar aset visual kustom termuat dengan sempurna.
   </div>

---

<br/>
<div align="center">
  Dibuat dengan ❤️ oleh <h2>The Kentangs</h2> untuk Proyek Kuliah Semester 4
</div>