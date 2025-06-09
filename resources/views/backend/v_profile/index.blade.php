@extends('backend.v_layouts.app')
@section('title', 'Profil Saya')
@push('styles')
    @vite('resources/css/manajemen-stok.css')
    <style>
        .profile-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
            align-items: flex-start;
        }
        .profile-picture-card, .profile-details-card {
            background-color: var(--card-background);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
        }
        .profile-picture-card {
            text-align: center;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 16px;
            border: 4px solid var(--border-color);
        }
        .form-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
        }
        .form-group input {
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 16px;
        }
        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            grid-column: span 2;
        }
        .full-width {
            grid-column: span 2;
        }
        hr {
            border: none;
            border-top: 1px solid var(--border-color);
            margin: 24px 0;
            grid-column: span 2;
        }
    </style>
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
            <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="profile-img">
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
                        <input type="password" name="password" id="password" placeholder="Kosongkan jika tidak ingin diubah">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password baru">
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