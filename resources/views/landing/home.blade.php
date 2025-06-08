<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Simanis - Platform Bisnis</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    
    @vite('resources/css/landing-page.css')
</head>
<body>

<header>
    <div class="logo"><strong>Simanis</strong></div>
    <nav>
        {{-- Jika sudah login, link Home mengarah ke dasbor --}}
        @auth
            <a href="{{ route('backend.beranda') }}" class="active">Home</a>
            <a href="#">Transaksi</a>
            <a href="{{ route('backend.barang.index') }}">Stok</a>
            <a href="#">Cetak Laba</a>
        @else
        {{-- Jika belum login, link Home mengarah ke landing page --}}
            <a href="{{ route('landing.home') }}" class="active">Home</a>
            <a href="#">Transaksi</a>
            <a href="#">Stok</a>
            <a href="#">Cetak Laba</a>
        @endauth
    </nav>
    <div class="user-section">
        {{-- Logika untuk menampilkan bagian user sesuai status login --}}
        @auth
            <div class="user-profile">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.92V18h11v-1.58C17.5,14.23,15.04,12.5,12,12.5z M12,2C9.24,2,7,4.24,7,7s2.24,5,5,5s5-2.24,5-5S14.76,2,12,2z"/></svg>
                <span>{{ Auth::user()->namaUsaha }}</span>
                {{-- Form untuk logout --}}
                <form action="{{ route('backend.logout') }}" method="POST" style="display:inline; margin-left: 15px;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:white; font-family:'Inter',sans-serif; font-weight:500; cursor:pointer; font-size:16px;">Logout</button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}">Masuk</a>
            <a href="{{ route('backend.register') }}" class="btn-primary" style="padding: 8px 15px;">Daftar</a>
        @endauth
    </div>
</header>

<section class="hero">
    <div class="hero-text">
        {{-- Menggunakan @guest dan @auth untuk mengubah judul dan tombol --}}
        @guest
            <h1>Perbaiki Usaha Anda Menjadi Lebih Baik Dengan Simanis</h1>
            <p>Platform kami memberikan semua yang bisnis anda butuhkan untuk pengelolaan stok, transaksi, dan laporan usaha dengan lebih mudah dan efisien.</p>
            <div class="hero-buttons">
                <a href="#" class="btn-primary">Selengkapnya</a>
            </div>
        @endguest

        @auth
            <h1>Selamat Datang Kembali, {{ Auth::user()->namaUsaha }}!</h1>
            <p>Platform kami memberikan semua yang bisnis anda butuhkan untuk pengelolaan stok, transaksi, dan laporan usaha dengan lebih mudah dan efisien.</p>
            <div class="hero-buttons">
                <a href="{{ route('backend.barang.index') }}" class="btn-primary">Lihat Stok Barang</a>
            </div>
        @endauth
    </div>
    <div class="hero-image">
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="Logo Simanis">
    </div>
</section>

{{-- Section fitur ini sama untuk kedua kondisi, jadi tidak perlu diubah --}}
<section class="features">
    <h2>Semua Kebutuhan Bisnis Yang Anda Perlukan</h2>
    <p class="subtitle">Fokus pada pengembangan bisnis Anda. Biarkan kami yang mengurus hal-hal teknis yang rumit.</p>

    <div class="feature-list">
        <div class="feature">
            <div class="icon-placeholder">Logo</div>
            <h3>Transaksi</h3>
            <p>Proses penjualan cepat dan mudah.</p>
        </div>
        <div class="feature">
            <div class="icon-placeholder">Logo</div>
            <h3>Manajemen Stok</h3>
            <p>Pantau stok real-time.</p>
        </div>
        <div class="feature">
            <div class="icon-placeholder">Logo</div>
            <h3>Cetak Laba</h3>
            <p>Hasilkan laporan otomatis.</p>
        </div>
    </div>
</section>

<footer>
    <div>© 2025 Simanis. Semua hak cipta dilindungi.</div>
    <div>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
        <a href="#">Facebook</a>
    </div>
</footer>

</body>
</html>