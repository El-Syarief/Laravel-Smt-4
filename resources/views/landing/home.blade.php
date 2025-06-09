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
        <a href="{{ route('landing.home') }}" class="active">Home</a>
        <a href="{{ route('backend.transaksi.index') }}">Transaksi</a>
        <a href="{{ route('backend.barang.index') }}">Stok</a>
        <a href="{{ route('backend.laporan.index') }}">Cetak Laba</a>
    </nav>
    <div class="user-section">
        <a href="{{ route('login') }}">Masuk</a>
        <a href="{{ route('backend.register') }}" class="btn-primary" style="padding: 8px 15px;">Daftar</a>
    </div>
</header>

<section class="hero">
    <div class="hero-text">
        <h1>Perbaiki Usaha Anda Menjadi Lebih Baik Dengan Simanis</h1>
        <p>Platform kami memberikan semua yang bisnis anda butuhkan untuk pengelolaan stok, transaksi, dan laporan usaha dengan lebih mudah dan efisien.</p>
        <div class="hero-buttons">
            <a href="{{ route('backend.beranda') }}" class="btn-primary">Selengkapnya</a>
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="Logo Simanis">
    </div>
</section>

<section class="features">
    <h2>Semua Kebutuhan Bisnis Yang Anda Perlukan</h2>
    <p class="subtitle">Fokus pada pengembangan bisnis Anda. Biarkan kami yang mengurus hal-hal teknis yang rumit.</p>
    <div class="feature-list">
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
            <h3>Transaksi</h3>
            <p>Proses penjualan cepat dan mudah.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                </svg>
            </div>
            <h3>Manajemen Stok</h3>
            <p>Pantau stok real-time.</p>
        </div>
        <div class="feature">
            <div class="feature-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 9.75 21V8.625Zm8.25-4.5c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                </svg>
            </div>
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