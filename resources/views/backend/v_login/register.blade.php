<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | Simanis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Font & Style --}}
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
            color: #111;
            position: relative;
        }
        .form-container {
            width: 90%;
            max-width: 500px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="email"], input[type="password"], input[type="text"], input[type="tel"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 14px;
        }
        .form-row {
            display: flex;
            gap: 20px;
        }
        .form-row input {
            flex: 1;
        }
        .btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #29464f;
            color: white;
        }
        .top-right {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 0.9em;
        }
        .top-right a {
            color: #f3c24b;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }
    </style>
</head>
<body>

    <div class="left">
        <img src="{{ asset('backend/images/SIMANIS-no-bg.png') }}" alt="simanis-logo">
        <!-- <h2 style="margin-top: 10px;"><span style="color:#29464f;">si</span><span style="color:#f3c24b;">manis</span></h2> -->
    </div>

    <div class="right">
        <div class="top-right">
            Have an Account?
            <a href="{{ route('backend.login') }}">Sign in</a>
        </div>

        <form class="form-container" method="POST" action="{{ route('backend.register') }}">
            @csrf
            <h2 style="margin-bottom: 30px;">Sign up</h2>

            <div class="form-group">
                <label for="email">Masukkan alamat email</label>
                <input type="email" name="email" id="email" required placeholder="email" value="{{ old('email') }}">
                @error('email') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="namaUsaha">Nama Toko</label>
                    <input type="text" name="namaUsaha" id="namaUsaha" required placeholder="Nama Toko" value="{{ old('namaUsaha') }}">
                    @error('namaUsaha') <div style="color:red">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="noTelp">No. HP</label>
                    <input type="tel" name="noTelp" id="noTelp" required placeholder="No. HP" value="{{ old('noTelp') }}">
                    @error('noTelp') <div style="color:red">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">Masukkan Password</label>
                <input type="password" name="password" id="password" required placeholder="Password">
                @error('password') <div style="color:red">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Ulangi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi Password">
            </div>

            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>

</body>
</html>
