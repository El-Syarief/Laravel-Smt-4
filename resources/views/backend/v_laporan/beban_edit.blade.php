@extends('backend.v_layouts.app')
@section('title', 'Edit Beban')
@push('styles')
    @vite(['resources/css/manajemen-stok.css', 'resources/css/laporan.css'])
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div>
            <h1>Edit Beban Operasional</h1>
            <p>Perbarui detail beban di bawah ini</p>
        </div>
    </div>

    <div class="content-card">
        <form action="{{ route('backend.laporan.beban.update', $pengeluaran->idPengeluaran) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-body" style="grid-template-columns: 1fr;">
                <div class="form-group">
                    <label for="deskripsi">Nama Beban</label>
                    <input type="text" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $pengeluaran->deskripsi) }}" required>
                </div>
                <div class="form-group" style="margin-top: 16px;">
                    <label for="jumlah">Jumlah (Rp)</label>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah', $pengeluaran->jumlah) }}" required>
                </div>
            </div>
            <div class="form-footer">
                <a href="{{ route('backend.laporan.beban.form') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-add">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection