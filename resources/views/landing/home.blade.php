<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Simanis - Platform Bisnis</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap">
    <style>
        body { font-family: 'Inter', sans-serif; margin: 0; padding: 0; background-color: #88938d; color: #111; }
        header, footer { background-color: #214055; color: white; padding: 20px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; margin: 0 15px; font-weight: 600; }
        .hero { display: flex; justify-content: space-between; align-items: center; padding: 60px; }
        .hero-text h1 { font-size: 36px; font-weight: 800; margin-bottom: 20px; }
        .hero-text p { max-width: 500px; margin-bottom: 30px; }
        .hero-buttons button { margin-right: 10px; padding: 10px 20px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; }
        .btn-primary { background-color: #2d78db; color: white; }
        .btn-secondary { background-color: #ccc; color: #333; }
        .features { text-align: center; padding: 50px; }
        .features h3 { font-size: 22px; margin-bottom: 30px; }
        .feature-list { display: flex; justify-content: center; gap: 50px; }
        .feature { background: #aeb7b1; padding: 20px; border-radius: 10px; width: 180px; }
        footer a { color: white; text-decoration: none; margin: 0 10px; font-weight: 500; }
    </style>
</head>
<body>

<header>
    <div><strong>Simanis</strong></div>
    <nav>
        <a href="#" class="active">Home</a>
        <a href="#">Transaksi</a>
        <a href="#">Stok</a>
        <a href="#">Cetak Laba</a>
        <a href="{{ route('backend.login') }}">Masuk</a>
        <a href="{{ route('backend.register') }}">
            <button class="btn-primary">Daftar</button>
        </a>
    </nav>
</header>

<section class="hero">
    <div class="hero-text">
        <h1>Perbaiki Usaha Anda Menjadi Lebih Baik Dengan Simanis</h1>
        <p>Platform kami memberikan semua yang bisnis anda butuhkan untuk aaaaaaaaaaaaaaaaaa...</p>
        <div class="hero-buttons">
            <!-- <a href="{{ route('backend.register') }}"><button class="btn-primary">Daftar</button></a>
            <a href="{{ route('backend.login') }}"><button class="btn-secondary">Masuk</button></a> -->
        </div>
    </div>
    <div class="hero-image">
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" width="250" alt="Logo Simanis">
    </div>
</section>

<section class="features">
    <h3>Semua Kebutuhan Bisnis Yang Anda Perlukan</h3>
    <p>Fokus pada pengembangan bisnis Anda. Biarkan kami yang mengurus hal-hal teknis yang rumit.</p>

    <div class="feature-list">
        <div class="feature">
            <div>Logo</div>
            <strong>Transaksi</strong>
            <p>Proses penjualan cepat dan mudah.</p>
        </div>
        <div class="feature">
            <div>Logo</div>
            <strong>Manajemen Stok</strong>
            <p>Pantau stok real-time.</p>
        </div>
        <div class="feature">
            <div>Logo</div>
            <strong>Cetak Laba</strong>
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
