<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Simanis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font & Link ke CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/landing-page.css', 'resources/css/register.css'])
</head>
<body>

{{-- NAVBAR BARU --}}
<header>
    <div class="logo">
        <a href="{{ route('landing.home') }}" style="text-decoration: none; color: inherit;"><strong>Simanis</strong></a>
    </div>
    <nav></nav>
    <div class="user-section">
        <span>Punya Akun?</span>
        <a href="{{ route('login') }}" class="btn-primary" style="padding: 8px 15px;">Masuk</a>
    </div>
</header>
{{-- AKHIR NAVBAR --}}

<div class="register-container">
    <div class="left">
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="simanis-logo">
    </div>

    <div class="right">
        <form class="form-container" method="POST" action="{{ route('backend.register') }}">
            @csrf
            <h2 style="margin-bottom: 30px;">Sign up</h2>

            <div class="form-group">
                <label for="email">Masukkan alamat email</label>
                <input type="email" name="email" id="email" required placeholder="email" value="{{ old('email') }}">
                @error('email') <div style="color:red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="namaUsaha">Nama Toko</label>
                    <input type="text" name="namaUsaha" id="namaUsaha" required placeholder="Nama Toko" value="{{ old('namaUsaha') }}">
                    @error('namaUsaha') <div style="color:red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="noTelp">No. HP</label>
                    <input type="tel" name="noTelp" id="noTelp" required placeholder="No. HP" value="{{ old('noTelp') }}">
                    @error('noTelp') <div style="color:red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">Masukkan Password</label>
                <input type="password" name="password" id="password" required placeholder="Password">
                @error('password') <div style="color:red; font-size: 12px; margin-top: 5px;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Ulangi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi Password">
            </div>

            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>
</div>

</body>
</html>