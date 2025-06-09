@extends('backend.v_layouts.app')
@section('title', 'Laporan Laba')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
    @vite('resources/css/laporan.css')
@endpush

@section('content')
<div class="stok-container">
    
    <div class="tabs">
        <a href="#" class="active">Laporan per Bulan</a>
        <a href="{{ route('backend.laporan.beban.form') }}">Input Beban</a>
    </div>

    
    <div class="page-header">
        <div>
            <h1>Daftar Laporan Laba per Bulan</h1>
        </div>
    </div>
    <div class="report-list">
        @forelse ($laporan as $item)
            <div class="report-item">
                <div class="info">
    
                    <h3>{{ \Carbon\Carbon::create()->month($item->bulan)->translatedformat('F') }} {{ $item->tahun }}</h3>
                    <p>
                        Beban: <span>Rp{{ number_format($item->total_beban ?? 0, 0, ',', '.') }}</span> | 
                        Laba: <span>Rp{{ number_format($item->total_laba ?? 0, 0, ',', '.') }}</span>
                    </p>
                </div>
                <div class="actions">
                    <a href="{{ route('backend.laporan.download', ['tahun' => $item->tahun, 'bulan' => $item->bulan]) }}" class="download-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    </a>
                    <a href="{{ route('backend.laporan.show.monthly', ['tahun' => $item->tahun, 'bulan' => $item->bulan]) }}" class="btn-detail">Lihat Detail</a>
                </div>
            </div>
        @empty
            <div class="content-card">
                <p style="text-align: center; padding: 20px;">Belum ada data laporan untuk ditampilkan.</p>
            </div>
        @endforelse
    </div>
    <div class="pagination-section" style="margin-top: 24px;">
        {{ $laporan->links() }}
    </div>
</div>
@endsection