@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('kehadirans.index') }}">Kehadiran</a></li>
  <li class="breadcrumb-item active" aria-current="page">Tambah Kehadiran</li>
@endsection

@section('content')
<div class="container">
    <h1>Daftar Kehadiran untuk Event: {{ $event->nama_event }}</h1>
    <p>Menambahkan Kehadiran untuk Event tertentu</p>
    
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('kehadirans.create', ['event' => $event->id]) }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Kehadiran
        </a>
        <a href="{{ route('kehadirans.export-pdf', ['eventId' => $event->id]) }}" class="btn btn-secondary" target="_blank">
            <i class="bi bi-file-pdf-fill"></i> Export PDF
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Angkatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kehadirans as $kehadiran)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kehadiran->nama }}</td>
                            <td>{{ $kehadiran->nim }}</td>
                            <td>{{ $kehadiran->angkatan }}</td>
                            <td>
                                <!-- Hapus Kehadiran -->
                                <form action="{{ route('kehadirans.destroy', $kehadiran) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kehadiran ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
