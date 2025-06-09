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
                
                <div class="form-group">
                    <label for="nama_kategori">Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori', $barang->kategori->nama_kategori ?? '') }}" placeholder="Ketik untuk mengubah atau menambah kategori">
                </div>
                
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