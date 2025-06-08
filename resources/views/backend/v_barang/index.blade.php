@extends('backend.v_layouts.app')
@section('title', 'Manajemen Stok')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div>
            <h1>Manajemen Stok</h1>
            <p>Kelola Semua Produk Anda</p>
        </div>
        <a href="{{ route('backend.barang.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" /></svg>
            Tambah Produk Baru
        </a>
    </div>

    <div class="content-card">
        <div class="filter-section">
            <div class="search-bar">
                <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="20" height="20"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" /></svg></span>
                <input type="text" placeholder="Cari Produk...">
            </div>
            <div class="filter-dropdown"><select><option>Semua Kategori</option></select></div>
        </div>

        <table class="stok-table">
            <thead>
                <tr>
                    <th>NAMA PRODUK</th>
                    <th>KODE PRODUK</th>
                    <th>STOK</th>
                    <th>HARGA JUAL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $item)
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="{{ asset('storage/' . $item->fotoBrg) }}" alt="{{ $item->namaBrg }}">
                            <span>{{ $item->namaBrg }}</span>
                        </div>
                    </td>
                    <td>{{ $item->kodeBrg }}</td>
                    <td>{{ $item->stokBrg }}</td>
                    <td>Rp{{ number_format($item->hrgJual, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('backend.barang.edit', $item->idBrg) }}" class="action-link">Edit</a>
                         <a href="{{ route('backend.barang.add-stock-form', $item->idBrg) }}" class="action-link">Tambah Stok</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align: center; padding: 20px;">Anda belum memiliki produk.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-section">
            <div class="pagination-info">
                Menampilkan {{ $barang->firstItem() ?? 0 }} sampai {{ $barang->lastItem() ?? 0 }} dari {{ $barang->total() }} hasil
            </div>
            <div class="pagination-buttons">
                @if ($barang->onFirstPage())
                    <span>Sebelumnya</span>
                @else
                    <a href="{{ $barang->previousPageUrl() }}">Sebelumnya</a>
                @endif
                @if ($barang->hasMorePages())
                    <a href="{{ $barang->nextPageUrl() }}">Selanjutnya</a>
                @else
                    <span>Selanjutnya</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection