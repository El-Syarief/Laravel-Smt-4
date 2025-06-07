@extends('backend.v_layouts.app')
<!-- @section('content') -->

<!-- @section('title', 'beranda') -->

@push('styles')
<style>
    .hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #7d8c89;
        padding: 60px 40px;
        color: #111;
    }

    .hero-text {
        max-width: 50%;
    }

    .hero-text h1 {
        font-size: 36px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .hero-text p {
        font-size: 16px;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .hero-text a {
        padding: 12px 24px;
        background-color: #2d78db;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    .hero-image img {
        width: 220px;
    }

    .fitur-section {
        text-align: center;
        padding: 60px 20px;
        background-color: #7d8c89;
    }

    .fitur-section h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .fitur-section p.desc {
        font-size: 15px;
        color: #444;
        max-width: 700px;
        margin: 0 auto 40px;
    }

    .fitur-items {
        display: flex;
        justify-content: center;
        gap: 60px;
        flex-wrap: wrap;
    }

    .fitur-item {
        background-color: #d3dfe1;
        padding: 20px;
        width: 200px;
        border-radius: 12px;
        text-align: center;
    }

    .fitur-item img {
        width: 50px;
        margin-bottom: 10px;
    }

    .fitur-item h3 {
        font-size: 18px;
        margin-bottom: 8px;
        color: #111;
    }

    .fitur-item p {
        font-size: 14px;
        color: #333;
    }

    footer {
        background-color: #29464f;
        color: white;
        padding: 30px 20px;
        text-align: center;
    }

    .footer-links {
        margin-top: 10px;
    }

    .footer-links a {
        color: white;
        margin: 0 10px;
        text-decoration: none;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="hero">
    <div class="hero-text">
        <h1>ini halaman beranda</h1>
        <h1>Perbaiki Usaha Anda<br>Menjadi Lebih Baik<br>Dengan Simanis</h1>
        <p>
            Platform kami memberikan semua yang bisnis anda butuhkan untuk<br>
            pengelolaan stok, transaksi, dan laporan usaha dengan lebih mudah dan efisien.
        </p>
        <a href="#">Selengkapnya</a>
    </div>
    <div class="hero-image">
        <img src="https://i.ibb.co/FKVPxvg/simanis-cart.png" alt="simanis-logo">
        <h2 style="text-align:center; margin-top: 10px;"><span style="color:#29464f;">si</span><span style="color:#f3c24b;">manis</span></h2>
    </div>
</div>

<div class="fitur-section">
    <h2>Semua Kebutuhan Bisnis Yang Anda Perlukan</h2>
    <p class="desc">Fokus pada pengembangan bisnis Anda. Biarkan kami yang mengurus hal-hal teknis yang rumit.</p>

    <div class="fitur-items">
        <div class="fitur-item">
            <img src="https://via.placeholder.com/50x50.png?text=Logo" alt="transaksi">
            <h3>Transaksi</h3>
            <p>Proses penjualan dengan cepat dan mudah, terintegrasi langsung dengan manajemen stok.</p>
        </div>
        <div class="fitur-item">
            <img src="https://via.placeholder.com/50x50.png?text=Logo" alt="stok">
            <h3>Manajemen Stok</h3>
            <p>Pantau ketersediaan produk secara real-time untuk menghindari kehabisan stok.</p>
        </div>
        <div class="fitur-item">
            <img src="https://via.placeholder.com/50x50.png?text=Logo" alt="laba">
            <h3>Cetak Laba</h3>
            <p>Hasilkan laporan laba rugi otomatis untuk mengevaluasi performa usaha Anda.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Tambahkan JS jika dibutuhkan --}}
@endpush
