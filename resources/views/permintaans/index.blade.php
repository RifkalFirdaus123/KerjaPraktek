@extends('layouts.app')


@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Permintaans</li>
@endsection
@section('content')
<style>
    .table {
        background-color: #ffffff;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 20px 12px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background-color: #f8f9fa;
    }

    .table th, .table td {
        vertical-align: middle;
        padding: 12px;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.85em;
        border-radius: 5px;
    }

    .btn {
        border-radius: 5px !important;
    }

    /* Untuk responsive jika diperlukan */
    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }
    }
</style>

<div class="container">
    <h2>Permintaan Peminjaman Barang</h2>
    <!-- Tabel Permintaan -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>NIM/NIP</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                @auth
                    <th>Aksi</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamanBarangs as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->nama_peminjam }}</td>
                <td>{{ $peminjaman->nim_nip }}</td>
                <td>{{ $peminjaman->nama_barang }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                <td>{{ $peminjaman->tanggal_pengembalian }}</td>                <td>                    @if($peminjaman->status == 'Disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($peminjaman->status == 'Tidak Disetujui')
                        <span class="badge bg-danger">Tidak Disetujui</span>
                    @elseif($peminjaman->status == 'Selesai Dipinjam')
                        <span class="badge bg-primary">Selesai Dipinjam</span>
                    @else
                        <span class="badge bg-warning">Menunggu</span>
                    @endif
                </td>
                @auth
                <td>
                    @if($peminjaman->status == null || $peminjaman->status == 'Belum Disetujui')
                        <!-- Tombol Disetujui -->
                        <form action="{{ route('permintaans.updateStatus', $peminjaman->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menyetujui permintaan ini?')">Disetujui</button>
                        </form>
                        <!-- Tombol Tidak Disetujui -->
                        <form action="{{ route('permintaans.updateStatusDitolak', $peminjaman->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak permintaan ini?')">Tidak Disetujui</button>
                        </form>
                    @else
                        <span class="text-muted">Status telah diproses</span>
                    @endif
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $peminjamanBarangs->links('pagination::bootstrap-5') }}
    </div>

    <!-- Tabel Permintaan yang Disetujui -->
    <h2>Permintaan yang Disetujui</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>NIM/NIP</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                @auth
                    <th>Aksi</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamanBarangsDisetujui as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->nama_peminjam }}</td>
                <td>{{ $peminjaman->nim_nip }}</td>
                <td>{{ $peminjaman->nama_barang }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->tanggal_peminjaman }}</td>
                <td>{{ $peminjaman->tanggal_pengembalian }}</td>
                <td>
                    <span class="badge {{ 
                        $peminjaman->status === 'Batal Dipinjam' ? 'bg-danger' : 
                        ($peminjaman->status === 'Selesai Dipinjam' ? 'bg-primary' : 
                        ($peminjaman->status === 'Disetujui' ? 'bg-success' : 'bg-secondary')) 
                    }}">
                        {{ $peminjaman->status }}
                    </span>
                </td>
                @auth
                <td>
                    @if($peminjaman->status === 'Disetujui')
                        <div class="d-flex gap-2">
                            <form action="{{ route('peminjaman.complete', $peminjaman->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menyelesaikan peminjaman ini?')">
                                    Selesai
                                </button>
                            </form>
                        </div>
                    @elseif($peminjaman->status === 'Selesai Dipinjam')
                        <p>Status Telah di Proses</p>
                    @endif
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $peminjamanBarangsDisetujui->links('pagination::bootstrap-5', ['paginator' => $peminjamanBarangsDisetujui, 'pageName' => 'disetujui_page']) }}
    </div>
</div>
@endsection
