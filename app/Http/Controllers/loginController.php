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

        // if (Auth::attempt($credentials)) {
        //     if (Auth::user()->status == 0) {
        //         Auth::logout();
        //         return back()->with('error', 'User belum aktif');
        //     }
        //     $request->session()->regenerate();
        //     return redirect()->intended(route('backend.beranda'));
        // }
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
            ]);

            $validateData['name'] = 'contoh nama'; 
            $validateData['status'] = 0; // Misalnya, akun belum aktif secara default
            $validateData['password'] = bcrypt($validateData['password']);
            $validateData['created_at'] = now();
            $validateData['updated_at'] = now();
            $validatedData['noTelp'] = '08xxxxxxxxx';
            $validatedData['alamat'] = 'contoh alamat';
            $validatedData['foto'] = 'default-foto.png';
            $validatedData['qrCode'] = 'www.example.com/qr-code.png';

            $user = User::create($validatedData);

            $user->save();

            return redirect()->route('backend.login')->with('success', 'Registrasi berhasil! Silakan login.');
        }


        return view('backend.v_login.register', [
            'judul' => 'Register',
        ]);
    }
}
