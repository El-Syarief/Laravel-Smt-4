<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('backend.v_profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'namaUsaha' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,' . $user->idUser . ',idUser',
            'noTelp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        $userData = $request->only(['namaUsaha', 'email', 'noTelp', 'alamat']);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto) && $user->foto !== 'default-foto.png') {
                Storage::disk('public')->delete($user->foto);
            }
            $path = $request->file('foto')->store('avatars', 'public');
            $userData['foto'] = $path;
        }

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('backend.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }
}