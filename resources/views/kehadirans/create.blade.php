@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Event</a></li>
  <li class="breadcrumb-item active" aria-current="page">Daftar Kehadiran</li>

  @endsection


@section('content')
<div class="d-flex justify-content-center mt-5">
    <div class="shadow p-4 bg-white rounded" style="width: 1000px;">
        <h1>Tambah Kehadiran untuk Event: {{ $event->nama_event }}</h1>

        <!-- Form untuk menambah kehadiran -->
        <form action="{{ route('kehadirans.store', $event) }}" method="POST">
            @csrf

            <!-- Menyembunyikan ID Event -->
            <input type="hidden" name="event_id" value="{{ $event->id }}">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    value="{{ old('nama') }}"
                    required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input
                    type="text"
                    name="nim"
                    id="nim"
                    class="form-control @error('nim') is-invalid @enderror"
                    value="{{ old('nim') }}"
                    required>
                @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="angkatan" class="form-label">Angkatan</label>
                <input
                    type="text"
                    name="angkatan"
                    id="angkatan"
                    class="form-control @error('angkatan') is-invalid @enderror"
                    value="{{ old('angkatan') }}"
                    required>
                @error('angkatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol untuk submit -->
            <button type="submit" class="btn btn-primary">Simpan Kehadiran</button>

            <!-- Tombol untuk kembali ke halaman daftar kehadiran -->
            <a href="{{ route('kehadirans.index', $event->id) }}" class="btn btn-secondary ms-2">Kembali</a>
        </form>
    </div>
</div>
@endsection
