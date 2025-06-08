<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class loginController extends Controller
{
    public function loginBackend()
    {
        return view('backend.v_login.login', [
            'judul' => 'Login',
        ]);
    }
    // app/Http/Controllers/loginController.php

public function authenticateBackend(Request $request)
{
    // 1. Validasi input dari form login
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // 2. Langsung coba untuk melakukan login dengan kredensial yang diberikan
    // Auth::attempt() sudah otomatis memeriksa email dan password ke database
    if (Auth::attempt($credentials)) {
        
        // 3. Setelah login berhasil, periksa apakah status user aktif
        if (Auth::user()->status == 'nonaktif') {
            // Jika tidak aktif, paksa logout kembali, hancurkan sesi, dan beri pesan error
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->with('error', 'Akun Anda belum aktif. Silakan hubungi administrator.');
        }

        // 4. Jika user aktif, amankan sesi dan arahkan ke halaman dasbor
        $request->session()->regenerate();

        return redirect()->intended(route('backend.beranda'));
    }

    // 5. Jika Auth::attempt() gagal (email atau password salah), kembali ke halaman login dengan pesan error
    return back()->withErrors([
        'email' => 'Login gagal! Email atau Password yang Anda masukkan tidak sesuai.',
    ])->onlyInput('email');
}

    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();


        return redirect(route('login'));
    }

    public function registerBackend(Request $request)
    {
        if ($request->isMethod('post')) {
            $validateData =  $request->validate([
                'email' => 'required|email|unique:user',
                'password' => 'required|min:6|confirmed',
                'namaUsaha' => 'required|string|max:100',
                'noTelp' => 'required|string|max:20',
            ]);
            $validateData['namaUsaha'] = $request->namaUsaha;
            $validateData['noTelp'] = $request->noTelp;
            $validateData['email'] = $request->email;
            $validateData['password'] = $request->password;
            $validateData['status'] = 'aktif';
            $validateData['role'] = 'user';
            $validateData['alamat'] = 'contoh alamat';
            $validateData['foto'] = 'default-foto.png';
            $validateData['qrCode'] = 'www.example.com/qr-code.png';
            $validateData['created_at'] = now();
            $validateData['updated_at'] = now();

            $user = User::create($validateData);

            $user->save();

            return redirect()->route('backend.login')->with('success', 'Registrasi berhasil! Silakan login.');
        }


        return view('backend.v_login.register', [
            'judul' => 'Register',
        ]);
    }
}
