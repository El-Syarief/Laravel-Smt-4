@extends('backend.v_layouts.app')

@section('title', 'Beranda')

@section('content')

{{-- Menggunakan section hero yang sama dengan landing page --}}
<section class="hero">
    <div class="hero-text">
        <h1>Selamat Datang Kembali, {{ Auth::user()->namaUsaha }}!</h1>
        <p>
            Platform kami memberikan semua yang bisnis anda butuhkan untuk
            pengelolaan stok, transaksi, dan laporan usaha dengan lebih mudah dan efisien.
        </p>
        <a href="{{ route('backend.barang.index') }}" class="btn-primary">Lihat Stok Barang</a>
    </div>
    <div class="hero-image">
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="Logo Simanis">
    </div>
</section>

{{-- Menggunakan section fitur yang sama dengan landing page --}}
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

@endsection