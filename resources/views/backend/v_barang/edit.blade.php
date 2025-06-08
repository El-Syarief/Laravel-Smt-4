@extends('backend.v_layouts.app')
@section('title', 'Edit Produk')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div><h1>Edit Produk</h1><p>Perbarui detail produk di bawah ini</p></div>
    </div>
    <div class="content-card">
        
        <form id="edit-form" action="{{ route('backend.barang.update', $barang->idBrg) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-body">
                <div class="form-group"><label for="namaBrg">Nama Produk</label><input type="text" name="namaBrg" id="namaBrg" value="{{ old('namaBrg', $barang->namaBrg) }}" required>@error('namaBrg') <div class="error-message">{{ $message }}</div> @enderror</div>
                <div class="form-group"><label for="kodeBrg">Kode Produk</label><input type="text" name="kodeBrg" id="kodeBrg" value="{{ old('kodeBrg', $barang->kodeBrg) }}" required>@error('kodeBrg') <div class="error-message">{{ $message }}</div> @enderror</div>
                <div class="form-group"><label for="stokBrg">Stok</label><input type="number" name="stokBrg" id="stokBrg" value="{{ old('stokBrg', $barang->stokBrg) }}">@error('stokBrg') <div class="error-message">{{ $message }}</div> @enderror</div>
                <div class="form-group"><label for="hrgModal">Harga Modal (Rp)</label><input type="number" name="hrgModal" id="hrgModal" value="{{ old('hrgModal', $barang->hrgModal) }}">@error('hrgModal') <div class="error-message">{{ $message }}</div> @enderror</div>
                <div class="form-group"><label for="hrgJual">Harga Jual (Rp)</label><input type="number" name="hrgJual" id="hrgJual" value="{{ old('hrgJual', $barang->hrgJual) }}" required>@error('hrgJual') <div class="error-message">{{ $message }}</div> @enderror</div>
                <div class="form-group"><label for="fotoBrg">Upload Foto Baru (Opsional)</label><input type="file" name="fotoBrg" id="fotoBrg">@error('fotoBrg') <div class="error-message">{{ $message }}</div> @enderror</div>
            </div>
            <div class="form-footer">
                <a href="{{ route('backend.barang.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-add">Perbarui Produk</button>
            </div>
        </form>
    </div>
</div>
<style>
    .form-body{display:grid;grid-template-columns:1fr 1fr;gap:20px}.form-group{display:flex;flex-direction:column}.form-group label{margin-bottom:8px;font-weight:600;font-size:14px}.form-group input{padding:10px 12px;border:1px solid var(--border-color);border-radius:8px;font-size:16px}.form-footer{display:flex;justify-content:flex-end;gap:12px;margin-top:24px}.btn-secondary{background-color:#F2F4F7;color:#344054;padding:12px 20px;border-radius:8px;text-decoration:none;font-weight:600}.error-message{color:red;font-size:12px;margin-top:5px}
</style>
@endsection


@push('scripts')
<script>
    document.getElementById('edit-form').addEventListener('submit', function(event) {
        // Tampilkan konfirmasi pop-up
        var confirmation = confirm("Apakah Anda yakin ingin menyimpan perubahan ini? Aksi ini tidak dapat dibatalkan.");
        
        // Jika pengguna menekan 'Cancel', batalkan pengiriman form
        if (!confirmation) {
            event.preventDefault();
        }
    });
</script>
@endpush