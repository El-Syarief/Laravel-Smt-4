@extends('backend.v_layouts.app')
@section('title', 'Tambah Produk Baru')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div><h1>Tambah Produk Baru</h1><p>Isi detail produk di bawah ini</p></div>
    </div>
    <div class="content-card">
        <form action="{{ route('backend.barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <div class="form-group">
                    <label for="namaBrg">
                        Nama Produk
                    </label>
                    <input type="text" name="namaBrg" id="namaBrg" value="{{ old('namaBrg') }}" required>@error('namaBrg') 
                    <div class="error-message">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kodeBrg">
                        Kode Produk
                    </label>
                    <input type="text" name="kodeBrg" id="kodeBrg" value="{{ old('kodeBrg') }}" required>
                        @error('kodeBrg') 
                    <div class="error-message">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="form-group">
                    <label for="namaKategori">Kategori</label>
                    <input type="text" name="namaKategori" id="namaKategori" value="{{ old('namaKategori') }}" placeholder="Ketik untuk menambah kategori baru">
                    @error('namaKategori') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            
                <div class="form-group">
                    <label for="stokBrg">
                        Stok Awal
                    </label>
                    <input type="number" name="stokBrg" id="stokBrg" value="{{ old('stokBrg', 0) }}">
                    @error('stokBrg')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="hrgModal">
                        Harga Modal (Rp)
                    </label>
                    <input type="number" name="hrgModal" id="hrgModal" value="{{ old('hrgModal') }}">@error('hrgModal') <div class="error-message">
                        {{ $message }}
                    </div> 
                    @enderror
                </div>
                <div class="form-group">
                    <label for="hrgJual">Harga Jual (Rp)</label><input type="number" name="hrgJual" id="hrgJual" value="{{ old('hrgJual') }}" required>
                        @error('hrgJual') 
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fotoBrg">Foto Produk</label><input type="file" name="fotoBrg" id="fotoBrg" required>
                        @error('fotoBrg') 
                    <div class="error-message">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-footer">
                <a href="{{ route('backend.barang.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-add">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>
<style>
    .form-body{display:grid;grid-template-columns:1fr 1fr;gap:20px}.form-group{display:flex;flex-direction:column}.form-group label{margin-bottom:8px;font-weight:600;font-size:14px}.form-group input{padding:10px 12px;border:1px solid var(--border-color);border-radius:8px;font-size:16px}.form-footer{display:flex;justify-content:flex-end;gap:12px;margin-top:24px}.btn-secondary{background-color:#F2F4F7;color:#344054;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600}.error-message{color:red;font-size:12px;margin-top:5px}
</style>
@endsection