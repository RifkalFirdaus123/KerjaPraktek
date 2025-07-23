@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Admin</li>
@endsection

@section('content')
<div class="bg-white py-3 mb-0 w-100 text-center shadow-sm mt-5">
    <h1 class="mb-0">Selamat datang, <b>{{ auth()->user()->name }}</b></h1>
</div>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Ganti Username & Password Admin</div>
                <div class="card-body">
                    @if (session('status'))
                        <script>alert('{{ session('status') }}');</script>
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('admin.changePassword') }}" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan?')">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Password Lama</label>
                            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                        <div class="form-text mt-2">Kosongkan password jika hanya ingin mengganti username.</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
