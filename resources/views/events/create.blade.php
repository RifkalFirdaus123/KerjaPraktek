@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Event</a></li>
  <li class="breadcrumb-item active" aria-current="page">Tambah Event</li>
@endsection

@section('content')
<div class="container">
    <h1>Tambah Event</h1>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nama_event">Nama Event</label>
            <input type="text" class="form-control" id="nama_event" name="nama_event" value="{{ old('nama_event') }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto Event</label>
            <input type="file" class="form-control" id="foto" name="foto">
        </div>

        <div class="form-group">
            <label for="tanggal_event">Tanggal Event</label>
            <input type="date" class="form-control" id="tanggal_event" name="tanggal_event" value="{{ old('tanggal_event') }}">
            </div>

        <div class="form-group">
            <label for="waktu">Waktu Event</label>
            <input type="time" class="form-control" id="waktu" name="waktu" value="{{ old('waktu') }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
