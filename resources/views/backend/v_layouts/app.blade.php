<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Simanis') - Dasbor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>@yield('title', 'Simanis') - Dasbor</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">
    
    
    @vite('resources/css/landing-page.css')

    
    @stack('styles')
</head>
<body>
    <div class="main-wrapper">
        <header>
            <div class="logo"><strong>Simanis</strong></div>
            <nav>
                <a href="{{ route('backend.beranda') }}" class="{{ request()->routeIs('backend.beranda') ? 'active' : '' }}">Home</a>
                <a href="{{ route('backend.transaksi.index')}}" class="{ request()->routeIs('backend.transaksi.index') ? 'active' : ''}}">Transaksi</a>
                <a href="{{ route('backend.barang.index') }}" class="{{ request()->routeIs('backend.barang.index') ? 'active' : '' }}">Stok</a>
                <a href="{{ route('backend.laporan.index') }}" class="{{ request()->routeIs('backend.laporan.index') ? 'active' : '' }}">Cetak Laba</a>
            </nav>
            <div class="user-section">
                
                @auth
                    <div class="user-profile">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,12.5c-3.04,0-5.5,1.73-5.5,3.92V18h11v-1.58C17.5,14.23,15.04,12.5,12,12.5z M12,2C9.24,2,7,4.24,7,7s2.24,5,5,5s5-2.24,5-5S14.76,2,12,2z"/></svg>
                        <span>{{ Auth::user()->namaUsaha }}</span>
                    </div>
                    
                @endauth
            </div>
        </header>

    
        <main class="main-content">
            @yield('content')
        </main>

        {{-- Footer ini juga identik dengan landing page --}}
        <footer class="footer">
            <div>© 2025 Simanis. Semua hak cipta dilindungi.</div>
            <div>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
            </div>
        </footer>
    </div>
    {{-- Untuk tambahan script jika ada halaman yg butuh JS khusus --}}
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>