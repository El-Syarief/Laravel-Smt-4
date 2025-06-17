<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | Controller ini bertanggung jawab untuk menangani permintaan reset password
    | dan mengirimkan tautan reset melalui email ke pengguna.
    |
    */

    /**
     * Menampilkan form untuk meminta tautan reset password.
     */
    public function showLinkRequestForm()
    {
        return view('backend.v_login.password.email');
    }

    /**
     * Mengirim tautan reset password ke email pengguna.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $credentials= $request->validate(['email' => 'required|email']);

        // Kita akan mencoba mengirim tautan reset password ke pengguna.
        $status = Password::sendResetLink($credentials);

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Menampilkan form untuk mereset password.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('backend.v_login.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Mereset password pengguna.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}