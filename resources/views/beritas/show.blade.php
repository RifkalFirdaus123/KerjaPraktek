@extends('layouts.app')
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Berita</li>
@endsection
<style>

    .card {
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* shadow dasar */
        border-radius: 1rem;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2); /* lebih tebal saat hover */
    }

    /* Update sidebar styles */
    .sidebar {
        opacity: 0;
        transform: translateX(100px);
        transition: all 1s ease-out;
        margin-top: 20px; /* Add this line */
    }

    .sidebar.visible {
        opacity: 1;
        transform: translateX(0);
    }
    
</style>
@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Konten utama -->
        <div class="col-md-8">
            <h2 class="mb-3">{{ $berita->judul }}</h2>
            @if($berita->foto)
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="Foto Berita" class="img-fluid rounded mb-4">
            @endif
            <p class="text-muted">{{ $berita->created_at->translatedFormat('l, d F Y') }}</p>
            <p>{{ $berita->isi }}</p>
        </div>

        <!-- Sidebar with animation -->
        <div class="col-md-4 sidebar "  id="animatedSidebar" style =" margin-top: 55px;">
            @php
                $beritaTerbaru = \App\Models\Berita::latest()->first();
                $eventTerbaru = \App\Models\Event::latest()->first();
            @endphp

            @if($beritaTerbaru)
            <div class="card mb-4">
                <img src="{{ asset('storage/' . $beritaTerbaru->foto) }}" class="card-img-top" alt="Thumbnail Berita">
                <div class="card-body">
                    <h5 class="card-title">{{ $beritaTerbaru->judul }}</h5>
                    <a href="{{ route('beritas.index') }}" class="btn btn-sm btn-primary">Lihat Semua Berita</a>
                </div>
            </div>
            @endif

            @if($eventTerbaru)
            <div class="card mb-4">
                <img src="{{ asset('storage/' . $eventTerbaru->foto) }}" class="card-img-top" alt="Thumbnail Event">
                <div class="card-body">
                    <h5 class="card-title">{{ $eventTerbaru->judul }}</h5>
                    <a href="{{ route('events.index') }}" class="btn btn-sm btn-primary">Lihat Semua Event</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add intersection observer script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        const sidebar = document.getElementById('animatedSidebar');
        if (sidebar) {
            observer.observe(sidebar);
        }
    });
</script>
@endsection
