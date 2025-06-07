@extends('layouts.app')

@section('content')
<h3>Daftar Barang</h3>

<a href="{{ route('backend.barang.create') }}">
    <button>+ Tambah Barang</button>
</a>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Kode</th>
            <th>Stok</th>
            <th>Harga Modal</th>
            <th>Harga Jual</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($barang as $item)
        <tr>
            <td><img src="{{ $item->fotoBrg }}" width="80"></td>
            <td>{{ $item->namaBrg }}</td>
            <td>{{ $item->kodeBrg }}</td>
            <td>{{ $item->stokBrg }}</td>
            <td>Rp{{ number_format($item->hrgModal, 0, ',', '.') }}</td>
            <td>Rp{{ number_format($item->hrgJual, 0, ',', '.') }}</td>
            <td>
                <a href="{{ route('backend.barang.edit', $item->idBrg) }}">Edit</a>
                |
                <form action="{{ route('backend.barang.destroy', $item->idBrg) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection