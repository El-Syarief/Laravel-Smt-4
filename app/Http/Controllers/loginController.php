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
    public function authenticateBackend(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::validate($credentials)) {
            return back()->with('error', 'Email atau password tidak sesuai');
        }

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == 'nonaktif') {
                Auth::logout();
                return back()->with('error', 'User belum aktif');
            }
            $request->session()->regenerate();
            return redirect()->intended(route('backend.beranda'));
        }
        return back()->with('error', 'Login Gagal');
    }

    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect(route('backend.login'));
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
            $validateData['password'] = bcrypt($validateData['password']);
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
