@extends('backend.v_layouts.app')
@section('title', 'Dasbor')
@push('styles')
    @vite(['resources/css/manajemen-stok.css', 'resources/css/dashboard.css'])
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div><h1>Dasbor</h1><p>Selamat Datang Kembali, {{ Auth::user()->namaUsaha }}!</p></div>
    </div>
    
    <div class="quick-actions">
        <a href="{{ route('backend.transaksi.index') }}" class="quick-action-btn">
            <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
            </div>
            <span>Transaksi Baru</span>
        </a>
        <a href="{{ route('backend.barang.create') }}" class="quick-action-btn">
            <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" /></svg>
            </div>
            <span>Tambah Produk</span>
        </a>
        <a href="{{ route('backend.transaksi.history') }}" class="quick-action-btn">
            <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
            </div>
            <span>Riwayat Transaksi</span>
        </a>
        <a href="{{ route('backend.laporan.beban.form') }}" class="quick-action-btn">
            <div class="icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
            </div>
            <span>Input Beban</span>
        </a>
    </div>

    {{-- Kartu Ringkasan Dasbor --}}
    <div class="dashboard-cards">
        <div class="summary-card">
            <div class="title">Laba Bersih (Hari Ini)</div>
            <div class="amount profit">
                Rp{{ number_format($labaBersihHariIni, 0, ',', '.') }}
            </div>
        </div>
        <div class="summary-card">
            <div class="title">Laba Bersih (Total)</div>
            <div class="amount">
                Rp{{ number_format($labaBersihTotal, 0, ',', '.') }}
            </div>
        </div>
        <div class="summary-card">
            <div class="title">Jumlah Produk</div>
            <div class="amount">
                {{ $jumlahProduk }}
            </div>
        </div>
    </div>

    
    
    <div class="chart-header">
        <h3>Ringkasan Keuangan</h3>
        <form id="periode-form" method="GET" action="{{ route('backend.beranda') }}">
            <div class="filter-dropdown">
                <select name="periode" onchange="document.getElementById('periode-form').submit()">
                    <option value="1_bulan" {{ $periode == '1_bulan' ? 'selected' : '' }}>30 Hari Terakhir</option>
                    <option value="6_bulan" {{ $periode == '6_bulan' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                    <option value="1_tahun" {{ $periode == '1_tahun' ? 'selected' : '' }}>12 Bulan Terakhir</option>
                </select>
            </div>
        </form>
    </div>

    <div class="dashboard-main-content">
        {{-- Kolom Kiri: Grafik --}}
        <div class="chart-container">
            <canvas id="financialChart"></canvas>
        </div>

        {{-- Kolom Kanan: Aktivitas --}}
        <div class="activity-feed">
            <h3>Aktivitas Penjualan Terakhir</h3>
            <ul class="activity-list">
                @forelse ($recentSales as $sale)
                    <li>
                        <span class="description">Penjualan #TRX-{{ $sale->idTransaksi }}</span>
                        <span class="amount profit">+ Rp{{ number_format($sale->totalHrgJual, 0, ',', '.') }}</span>
                    </li>
                @empty
                    <li>Tidak ada penjualan terbaru.</li>
                @endforelse
            </ul>
            
            <h3 style="margin-top: 24px;">Aktivitas Pengeluaran Terakhir</h3>
            <ul class="activity-list">
                @forelse ($recentExpenses as $expense)
                    <li>
                        <span class="description">{{ Str::limit($expense->deskripsi, 25) }}</span>
                        <span class="amount expense">- Rp{{ number_format($expense->jumlah, 0, ',', '.') }}</span>
                    </li>
                @empty
                    <li>Tidak ada pengeluaran terbaru.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = @json($chartLabels);
        const dataPemasukan = @json($chartPemasukan);
        const dataPengeluaran = @json($chartPengeluaran);
        const ctx = document.getElementById('financialChart');
        
        if (ctx) {
            new Chart(ctx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Pemasukan',
                            data: dataPemasukan,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Pengeluaran',
                            data: dataPengeluaran,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    animation: {
                        duration: 0
                    },
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: false
                        }
                    }
                }
            });
        }
    });
</script>
@endpush