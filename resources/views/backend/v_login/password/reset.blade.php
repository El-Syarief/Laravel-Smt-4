<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password | Simanis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet">

    @vite(['resources/css/landing-page.css', 'resources/css/login.css'])
</head>
<body>

<header>
    <div class="logo">
        <a href="{{ route('landing.home') }}" style="text-decoration: none; color: inherit;"><strong>Simanis</strong></a>
    </div>
</header>

<div class="login-container">
    <div class="left">
        <div>
             <p style="font-size: 20px;">Atur Ulang Password</p>
            <p style="font-size: 14px; color: #667085; max-width: 300px; line-height: 1.5;">Buat kata sandi baru yang kuat. Pastikan Anda tidak melupakannya lagi.</p>
            <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="simanis-logo" style="opacity: 0.5;">
        </div>
    </div>
    <div class="right">
        <form class="form-container" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <h3 style="margin-top:0; font-weight: 600;">Buat Password Baru</h3>
            
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" required placeholder="email@contoh.com" value="{{ old('email', $request->email) }}">
                @error('email')
                    <span style="color: #B42318; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" required placeholder="Password baru">
                 @error('password')
                    <span style="color: #B42318; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="btn-action">Reset Password</button>
        </form>
    </div>
</div>

</body>
</html>