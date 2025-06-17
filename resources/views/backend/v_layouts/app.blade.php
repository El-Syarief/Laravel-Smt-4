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
                    <a href="{{ route('backend.profile.index') }}" class="user-profile" style="text-decoration: none; color: white; display: flex; align-items: center; gap: 10px;">
                        @if (Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                        @else
                        <img src="{{ asset('storage/avatars/profile-default.png') }}"
                            alt="Foto Profil" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                        @endif
                        <span>{{ Auth::user()->namaUsaha }}</span>
                    </a>
                    <form action="{{ route('backend.logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: white; cursor: pointer; font-weight: 500; padding: 5px 10px; font-size: 16px;">Logout</button>
                    </form>
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