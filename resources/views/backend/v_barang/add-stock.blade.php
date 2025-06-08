@extends('backend.v_layouts.app')
@section('title', 'Tambah Stok Produk')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div>
            <h1>Tambah Stok: {{ $barang->namaBrg }}</h1>
            <p>Stok saat ini: {{ $barang->stokBrg }}</p>
        </div>
    </div>
    <div class="content-card">
        <form action="{{ route('backend.barang.add-stock', $barang->idBrg) }}" method="POST">
            @csrf
            <div class="form-body" style="grid-template-columns: 1fr;">
                <div class="form-group">
                    <label for="jumlah_tambah">Jumlah Stok yang Ditambah</label>
                    <input type="number" name="jumlah_tambah" id="jumlah_tambah" value="{{ old('jumlah_tambah', 1) }}" required>
                    @error('jumlah_tambah') <div class="error-message">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="harga_modal_baru">Harga Modal Baru per Item (Rp)</label>
                    <input type="number" name="harga_modal_baru" id="harga_modal_baru" value="{{ old('harga_modal_baru', $barang->hrgModal) }}" required>
                    @error('harga_modal_baru') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="form-footer">
                <a href="{{ route('backend.barang.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-add">Simpan</button>
            </div>
        </form>
    </div>
</div>
<style>
    .form-body{display:grid;gap:20px}.form-group{display:flex;flex-direction:column}.form-group label{margin-bottom:8px;font-weight:600;font-size:14px}.form-group input{padding:10px 12px;border:1px solid var(--border-color);border-radius:8px;font-size:16px}.form-footer{display:flex;justify-content:flex-end;gap:12px;margin-top:24px}.btn-secondary{background-color:#F2F4F7;color:#344054;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600}.error-message{color:red;font-size:12px;margin-top:5px}
</style>
@endsection