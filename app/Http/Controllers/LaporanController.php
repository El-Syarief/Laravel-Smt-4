<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanController extends Controller
{
    public function index()
    {
        $idUser = Auth::id();

        
        $labaPerBulan = DB::table('transaksi')
            ->select(
                DB::raw('YEAR(tanggalTransaksi) as tahun'),
                DB::raw('MONTH(tanggalTransaksi) as bulan'),
                DB::raw('SUM(laba) as total_laba')
            )
            ->where('idUser', $idUser)
            ->groupBy('tahun', 'bulan');

        
        $bebanPerBulan = DB::table('pengeluaran')
            ->select(
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total_beban')
            )
            ->where('idUser', $idUser)
            ->groupBy('tahun', 'bulan');

        
        $laporan = DB::query()
            ->select('laporan.tahun', 'laporan.bulan', 'laba.total_laba', 'beban.total_beban')
            ->from(
                DB::raw('(SELECT tahun, bulan FROM (
                    SELECT YEAR(tanggalTransaksi) as tahun, MONTH(tanggalTransaksi) as bulan FROM transaksi WHERE idUser = ?
                    UNION
                    SELECT YEAR(tanggal) as tahun, MONTH(tanggal) as bulan FROM pengeluaran WHERE idUser = ?
                ) as periode) as laporan')
            )
            ->leftJoinSub($labaPerBulan, 'laba', function ($join) {
                $join->on('laporan.tahun', '=', 'laba.tahun')
                     ->on('laporan.bulan', '=', 'laba.bulan');
            })
            ->leftJoinSub($bebanPerBulan, 'beban', function ($join) {
                $join->on('laporan.tahun', '=', 'beban.tahun')
                     ->on('laporan.bulan', '=', 'beban.bulan');
            })
            
            ->setBindings([$idUser, $idUser])
            ->orderBy('laporan.tahun', 'desc')
            ->orderBy('laporan.bulan', 'desc')
            ->paginate(10);
            
        return view('backend.v_laporan.index', compact('laporan'));
    }

     public function showBebanForm(Request $request)
    {
        
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        
        $beban = Pengeluaran::where('idUser', Auth::id())
            ->whereNull('idBrg') 
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'desc')
            ->get();
            
        return view('backend.v_laporan.beban_index', compact('beban', 'bulan', 'tahun'));
    }

    
    public function storeBeban(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date_format:Y-m',
        ]);
        
        
        $tanggalBeban = $request->tanggal . '-01';

        Pengeluaran::create([
            'idUser' => Auth::id(),
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'tanggal' => $tanggalBeban,
            'idBrg' => null, 
        ]);

        return back()->with('success', 'Beban berhasil ditambahkan.');
    }

    public function editBeban(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->idUser !== Auth::id()) {
            abort(403);
        }
        return view('backend.v_laporan.beban_edit', compact('pengeluaran'));
    }

    public function updateBeban(Request $request, Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->idUser !== Auth::id()) {
            abort(403);
        }
        
        $request->validate([
            'deskripsi' => 'required|string|max:255',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $pengeluaran->update($request->only(['deskripsi', 'jumlah']));

        return redirect()->route('backend.laporan.beban.form')->with('success', 'Beban berhasil diperbarui.');
    }

     public function destroyBeban(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->idUser !== Auth::id()) {
            abort(403);
        }

        $pengeluaran->delete();

        return back()->with('success', 'Beban berhasil dihapus.');
    }

    public function DetailLaporan($tahun, $bulan)
    {
        $idUser = Auth::id();

        $pemasukan = Transaksi::where('idUser', $idUser)
            ->whereYear('tanggalTransaksi', $tahun)
            ->whereMonth('tanggalTransaksi', $bulan)
            ->orderBy('tanggalTransaksi', 'desc')
            ->get();
            
        
        $pengeluaran = Pengeluaran::where('idUser', $idUser)
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'desc')
            ->get();


        $totalPemasukan = $pemasukan->sum('totalHrgJual');
        $totalBeban = $pengeluaran->sum('jumlah');
        $labaBersih = $totalPemasukan - $totalBeban;

    
        return view('backend.v_laporan.detail_laporan', compact(
            'pemasukan',
            'pengeluaran',
            'totalPemasukan',
            'totalBeban',
            'labaBersih',
            'bulan',
            'tahun'
        ));
    }

    public function downloadPDF($tahun, $bulan)
    {
        $idUser = Auth::id();

        
        $pemasukan = Transaksi::where('idUser', $idUser)
            ->whereYear('tanggalTransaksi', $tahun)->whereMonth('tanggalTransaksi', $bulan)
            ->orderBy('tanggalTransaksi', 'desc')->get();
            
        $pengeluaran = Pengeluaran::where('idUser', $idUser)
            ->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan)
            ->orderBy('tanggal', 'desc')->get();

        $totalPemasukan = $pemasukan->sum('totalHrgJual');
        $totalBeban = $pengeluaran->sum('jumlah');
        $labaBersih = $totalPemasukan - $totalBeban;

        $data = [
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'totalPemasukan' => $totalPemasukan,
            'totalBeban' => $totalBeban,
            'labaBersih' => $labaBersih,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ];

        
        $namaBulan = \Carbon\Carbon::create()->month($bulan)->translatedformat('F');
        $namaFile = "laporan_{$namaBulan}_{$tahun}.pdf";

        
        $pdf = Pdf::loadView('backend.v_laporan.pdf_template', $data);
        return $pdf->download($namaFile);
    }
}