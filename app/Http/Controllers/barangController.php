<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->get();
        return view('backend.v_barang.index', compact('barang'));
    }

    public function create()
    {
        return view('backend.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fotoBrg' => 'required|url',
            'namaBrg' => 'required|max:100',
            'kodeBrg' => 'required|unique:barang,kodeBrg',
            'stokBrg' => 'nullable|integer|min:0',
            'hrgModal' => 'nullable|numeric',
            'hrgJual' => 'nullable|numeric',
        ]);

        Barang::create([
            'idUser' => Auth::user()->idUser,
            'fotoBrg' => $request->fotoBrg,
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
        return view('backend.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->findOrFail($id);

        $request->validate([
            'fotoBrg' => 'required|url',
            'namaBrg' => 'required|max:100',
            'kodeBrg' => 'required|unique:barang,kodeBrg,' . $barang->idBrg . ',idBrg',
            'stokBrg' => 'nullable|integer|min:0',
            'hrgModal' => 'nullable|numeric',
            'hrgJual' => 'nullable|numeric',
        ]);

        $barang->update($request->all());

        return redirect()->route('backend.barang.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->findOrFail($id);
        $barang->delete();

        return redirect()->route('backend.barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
