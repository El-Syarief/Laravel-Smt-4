<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Pengeluaran;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function berandaBackend(Request $request)
    {
        $idUser = Auth::id();
        $periode = $request->input('periode', '6_bulan');
        $labelKartu = "Bulan Ini";

    
        $labaBersihHariIni = Transaksi::where('idUser', $idUser)->whereDate('tanggalTransaksi', Carbon::today())->sum('laba') - Pengeluaran::where('idUser', $idUser)->whereDate('tanggal', Carbon::today())->sum('jumlah');
        $totalLabaDariPenjualan = Transaksi::where('idUser', $idUser)->sum('laba');
        $totalBebanOperasional = Pengeluaran::where('idUser', $idUser)->whereNull('idBrg')->sum('jumlah');
        $labaBersihTotal = $totalLabaDariPenjualan - $totalBebanOperasional;
        $jumlahProduk = Barang::where('idUser', $idUser)->count();

        $labels = [];
        $dataPemasukan = [];
        $dataPengeluaran = [];
        if ($periode == '1_bulan') {
            for ($i = 29; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $labels[] = $date->format('d M');
                $dataPemasukan[] = Transaksi::where('idUser', $idUser)->whereDate('tanggalTransaksi', $date->format('Y-m-d'))->sum('totalHrgJual');
                $dataPengeluaran[] = Pengeluaran::where('idUser', $idUser)->whereDate('tanggal', $date->format('Y-m-d'))->sum('jumlah');
            }
        } elseif ($periode == '1_tahun') {
            for ($i = 11; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->translatedformat('M Y');
                $pemasukanBulanan = Transaksi::where('idUser', $idUser)->whereYear('tanggalTransaksi', $date->year)->whereMonth('tanggalTransaksi', $date->month)->sum('totalHrgJual');
                $pengeluaranBulanan = Pengeluaran::where('idUser', $idUser)->whereYear('tanggal', $date->year)->whereMonth('tanggal', $date->month)->sum('jumlah');
                $dataPemasukan[] = $pemasukanBulanan;
                $dataPengeluaran[] = $pengeluaranBulanan;
            }
        } else { // Default 6 bulan
            for ($i = 5; $i >= 0; $i--) {
                $date = Carbon::now()->subMonths($i);
                $labels[] = $date->translatedformat('M Y');
                $pemasukanBulanan = Transaksi::where('idUser', $idUser)->whereYear('tanggalTransaksi', $date->year)->whereMonth('tanggalTransaksi', $date->month)->sum('totalHrgJual');
                $pengeluaranBulanan = Pengeluaran::where('idUser', $idUser)->whereYear('tanggal', $date->year)->whereMonth('tanggal', $date->month)->sum('jumlah');
                $dataPemasukan[] = $pemasukanBulanan;
                $dataPengeluaran[] = $pengeluaranBulanan;
            }
        }

        
        $recentSales = Transaksi::where('idUser', $idUser)->latest('tanggalTransaksi')->take(5)->get();
        $recentExpenses = Pengeluaran::where('idUser', $idUser)->latest('tanggal')->take(5)->get();
        
        return view('backend.v_beranda.beranda', [
            'labaBersihHariIni' => $labaBersihHariIni,
            'labaBersihTotal' => $labaBersihTotal,
            'jumlahProduk' => $jumlahProduk,
            'chartLabels' => $labels,
            'chartPemasukan' => $dataPemasukan,
            'chartPengeluaran' => $dataPengeluaran,
            'periode' => $periode,
            'recentSales' => $recentSales, 
            'recentExpenses' => $recentExpenses, 
        ]);
    }
}