<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Simanis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font dan CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #7d8c89;
            display: flex;
            height: 100vh;
        }
        .left, .right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .left {
            flex-direction: column;
            text-align: center;
        }
        .left img {
            width: 200px;
        }
        .right {
            background-color: #7d8c89;
        }
        .form-container {
            width: 80%;
            max-width: 400px;
            background: transparent;
        }
        .form-group {
            margin-bottom: 20px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-primary {
            background-color: #29464f;
            color: white;
        }
        .link {
            text-align: right;
            font-size: 0.9em;
            color: #e8c15f;
        }
    </style>
</head>
<body>

    <div class="left">
        <p style="font-size: 20px;">Welcome!</p>
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="simanis-logo">
    </div>

    <div class="right">
        {{-- Pastikan action-nya memanggil route 'login' --}}
        <form class="form-container" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Masukkan alamat email</label>
                <input type="email" name="email" id="email" required placeholder="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Masukkan Password</label>
                <input type="password" name="password" id="password" required placeholder="Password">
                <div class="link">
                    <a href="#" style="text-decoration: none;">Forgot Password</a>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
            <a href="{{ route('backend.register') }}">
                <button type="button" class="btn btn-primary" style="margin-top: 10px;">Sign up</button>
            </a>
        </form>
    </div>

</body>
</html>