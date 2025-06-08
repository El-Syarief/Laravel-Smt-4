<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 

class TransaksiController extends Controller
{
    public function index()
    {
        $products = Barang::where('idUser', Auth::user()->idUser)->get();

        $lastTransaction = Transaksi::latest('idTransaksi')->first();

        $nextTransactionId = $lastTransaction ? $lastTransaction->idTransaksi + 1:1;

        return view('backend.v_transaksi.index', compact('products', 'nextTransactionId'));
    }

    
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'total_pembayaran' => 'required|numeric',
            'uang_dibayar' => 'required|numeric',
            'uang_kembalian' => 'required|numeric',
            'items' => 'required|array|min:1'
        ]);

        try {
           
            DB::beginTransaction();

            $totalHrgModal = 0;
            foreach ($validatedData['items'] as $item) {
                $barang = Barang::find($item['id']);
                $totalHrgModal += $barang->hrgModal * $item['quantity'];
            }
            
            
            $transaksi = Transaksi::create([
                'idUser' => Auth::id(),
                'totalHrgJual' => $validatedData['total_pembayaran'],
                'totalHrgModal' => $totalHrgModal,
                'laba' => $validatedData['total_pembayaran'] - $totalHrgModal,
                'uangDibayar' => $validatedData['uang_dibayar'],
                'uangKembalian' => $validatedData['uang_kembalian'],
                'tanggalTransaksi' => now()
            ]);

            
            foreach ($validatedData['items'] as $item) {
                $barang = Barang::find($item['id']);
                if ($barang) {
                    TransaksiDetail::create([
                        'idTransaksi' => $transaksi->idTransaksi,
                        'idBrg' => $item['id'],
                        'jumlah' => $item['quantity'],
                        'hrgJualSatuan' => $item['price'],
                        'hrgModalSatuan' => $barang->hrgModal
                    ]);

                    
                    $barang->decrement('stokBrg', $item['quantity']);
                }
            }

            
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Transaksi berhasil disimpan!']);

        } catch (\Exception $e) {
            
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan transaksi.'], 500);
        }
    }

    public function history()
    {
        $idUser = Auth::id();

        $pemasukan = Transaksi::where('idUser', $idUser)
            ->orderBy('tanggalTransaksi', 'desc')
            ->paginate(5, ['*'], 'pemasukan_page');
        
        $pengeluaran = Pengeluaran::where('idUser', $idUser)
            ->orderBy('tanggal', 'desc')
            ->paginate(5, ['*'], 'pengeluaran_page');
        
        $riwayat = $pemasukan->concat($pengeluaran);

        $riwayat = $riwayat->sortByDesc('tanggal');

        $perPage = 10;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage('page');
        $currentPageItems = $riwayat->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $transaksis = new \Illuminate\Pagination\LengthAwarePaginator($currentPageItems, count($riwayat), $perPage, $currentPage, [
            'path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()
        ]);

        $transaksis = Transaksi::where('idUser', Auth::id())
        ->orderBy('tanggalTransaksi','desc')
        ->paginate(10);
        return view('backend.v_transaksi.history', compact('pemasukan','pengeluaran'));
    }

    public function show(Transaksi $transaksi)
    {
        if($transaksi->idUser !== Auth::id()) {
            abort(403,'Akses DITOLAK');
        }

        $transaksi->load('details.barang');
        return view('backend.v_transaksi.show', compact('transaksi'));
    }
}