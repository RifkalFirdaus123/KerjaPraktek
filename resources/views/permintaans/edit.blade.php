@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('permintaans.index') }}">Permintaan</a></li>

@section('content')
<div class="container">
    <h1>Edit Permintaan</h1>

    <form action="{{ route('permintaans.update', $permintaan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_peminta" class="form-label">Nama Peminta</label>
            <input type="text" name="nama_peminta" class="form-control" value="{{ $permintaan->nama_peminta }}" required>
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" required>{{ $permintaan->keterangan }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $permintaan->status }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('permintaans.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
