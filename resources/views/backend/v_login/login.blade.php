<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Simanis</title>
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
        <a href="{{ route('backend.register') }}" class="btn-primary" style="padding: 8px 15px;">Daftar</a>
    </div>
</header>

<div class="login-container">
    <div class="left">
        <div>
            <p style="font-size: 20px;">Welcome!</p>
            <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="simanis-logo">
        </div>
    </div>
    <div class="right">
        <form class="form-container" method="POST" action="{{ route('login') }}">
            @csrf
            @if(session('error'))
                <div style="background-color: #ffcccc; border: 1px solid red; color: red; padding: 10px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif
            <div class="form-group">
                <label for="email">Masukkan alamat email</label>
                <input type="email" name="email" id="email" required placeholder="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Masukkan Password</label>
                <input type="password" name="password" id="password" required placeholder="Password">
                <div class="link"><a href="#">Lupa Password?</a></div>
            </div>
            <button type="submit" class="btn-action">Masuk</button>
        </form>
    </div>
</div>

</body>
</html>