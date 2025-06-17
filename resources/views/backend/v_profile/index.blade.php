@extends('backend.v_layouts.app')
@section('title', 'Profil Saya')
@push('styles')
    @vite(['resources/css/manajemen-stok.css', 'resources/css/profile.css'])
@endpush

@section('content')
<div class="stok-container">
    <div class="page-header">
        <div>
            <h1>Profil Saya</h1>
            <p>Kelola informasi akun dan preferensi Anda.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" style="background-color: #D4EDDA; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-container">
        <div class="profile-picture-card">
            <!-- <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="profile-img"> -->
             @if (Auth::user()->foto)
                <img
                src="{{ asset('storage/' . Auth::user()->foto) }}"
                alt="Foto Profil"
                class="profile-img">
            @else
                <img
                src="{{ asset('storage/avatars/profile-default.png') }}"
                alt="Foto Profil Default"
                class="profile-img">
            @endif

            <h3>{{ $user->namaUsaha }}</h3>
            <p>{{ $user->email }}</p>
        </div>
        <div class="profile-details-card">
            <form action="{{ route('backend.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-body">
                    <h4 class="full-width">Informasi Dasar</h4>
                    <div class="form-group">
                        <label for="namaUsaha">Nama Usaha</label>
                        <input type="text" name="namaUsaha" id="namaUsaha" value="{{ old('namaUsaha', $user->namaUsaha) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="noTelp">No. Telepon</label>
                        <input type="text" name="noTelp" id="noTelp" value="{{ old('noTelp', $user->noTelp) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $user->alamat) }}" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="foto">Ganti Foto Profil (Opsional)</label>
                        <input type="file" name="foto" id="foto">
                    </div>

                    <hr>

                    <h4 class="full-width">Ubah Password</h4>
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" 
                        placeholder="Kosongkan jika tidak ingin diubah" 
                        class="@error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                        placeholder="Ulangi password baru"
                        class="@error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn-add">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection