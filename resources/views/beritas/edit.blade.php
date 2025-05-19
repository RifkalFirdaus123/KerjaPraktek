@extends('layouts.app')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('beritas.index') }}">Berita</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit Berita</li>
@endsection

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Berita</li>
@endsection

@section('content')
<div class="container">
    <h1>Edit Berita</h1>

    <form action="{{ route('beritas.update', $berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $berita->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="konten" class="form-label">Isi Berita</label>
            <textarea name="isi" id="konten" class="form-control" rows="5" required>{{ old('konten', $berita->konten) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $berita->tanggal ? date('Y-m-d', strtotime($berita->tanggal)) : '') }}">
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Baru (opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control">
            @if ($berita->foto)
                <small class="d-block mt-2">Foto saat ini:</small>
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
