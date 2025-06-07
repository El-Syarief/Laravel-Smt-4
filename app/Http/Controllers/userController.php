<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()//METHOD KHUSUS ADMIN UNTUK MENAMPILKAN DATA USER
    {
        $users = User::all();
        return view('backend.user.index', compact('users'));
    }

    public function create()//METHOD KHUSUS ADMIN UNTUK MENAMPILKAN FORM TAMBAH USER
    {
        return view('backend.user.create');
    }

    public function store(Request $request)//METHOD KHUSUS ADMIN UNTUK MENYIMPAN DATA USER BARU
    {
        $request->validate([
            'namaUsaha' => 'nullable|string|max:100',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6|confirmed',
            'noTelp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|url',
            'qrCode' => 'nullable|url',
            'role' => 'required|in:admin,user',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        User::create([
            'namaUsaha' => $request->namaUsaha,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'noTelp' => $request->noTelp,
            'alamat' => $request->alamat,
            'foto' => $request->foto,
            'qrCode' => $request->qrCode,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('backend.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function show($id)//METHOD ADMIN DAN USER UNTUK MENAMPILKAN DETAIL PROFILE USER
    {
        $user = User::findOrFail($id);
        return view('backend.user.show', compact('user'));
    }

    public function edit($id)//METHOD ADMIN DAN USER UNTUK MENAMPILKAN FORM EDIT USER
    {
        $user = User::findOrFail($id);

        // Batasi: hanya admin atau user yang edit dirinya sendiri
        if (Auth::user()->idUser !== $user->idUser && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, $id)//METHOD ADMIN DAN USER UNTUK MEMPERBARUI DATA USER
    {
        $user = User::findOrFail($id);

        // Batasi: hanya admin atau user yang update dirinya sendiri
        if (Auth::user()->idUser !== $user->idUser && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'namaUsaha' => 'nullable|string|max:100',
            'email' => 'required|email|unique:user,email,' . $user->idUser . ',idUser',
            'password' => 'nullable|min:6|confirmed',
            'noTelp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'foto' => 'nullable|url',
            'qrCode' => 'nullable|url',
            'role' => 'in:admin,user',
            'status' => 'in:aktif,nonaktif',
        ]);

        $user->update([
            'namaUsaha' => $request->namaUsaha,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'noTelp' => $request->noTelp,
            'alamat' => $request->alamat,
            'foto' => $request->foto,
            'qrCode' => $request->qrCode,
            'role' => $request->role ?? $user->role,
            'status' => $request->status ?? $user->status,
        ]);

        return redirect()->route('backend.user.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)//METHOD ADMIN UNTUK MENGHAPUS USER
    {
        $user = User::findOrFail($id);

        // Admin tidak boleh hapus dirinya sendiri
        if (Auth::user()->idUser === $user->idUser) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        $user->delete();
        return redirect()->route('backend.user.index')->with('success', 'User berhasil dihapus');
    }
}