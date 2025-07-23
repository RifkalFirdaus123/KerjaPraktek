@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Peminjaman Barang</li>

@endsection



@section('content')
    <div class="container">
        <h1>Edit Peminjaman Barang</h1>

        <form action="{{ route('peminjaman-barangs.update', $peminjamanBarang) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-3">
                <label for="barang_id" class="form-label">Barang</label>
                <select name="barang_id" id="barang_id" class="form-control" required>
                    @foreach ($barangs as $barang)
                        <option value="{{ $barang->id }}" {{ $peminjamanBarang->barang_id == $barang->id ? 'selected' : '' }}>
                            {{ $barang->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" id="nama_peminjam" class="form-control" value="{{ $peminjamanBarang->nama_peminjam }}" required>
            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $peminjamanBarang->jumlah }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="{{ $peminjamanBarang->tanggal_pinjam }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control" value="{{ $peminjamanBarang->tanggal_kembali }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Peminjaman</button>
        </form>
    </div>
@endsection
