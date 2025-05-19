@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Event</li>
@endsection


@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Event</h1>

    @auth
    <a href="{{ route('events.create') }}" class="btn btn-primary mb-4">Tambah Event</a>
    @endauth

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($events as $index => $event)
            <div class="col" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 shadow-sm">
                    @if ($event->foto)
                        <div class="square-img-container">
                            <img src="{{ asset('storage/' . $event->foto) }}" class="card-img-top" alt="Foto event">
                        </div>
                    @else
                        <div class="square-img-container bg-light d-flex align-items-center justify-content-center">
                            <i class="bi bi-calendar-event" style="font-size: 3rem;"></i>
                        </div>
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $event->nama_event }}</h5>
                        
                        <p class="card-text text-muted mb-2">
                            <i class="bi bi-calendar"></i> {{ $event->tanggal_event }} 
                            <i class="bi bi-clock ms-2"></i> {{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}

                        </p>
                        
                        <p class="card-text flex-grow-1">{{ Str::limit($event->deskripsi, 100) }}</p>

                        <div class="mt-3">
                            @guest
                                <a href="{{ route('kehadirans.create', ['event' => $event->id]) }}" class="btn btn-primary w-100 mb-2">
                                    Isi Kehadiran
                                </a>
                            @endguest

                            @auth
                                <div class="d-grid gap-2">
                                    <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('events.destroy', ['event' => $event->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus event ini?')" class="btn btn-danger w-100">Hapus</button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada event yang tersedia.</div>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4 mb-4">
        {{ $events->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- AOS CSS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true,
        duration: 800
    });
</script>

<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .btn {
        border-radius: 5px;
    }

    .square-img-container {
        position: relative;
        width: 100%;
        padding-top: 100%; /* 1:1 aspect ratio */
        overflow: hidden;
    }

    .square-img-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pagination {
        margin-bottom: 2rem;
    }
    
    .page-link {
        color: #0d6efd;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        margin: 0 0.25rem;
        transition: all 0.2s;
    }
    
    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
    
    .page-link:hover {
        background-color: #e9ecef;
        transform: translateY(-2px);
    }
</style>
@endsection
