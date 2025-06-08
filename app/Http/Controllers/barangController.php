<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::where('idUser', Auth::user()->idUser)->paginate(10);
        return view('backend.v_barang.index', compact('barang'));
    }

    public function create()
    {
        return view('backend.v_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fotoBrg' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'namaBrg' => 'required|max:100',
            'kodeBrg' => 'required|unique:barang,kodeBrg',
            'stokBrg' => 'required|integer|min:1',
            'hrgModal' => 'required|numeric|min:0',
            'hrgJual' => 'required|numeric|min:0',
        ]);

        $path = $request->file('fotoBrg')->store('products', 'public');

        $barang = Barang::create([
            'idUser' => Auth::user()->idUser,
            'fotoBrg' => $path,
            'namaBrg' => $request->namaBrg,
            'kodeBrg' => $request->kodeBrg,
            'stokBrg' => $request->stokBrg,
            'hrgModal' => $request->hrgModal,
            'hrgJual' => $request->hrgJual,
        ]);

        $totalBiayaModal = $request->hrgModal * $request->stokBrg;

        Pengeluaran::create([
            'idUser' => Auth::id(),
            'deskripsi' => 'Pembelian stok: ' . $barang->namaBrg . ' (x' . $barang->stokBrg . ')',
            'jumlah' => $totalBiayaModal,
            'tanggal' => now(),
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
            'fotoBrg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'namaBrg' => 'required|max:100',
            'kodeBrg' => 'required|unique:barang,kodeBrg,' . $barang->idBrg . ',idBrg',
            'stokBrg' => 'nullable|integer|min:0',
            'hrgModal' => 'nullable|numeric',
            'hrgJual' => 'nullable|numeric',
        ]);
        
        $path = $barang->fotoBrg;
        if ($request->hasFile('fotoBrg')) {
            if ($barang->fotoBrg) {
                Storage::disk('public')->delete($barang->fotoBrg);
            }
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

     public function showAddStockForm(Barang $barang)
    {
        
        if ($barang->idUser !== Auth::id()) {
            abort(403);
        }
        return view('backend.v_barang.add-stock', compact('barang'));
    }

    public function addStock(Request $request, Barang $barang)
    {
        
        if ($barang->idUser !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'jumlah_tambah' => 'required|integer|min:1',
            'harga_modal_baru' => 'required|numeric|min:0'
        ]);

        
        $totalBiaya = $validated['jumlah_tambah'] * $validated['harga_modal_baru'];
        
        
        Pengeluaran::create([
            'idUser' => Auth::id(),
            'deskripsi' => 'Penambahan stok: ' . $barang->namaBrg . ' (x' . $validated['jumlah_tambah'] . ')',
            'jumlah' => $totalBiaya,
            'tanggal' => now(),
            'idBrg' => $barang->idBrg,
        ]);

        
        $barang->hrgModal = $validated['harga_modal_baru'];
        $barang->increment('stokBrg', $validated['jumlah_tambah']);
        $barang->save();

            return redirect()->route('backend.barang.index')->with('success', 'Stok berhasil ditambahkan!');
        }
    }