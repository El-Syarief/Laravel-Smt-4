<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan - {{ \Carbon\Carbon::create()->month($bulan)->translatedformat('F') }} {{ $tahun }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; }
        .summary-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; background-color: #f9f9f9; }
        .summary-table td { padding: 8px; border: 1px solid #ddd; }
        .summary-table .label { font-weight: bold; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .data-table th, .data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .data-table th { background-color: #f2f2f2; font-weight: bold; }
        .text-right { text-align: right !important; }
        .money-in { color: green; }
        .money-out { color: red; }
        .footer { text-align: center; font-size: 10px; color: #777; position: fixed; bottom: 0; width: 100%; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Keuangan Bulanan</h1>
        <p><strong>Periode:</strong> {{ \Carbon\Carbon::create()->month($bulan)->translatedformat('F') }} {{ $tahun }}</p>
    </div>

    <h3>Ringkasan</h3>
    <table class="summary-table">
        <tr>
            <td class="label">Total Pemasukan</td>
            <td class="text-right">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Total Beban</td>
            <td class="text-right">Rp{{ number_format($totalBeban, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Laba Bersih</td>
            <td class="text-right"><strong>Rp{{ number_format($labaBersih, 0, ',', '.') }}</strong></td>
        </tr>
    </table>

    <h3>Rincian Pemasukan (Penjualan)</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>ID Transaksi</th>
                <th class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemasukan as $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tanggalTransaksi)->format('d/m/Y H:i') }}</td>
                <td>#TRX-{{ $item->idTransaksi }}</td>
                <td class="text-right money-in">+ Rp{{ number_format($item->totalHrgJual, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="3" style="text-align: center;">Tidak ada data pemasukan.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Rincian Pengeluaran (Beban)</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th class="text-right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaran as $item)
            <tr>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y H:i') }}</td>
                <td>{{ $item->deskripsi }}</td>
                <td class="text-right money-out">- Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="3" style="text-align: center;">Tidak ada data pengeluaran.</td></tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="footer">
        Laporan ini dibuat secara otomatis oleh sistem Simanis pada {{ now()->format('d M Y, H:i') }}.
    </div>
</body>
</html>