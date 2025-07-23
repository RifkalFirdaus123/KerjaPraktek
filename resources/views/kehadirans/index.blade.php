@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Kehadiran</li>
@endsection


@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($events as $index => $event)
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
                        <p class="card-text">{{ Str::limit($event->deskripsi, 100) }}</p>
                        <p class="card-text text-muted mb-2">
                            <i class="bi bi-calendar"></i> {{ $event->tanggal_event }} 
                            <i class="bi bi-clock ms-2"></i> {{ $event->waktu }}
                        </p>

                        <div class="mt-auto">
                            @guest
                                <a href="{{ route('kehadirans.create', ['event' => $event->id]) }}" class="btn btn-primary mb-2 w-100">
                                    Isi Kehadiran
                                </a>
                            @endguest

                            @auth
                                <a href="{{ route('kehadirans.edit', $event) }}" class="btn btn-info mb-2 w-100">Data Kehadiran</a>

                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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

{{-- Tambahkan CSS yang konsisten --}}
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
</style>
@endsection
