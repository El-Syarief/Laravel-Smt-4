<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | Simanis</title>
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
    <nav></nav>
    <div class="user-section">
        <a href="{{ route('login') }}" style="text-decoration: none; color: white; font-weight: 500;">Login</a>
    </div>
</header>

<div class="login-container">
    <div class="left">
        <div>
            <p style="font-size: 20px;">Lupa Password?</p>
            <p style="font-size: 14px; color: #667085; max-width: 300px; line-height: 1.5;">Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.</p>
            <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="simanis-logo" style="opacity: 0.5;">
        </div>
    </div>
    <div class="right">
        <form class="form-container" method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <h3 style="margin-top:0; font-weight: 600;">Reset Password</h3>

            @if (session('status'))
                <div style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: center;">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" id="email" required autofocus placeholder="emailanda@contoh.com" value="{{ old('email') }}">
                @error('email')
                    <span style="color: #B42318; font-size: 12px; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn-action">Kirim Link Reset Password</button>
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('login') }}" style="color: #2d78db; text-decoration: none; font-size: 14px;">Kembali ke Login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>