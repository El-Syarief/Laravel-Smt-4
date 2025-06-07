@extends('layouts.app')

@section('content')
<h3>Tambah Barang</h3>

<form action="{{ route('backend.barang.store') }}" method="POST">
    @csrf

    <label>Foto (URL)</label><br>
    <input type="text" name="fotoBrg" value="{{ old('fotoBrg') }}">
    @error('fotoBrg') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Nama Barang</label><br>
    <input type="text" name="namaBrg" value="{{ old('namaBrg') }}">
    @error('namaBrg') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Kode Barang</label><br>
    <input type="text" name="kodeBrg" value="{{ old('kodeBrg') }}">
    @error('kodeBrg') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Stok</label><br>
    <input type="number" name="stokBrg" value="{{ old('stokBrg') }}">
    @error('stokBrg') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Harga Modal</label><br>
    <input type="number" name="hrgModal" value="{{ old('hrgModal') }}">
    @error('hrgModal') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <label>Harga Jual</label><br>
    <input type="number" name="hrgJual" value="{{ old('hrgJual') }}">
    @error('hrgJual') <div style="color:red">{{ $message }}</div> @enderror
    <br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('backend.barang.index') }}"><button type="button">Batal</button></a>
</form>
@endsection
