@extends('backend.v_layouts.app')

@section('title', 'Detail Transaksi')

@push('styles')
    @vite('resources/css/manajemen-stok.css')
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div>
            <h1>Detail Transaksi #TRX-{{ $transaksi->idTransaksi }}</h1>
            <p>Tanggal: {{ \Carbon\Carbon::parse($transaksi->tanggalTransaksi)->format('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('backend.transaksi.history') }}" class="btn-secondary">Kembali ke Riwayat</a>
    </div>

    <div class="content-card">
        <h3>Item yang Dibeli</h3>
        <table class="stok-table">
            <thead>
                <tr>
                    <th>NAMA PRODUK</th>
                    <th style="text-align: right;">HARGA SATUAN</th>
                    <th style="text-align: center;">JUMLAH</th>
                    <th style="text-align: right;">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->details as $detail)
                <tr>
                    <td>{{ $detail->barang->namaBrg ?? 'Produk Dihapus' }}</td>
                    <td style="text-align: right;">Rp{{ number_format($detail->hrgJualSatuan, 0, ',', '.') }}</td>
                    <td style="text-align: center;">x {{ $detail->jumlah }}</td>
                    <td style="text-align: right;">Rp{{ number_format($detail->hrgJualSatuan * $detail->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary-section">
            <div class="summary-item"><span>Subtotal</span> <span>Rp{{ number_format($transaksi->totalHrgJual / 1.11, 0, ',', '.') }}</span></div>
            <div class="summary-item"><span>Pajak (11%)</span> <span>Rp{{ number_format($transaksi->totalHrgJual - ($transaksi->totalHrgJual / 1.11), 0, ',', '.') }}</span></div>
            <div class="summary-item total"><span>Total Pembayaran</span> <span>Rp{{ number_format($transaksi->totalHrgJual, 0, ',', '.') }}</span></div>
            <hr>
            <div class="summary-item"><span>Uang Dibayar</span> <span>Rp{{ number_format($transaksi->uangDibayar, 0, ',', '.') }}</span></div>
            <div class="summary-item"><span>Uang Kembali</span> <span>Rp{{ number_format($transaksi->uangKembalian, 0, ',', '.') }}</span></div>
            <hr>
            <div class="summary-item laba"><span>Perkiraan Laba</span> <span>Rp{{ number_format($transaksi->laba, 0, ',', '.') }}</span></div>
        </div>
    </div>
</div>

<style>
    .summary-section { max-width: 400px; margin-left: auto; margin-top: 24px; }
    .summary-item { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
    .summary-item.total { font-weight: 800; font-size: 16px; }
    .summary-item.laba { font-weight: 600; color: #027A48; }
    hr { border: none; border-top: 1px solid #EAECF0; margin: 16px 0; }
</style>
@endsection
