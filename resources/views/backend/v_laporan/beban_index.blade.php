@extends('backend.v_layouts.app')
@section('title', 'Input Beban')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
    @vite('resources/css/laporan.css')
@endpush

@section('content')
<div class="stok-container">
    <div class="tabs">
        <a href="{{ route('backend.laporan.index') }}">Laporan per Bulan</a>
        <a href="{{ route('backend.laporan.beban.form') }}" class="active">Input Beban</a>
    </div>
    
    <form method="GET" action="{{ route('backend.laporan.beban.form') }}" class="filter-section">
        <div class="filter-dropdown">
            <select name="bulan" onchange="this.form.submit()">
                @for ($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" {{ $m == $bulan ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedformat('F') }}</option>
                @endfor
            </select>
        </div>
        <div class="filter-dropdown">
            <select name="tahun" onchange="this.form.submit()">
                @for ($y=date('Y'); $y>=date('Y')-5; $y--)
                    <option value="{{ $y }}" {{ $y == $tahun ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
    </form>

    <div class="beban-layout">
        <div class="content-card">
            <div class="card-header" style="margin-bottom: 0;">
                <h2>Input Beban Operasional</h2>
            </div>
            <form action="{{ route('backend.laporan.beban.store') }}" method="POST" style="padding-top: 20px;">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $tahun }}-{{ str_pad($bulan, 2, '0', STR_PAD_LEFT) }}">
                <div class="form-group">
                    <label for="deskripsi">Nama Beban</label>
                    <input type="text" id="deskripsi" name="deskripsi" required>
                </div>
                <div class="form-group" style="margin-top: 16px;">
                    <label for="jumlah">Jumlah (Rp)</label>
                    <input type="number" id="jumlah" name="jumlah" required placeholder="Contoh: 50000">
                </div>
                <button type="submit" class="btn-add" style="width: 100%; margin-top: 24px;">Simpan Beban</button>
            </form>
        </div>

        <div class="content-card">
            <div class="card-header">
                <h2>Daftar Beban - {{ \Carbon\Carbon::create()->month($bulan)->translatedformat('F') }} {{ $tahun }}</h2>
            </div>
            <div class="beban-list">
                @forelse($beban as $item)
                    <div class="beban-list-item">
                        <div class="beban-info">
                            <span>{{ $item->deskripsi }}</span>
                        </div>
                        <div class="beban-kanan">
                            <strong>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</strong>
                            <div class="actions">
                                <a href="{{ route('backend.laporan.beban.edit', $item->idPengeluaran) }}" style="color: inherit;">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>
                                <form action="{{ route('backend.laporan.beban.destroy', $item->idPengeluaran) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus beban ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:none; padding:0; cursor:pointer; color:inherit; display:flex; align-items:center;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; padding: 20px;">Belum ada data beban untuk periode ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<style>
    .form-group{display:flex;flex-direction:column}
    .form-group label{margin-bottom:8px;font-weight:600;font-size:14px}
    .form-group input{padding:10px 12px;border:1px solid var(--border-color);border-radius:8px;font-size:16px}
</style>
@endsection