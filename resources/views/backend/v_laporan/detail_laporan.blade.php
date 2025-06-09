@extends('backend.v_layouts.app')
@section('title', 'Detail Laporan')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
    @vite('resources/css/laporan.css')
    <style>
        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 30px;
        }
        .summary-card {
            background-color: var(--card-background);
            padding: 24px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }
        .summary-card .title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 8px;
        }
        .summary-card .amount {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-dark);
        }
        .summary-card .amount.profit { color: #027A48; }
        .summary-card .amount.expense { color: #B42318; }

        .details-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: flex-start;
        }
    </style>
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div>
            <h1>Detail Laporan - {{ \Carbon\Carbon::create()->month($bulan)->translatedformat('F') }} {{ $tahun }}</h1>
            <p>Rincian pemasukan dan pengeluaran Anda</p>
        </div>
        <a href="{{ route('backend.laporan.index') }}" class="btn-secondary">Kembali ke Laporan</a>
    </div>

    {{-- KARTU RINGKASAN --}}
    <div class="summary-cards">
        <div class="summary-card">
            <div class="title">Total Pemasukan</div>
            <div class="amount profit">+ Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>
        <div class="summary-card">
            <div class="title">Total Beban</div>
            <div class="amount expense">- Rp{{ number_format($totalBeban, 0, ',', '.') }}</div>
        </div>
        <div class="summary-card">
            <div class="title">Laba Bersih</div>
            <div class="amount">Rp{{ number_format($labaBersih, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="details-layout">
        <div class="content-card">
            <div class="card-header"><h2>Rincian Pemasukan</h2></div>
            <table class="stok-table">
                <thead><tr><th>ID</th><th>Tanggal</th><th style="text-align: right;">Jumlah</th></tr></thead>
                <tbody>
                    @forelse ($pemasukan as $item)
                        <tr>
                            <td><a href="{{ route('backend.transaksi.show', $item->idTransaksi) }}" class="action-link">#TRX-{{ $item->idTransaksi }}</a></td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggalTransaksi)->format('d/m/Y H:i') }}</td>
                            <td style="text-align: right;">Rp{{ number_format($item->totalHrgJual, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center p-4">Tidak ada pemasukan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

       
        <div class="content-card">
            <div class="card-header"><h2>Rincian Pengeluaran</h2></div>
            <table class="stok-table">
                <thead><tr><th>Deskripsi</th><th style="text-align: right;">Jumlah</th></tr></thead>
                <tbody>
                    @forelse ($pengeluaran as $item)
                        <tr>
                            <td>{{ $item->deskripsi }}</td>
                            <td style="text-align: right;">Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center p-4">Tidak ada pengeluaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection