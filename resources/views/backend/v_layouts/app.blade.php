<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Simanis')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font dan CSS sederhana --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
        body { background-color: #f5f5f5; color: #333; }
        header, footer { background-color: #214055; color: #fff; padding: 15px 30px; }
        nav a { color: #fff; text-decoration: none; margin-right: 20px; font-weight: 600; }
        .container { max-width: 1200px; margin: 0 auto; padding: 30px; }
        .nav-right { float: right; }
        footer { text-align: center; font-size: 14px; margin-top: 40px; }
        .btn { padding: 10px 16px; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; }
        .btn-primary { background-color: #2d78db; color: white; }
        .btn-secondary { background-color: #ddd; color: #333; }
    </style>

    @stack('styles') {{-- Tambahan style khusus per halaman --}}
</head>
<body>

    {{-- Header dan Navigasi --}}
    <header>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div><strong>Simanis</strong></div>
            <nav>
                <a href="{{ route('backend.beranda') }}">Home</a>
                @auth
                    <a href="{{ route('backend.barang.index') }}">Stok</a>
                    <a href="#">Transaksi</a>
                    <a href="#">Cetak Laba</a>
                    <a href="{{ route('backend.user.show', Auth::user()->idUser) }}">Profil</a>
                    <a href="{{ route('backend.logout') }}">Logout</a>
                @else
                    <a href="{{ route('backend.login') }}">Masuk</a>
                    <a href="{{ route('backend.register') }}"><button class="btn btn-primary">Daftar</button></a>
                @endauth
            </nav>
        </div>
    </header>

    {{-- Konten Utama --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer>
        © {{ date('Y') }} Simanis. Semua hak cipta dilindungi.
    </footer>

    @stack('scripts') {{-- Tambahan JS khusus per halaman --}}
</body>
</html>
{{-- 
    Catatan: 
    - Pastikan untuk menambahkan @yield('content') di bagian konten utama.
    - Gunakan @stack('styles') dan @stack('scripts') untuk menambahkan style dan script khusus per halaman. 