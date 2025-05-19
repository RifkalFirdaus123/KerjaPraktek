@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Event</a></li>
  <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
@endsection



@section('content')
<div class="container">
    <h1>Edit Event</h1>

    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_event">Nama Event</label>
            <input type="text" class="form-control" id="nama_event" name="nama_event" value="{{ old('nama_event', $event->nama_event) }}" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto Event</label>
            <input type="file" class="form-control" id="foto" name="foto">
            @if($event->foto)
                <img src="{{ asset('storage/' . $event->foto) }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label for="tanggal">Tanggal Event</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal_event" value="{{ old('tanggal', $event->tanggal) }}">
        </div>

        <div class="form-group">
            <label for="waktu">Waktu Event</label>
            <input type="time" class="form-control" id="waktu" name="waktu" value="{{ old('waktu', $event->waktu) }}">
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi Event</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi', $event->lokasi) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
