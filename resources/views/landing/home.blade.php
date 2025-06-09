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
        <a href="#">Transaksi</a>
        <a href="#">Stok</a>
        <a href="#">Cetak Laba</a>
    </nav>
    <div class="user-section">
        {{-- Bagian ini sekarang hanya untuk pengunjung --}}
        <a href="{{ route('login') }}">Masuk</a>
        <a href="{{ route('backend.register') }}" class="btn-primary" style="padding: 8px 15px;">Daftar</a>
    </div>
</header>

<section class="hero">
    <div class="hero-text">
        <h1>Perbaiki Usaha Anda Menjadi Lebih Baik Dengan Simanis</h1>
        <p>Platform kami memberikan semua yang bisnis anda butuhkan untuk pengelolaan stok, transaksi, dan laporan usaha dengan lebih mudah dan efisien.</p>
        <div class="hero-buttons">
            <a href="#" class="btn-primary">Selengkapnya</a>
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
        {{-- ... Ikon-ikon fitur ... --}}
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