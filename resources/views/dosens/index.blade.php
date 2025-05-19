@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Dosen</li>
@endsection

@section('content')
<div class="container">
    <h1>Data Dosen</h1>

    @auth
        <a href="{{ route('dosens.create') }}" class="btn btn-primary mb-3">Tambah Dosen</a>
    @endauth

    <div class="card rounded-lg shadow">
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">Foto</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Mata Kuliah Diampu</th>
                        @auth
                        <th class="text-center">Aksi</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach($dosens as $dosen)
                    <tr>
                        <td class="text-center align-middle">
                            @if($dosen->foto)
                            <img 
                                src="{{ asset('storage/' . $dosen->foto) }}" 
                                alt="{{ $dosen->nama }}"
                                width="auto" 
                                height="100px"
                                class="rounded">                   
                            @else
                            <img 
                                src="{{ asset('storage/logo/foto.png') }}"  
                                alt="Default Avatar"
                                width="80" 
                                class="rounded">                   
                            @endif
                        </td>
                        <td class="align-middle">{{ $dosen->nama }}</td>
                        <td class="align-middle">{{ $dosen->nip }}</td>
                        <td class="align-middle">{{ $dosen->email }}</td>
                        <td class="align-middle">{{ $dosen->status }}</td>
                        <td class="align-middle">
                            @if($dosen->matkul && is_array($dosen->matkul))
                                <ul class="mb-0 ps-3">
                                    @foreach($dosen->matkul as $mk)
                                        <li>{{ $mk }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        @auth
                        <td class="text-center align-middle">
                            <a href="{{ route('dosens.edit', $dosen) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dosens.destroy', $dosen) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                        @endauth
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table {
        margin-bottom: 0;
    }
    .table th:first-child {
        border-top-left-radius: 8px;
    }
    .table th:last-child {
        border-top-right-radius: 8px;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style>
@endsection