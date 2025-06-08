@extends('backend.v_layouts.app')

@section('title', 'Laporan Keuangan')

@push('styles')
    @vite('resources/css/manajemen-stok.css')
    <style>
        .money-in { color: #027A48; font-weight: 600; }
        .money-out { color: #B42318; font-weight: 600; }
        .card-header { padding-bottom: 20px; border-bottom: 1px solid var(--border-color); margin-bottom: 20px; }
        .card-header h2 { font-size: 20px; margin: 0; }
    </style>
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div><h1>Laporan Keuangan</h1><p>Riwayat Pemasukan dan Pengeluaran Anda</p></div>
        <a href="{{ route('backend.transaksi.index') }}" class="btn-add"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" /></svg>Buat Transaksi Baru</a>
    </div>

    {{-- KARTU UNTUK PEMASUKAN --}}
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header"><h2>Uang Masuk (Hasil Penjualan)</h2></div>
        <table class="stok-table">
            <thead><tr><th>TANGGAL</th><th>KETERANGAN</th><th style="text-align: right;">JUMLAH</th><th>AKSI</th></tr></thead>
            <tbody>
                @forelse($pemasukan as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggalTransaksi)->format('d M Y, H:i') }}</td>
                    <td>Penjualan #TRX-{{ $item->idTransaksi }}</td>
                    <td style="text-align: right;" class="money-in">+ Rp{{ number_format($item->totalHrgJual, 0, ',', '.') }}</td>
                    <td><a href="{{ route('backend.transaksi.show', $item->idTransaksi) }}" class="action-link">Detail</a></td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align: center; padding: 20px;">Belum ada data pemasukan.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-section">
            <div class="pagination-info">Menampilkan {{ $pemasukan->firstItem() ?? 0 }} sampai {{ $pemasukan->lastItem() ?? 0 }} dari {{ $pemasukan->total() }} hasil</div>
            <div class="pagination-buttons">
                @if ($pemasukan->onFirstPage())<span>Sebelumnya</span>@else<a href="{{ $pemasukan->previousPageUrl() }}">Sebelumnya</a>@endif
                @if ($pemasukan->hasMorePages())<a href="{{ $pemasukan->nextPageUrl() }}">Selanjutnya</a>@else<span>Selanjutnya</span>@endif
            </div>
        </div>
    </div>

    
    <div class="content-card">
        <div class="card-header"><h2>Uang Keluar (Pembelian Stok)</h2></div>
        <table class="stok-table">
            <thead><tr><th>TANGGAL</th><th>KETERANGAN</th><th style="text-align: right;">JUMLAH</th></tr></thead>
            <tbody>
                @forelse($pengeluaran as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y, H:i') }}</td>
                    <td>{{ $item->deskripsi }}</td>
                    <td style="text-align: right;" class="money-out">- Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td>
                        @if($item->tipe == 'penjualan')
                            <a href="{{ route('backend.transaksi.show', $item->id) }}" class="action-link">Detail</a>
                        @elseif($item->idBrg)
                            <a href="{{ route('backend.barang.edit', $item->idBrg) }}" class="action-link">Lihat Produk</a>
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align: center; padding: 20px;">Belum ada data pengeluaran.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-section">
            <div class="pagination-info">Menampilkan {{ $pengeluaran->firstItem() ?? 0 }} sampai {{ $pengeluaran->lastItem() ?? 0 }} dari {{ $pengeluaran->total() }} hasil</div>
            <div class="pagination-buttons">
                @if ($pengeluaran->onFirstPage())<span>Sebelumnya</span>@else<a href="{{ $pengeluaran->previousPageUrl() }}">Sebelumnya</a>@endif
                @if ($pengeluaran->hasMorePages())<a href="{{ $pengeluaran->nextPageUrl() }}">Selanjutnya</a>@else<span>Selanjutnya</span>@endif
            </div>
        </div>
    </div>
</div>
@endsection