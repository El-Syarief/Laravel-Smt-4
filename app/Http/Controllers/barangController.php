<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->get();
        return view('backend.v_barang.index', compact('barang'));
    }

    public function create()
    {
        return view('backend.v_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Ubah validasi untuk foto menjadi 'image'
            'fotoBrg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'namaBrg' => 'required|max:100',
            'kodeBrg' => 'required|unique:barang,kodeBrg',
            'stokBrg' => 'nullable|integer|min:0',
            'hrgModal' => 'nullable|numeric',
            'hrgJual' => 'nullable|numeric',
        ]);

        $path = null;
        if ($request->hasFile('fotoBrg')) {
            // Simpan file di folder 'public/products' dan dapatkan path-nya
            $path = $request->file('fotoBrg')->store('products', 'public');
        }

        Barang::create([
            'idUser' => Auth::user()->idUser,
            'fotoBrg' => $path, // Simpan path file ke database
            'namaBrg' => $request->namaBrg,
            'kodeBrg' => $request->kodeBrg,
            'stokBrg' => $request->stokBrg,
            'hrgModal' => $request->hrgModal,
            'hrgJual' => $request->hrgJual,
        ]);

        return redirect()->route('backend.barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->findOrFail($id);
        return view('backend.v_barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->findOrFail($id);

        $request->validate([
            'fotoBrg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // foto tidak wajib diisi saat update
            'namaBrg' => 'required|max:100',
            'kodeBrg' => 'required|unique:barang,kodeBrg,' . $barang->idBrg . ',idBrg',
            'stokBrg' => 'nullable|integer|min:0',
            'hrgModal' => 'nullable|numeric',
            'hrgJual' => 'nullable|numeric',
        ]);
        
        $path = $barang->fotoBrg; // Path default adalah path foto lama
        if ($request->hasFile('fotoBrg')) {
            // Jika ada file baru diupload, hapus file lama
            if ($barang->fotoBrg) {
                Storage::disk('public')->delete($barang->fotoBrg);
            }
            // Simpan file baru dan perbarui path
            $path = $request->file('fotoBrg')->store('products', 'public');
        }

        $barang->update([
            'fotoBrg' => $path,
            'namaBrg' => $request->namaBrg,
            'kodeBrg' => $request->kodeBrg,
            'stokBrg' => $request->stokBrg,
            'hrgModal' => $request->hrgModal,
            'hrgJual' => $request->hrgJual,
        ]);

        return redirect()->route('backend.barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->findOrFail($id);
        
        if ($barang->fotoBrg) {
            Storage::disk('public')->delete($barang->fotoBrg);
        }
        
        $barang->delete();

        return redirect()->route('backend.barang.index')->with('success', 'Barang berhasil dihapus');
    }
}