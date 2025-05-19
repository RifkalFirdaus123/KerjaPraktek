@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('beritas.index') }}">Daftar Berita</a></li>
  <li class="breadcrumb-item active" aria-current="page"> Tambah Berita</li>
@endsection

@section('content')
<div class="container">
    <h1>Tambah Berita</h1>

    <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Isi Berita</label>
            <textarea name="isi" id="konten" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto (opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
