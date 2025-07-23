@extends('layouts.app')

@section('content')
<style>
    .hero {
        background: url("{{ asset('storage/logo/bgr.jpeg') }}") no-repeat center center;
        background-size: cover;
        height: 700px;
        width: 100vw;
        margin-left: calc(-50vw + 50%);
        position: relative;
        display: flex;
        flex-direction: column; /* ubah ke column */
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        overflow: hidden; /* Add this to contain the wave */
        padding: 20px; /* Optional: Add some padding */
    }

    .hero-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center; /* tambahkan ini */
        width: 100%;
        z-index: 2; /* Ensure content stays above wave */
        margin-top: 0; /* hilangkan margin negatif */
    }

    .hero-logo {
        max-width: 200px; /* agar tidak terlalu besar */
        margin-bottom: 24px;
        transition: transform 0.3s ease;
    }

    .hero-logo:hover {
        transform: scale(1.4);
    }

    .hero-text {
        font-size: 2.7rem; /* lebih besar */
        font-weight: bold;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.2;
        letter-spacing: 1px;
    }

    .custom-shape-divider-bottom-1746358433 {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        z-index: 1;
    }

    .custom-shape-divider-bottom-1746358433 svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 150px; /* Reduced slightly for better proportion */
        transform: rotateY(180deg); /* Optional: flip the wave horizontally */
    }

    .custom-shape-divider-bottom-1746358433 .shape-fill {
        fill:rgb(255, 255, 255);
    }

    @media (max-width: 768px) {
        .hero-text {
            font-size: 1.2rem;
            padding: 0 15px;
        }

        .hero-logo {
            max-width: 70px;
        }

        .custom-shape-divider-bottom-1746358433 svg {
            height: 100px;
        }
    }

    .content-wrapper {
        margin-top: 30px;
    }

    .lab-description {
        font-size: 1.1rem;
        text-align: justify;
    }

    .sidebar .card {
        margin-bottom: 20px;
    }

    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }

    .event-gradient {
        position: absolute;
        left: 0; right: 0; bottom: 0;
        height: 70%;
        background: linear-gradient(to top, rgba(25,25,112,0.85) 0%, rgba(25,25,112,0.3) 60%, rgba(25,25,112,0) 100%);
        z-index: 1;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        pointer-events: none;
    }

    .event-caption {
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: 2;
        padding: 1.2rem 1.5rem 1.5rem 1.5rem;
        color: white;
        width: 100%;
        font-size: 1.3rem;
        font-weight: bold;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7), 0 2px 8px #191970;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        text-align: left;
        pointer-events: none;
    }

    .berita-gradient {
        position: absolute;
        left: 0; right: 0; bottom: 0;
        height: 70%;
        background: linear-gradient(to top, rgba(25,25,112,0.85) 0%, rgba(25,25,112,0.3) 60%, rgba(25,25,112,0) 100%);
        z-index: 1;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        pointer-events: none;
    }

    .berita-caption {
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: 2;
        padding: 1.2rem 1.5rem 1.5rem 1.5rem;
        color: white;
        width: 100%;
        font-size: 1.3rem;
        font-weight: bold;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7), 0 2px 8px #000;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
        text-align: left;
        pointer-events: none;
    }

    .berita-caption a:hover, .event-caption a:hover {
        text-decoration: underline !important;
        opacity: 0.9;
    }

    .berita-caption, .event-caption {
        pointer-events: auto !important; /* Override previous pointer-events: none */
    }
</style>

<div class="hero">
    <div class="hero-content">
        <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo Lab" class="hero-logo mb-3">
        <div class="hero-text">
            Lab. Jaringan Komputer, Keamanan Data, dan Internet of Things
        </div>
    </div>
    <div class="custom-shape-divider-bottom-1746358433">
        <svg data-name="Layer 1" 
             xmlns="http://www.w3.org/2000/svg" 
             viewBox="0 0 1200 120" 
             preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" 
                  class="shape-fill">
            </path>
        </svg>
    </div>
</div>

<div class="container-fluid px-2 px-md-5 py-4">
    <div class="row justify-content-between">
        <!-- Kolom utama konten -->
        <div class="col-12 col-md-8 col-lg-9">
            <div class="row justify-content-between"> <!-- Changed to justify-content-start for left alignment -->
                <div class="col-12 col-md-11 col-lg-10"> <!-- Adjusted column width to make it wider -->

                    <!-- Penjelasan Lab -->
                    <div class="mb-4">
                        <h3 class="text-start">Selamat datang di Laboratorium Jaringan Komputer, Keamanan Data, dan IoT</h3> <!-- Changed to text-start -->
                        <div class="lab-description text-start"> <!-- Added text-start -->
                        </div>
                        <p>
                            Lab. Jaringan Komputer, Keamanan Data, dan Internet of Things merupakan pusat penelitian dan pengembangan
                            yang berfokus pada teknologi jaringan, keamanan siber, dan Internet of Things (IoT). Kami berkomitmen
                            untuk menghasilkan inovasi yang mendorong kemajuan teknologi informasi melalui riset mendalam, pengembangan
                            solusi praktis, dan edukasi yang berkelanjutan.
                        </p>
                        <p>
                            Dengan fokus pada pengembangan jaringan komputer yang efisien, penguatan keamanan data, serta penerapan
                            teknologi IoT, lab ini bertujuan untuk memberikan kontribusi nyata dalam menghadapi tantangan digital saat ini.
                            Kami juga aktif menjalin kolaborasi dengan berbagai pihak untuk memperluas dampak dari setiap proyek yang
                            kami kerjakan.
                        </p>
                        @auth
                        @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.editLabDescription') }}" class="btn btn-warning btn-sm mt-2">Edit Penjelasan</a>
                        @endif
                        @endauth
                    </div>

                    <!-- Deskripsi Lab & Info Lain -->
                    <div class="container mb-4">
                        @foreach($descriptions as $desc)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{ $desc->title }}</h5>
                                    @auth
                                        @if(auth()->user()->is_admin)
                                        <div>
                                            <a href="{{ route('descriptions.edit', $desc) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('descriptions.destroy', $desc) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus deskripsi ini?')">Hapus</button>
                                            </form>
                                        </div>
                                        @endif
                                    @endauth
                                </div>
                                <div class="mt-2">
                                    {!! $desc->content !!}
                                </div>
                            </div>
                        </div>
                        @endforeach

                        @auth
                            @if(auth()->user()->is_admin)
                            <a href="{{ route('descriptions.create') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Tambah Deskripsi
                            </a>
                            @endif
                        @endauth
                    </div>

                    <!-- Carousel Berita -->
                    <div class="carousel-wrapper mb-5">
                        <h4 class="mb-3 text-center">Berita terbaru</h4>
                        <div id="carouselBerita" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($beritaTerbaru as $i => $berita)
                                    <button type="button" data-bs-target="#carouselBerita" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" @if($i == 0) aria-current="true" @endif aria-label="Slide {{ $i+1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach($beritaTerbaru as $i => $berita)
                                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                        <div class="position-relative" style="border-radius:1rem;overflow:hidden;">
                                            <img src="{{ asset('storage/' . $berita->foto) }}" class="d-block w-100" style="height:300px;object-fit:cover;" alt="Berita">
                                            <div class="berita-gradient"></div>
                                            <div class="berita-caption">
                                                <a href="{{ route('beritas.show', $berita->id) }}" class="text-white text-decoration-none">
                                                    <h5 class="fw-bold mb-0">{{ $berita->judul }}</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBerita" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselBerita" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <!-- Carousel Event -->
                    <div class="carousel-wrapper mb-5">
                        <h4 class="mb-3 text-center">Event Terbaru</h4>
                        <div id="carouselEvent" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach($eventTerbaru as $i => $event)
                                    <button type="button" data-bs-target="#carouselEvent" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" @if($i == 0) aria-current="true" @endif aria-label="Slide {{ $i+1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach($eventTerbaru as $i => $event)
                                    <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                        <div class="position-relative" style="border-radius:1rem;overflow:hidden;">
                                            <img src="{{ asset('storage/' . $event->foto) }}" class="d-block w-100" style="height:300px;object-fit:cover;" alt="Event">
                                            <div class="event-gradient"></div>
                                            <div class="event-caption">
                                                <a href="{{ route('events.index') }}" class="text-white text-decoration-none">
                                                    <h5 class="fw-bold mb-0">{{ $event->nama_event }}</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselEvent" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselEvent" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-md-4 col-lg-3">
            <!-- Card Peminjaman -->
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset('storage/logo/barang.webp') }}" class="card-img-top" alt="Peminjaman Barang">
                <div class="card-body">
                    <h5 class="card-title">Lakukan Peminjaman Barang</h5>
                    <p class="card-text">Pinjam barang laboratorium dengan mudah dan cepat.</p>
                    <a href="{{ route('peminjaman-barangs.index') }}" class="btn btn-primary w-100">Pinjam Barang</a>
                </div>
            </div>

            <!-- Card Status Peminjaman -->
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset('storage/logo/permin.jpg') }}" class="card-img-top" alt="Peminjaman Barang">
                <div class="card-body">
                    <h5 class="card-title">Cek Status Peminjaman</h5>
                    <p class="card-text">Pantau status peminjaman barang Anda.</p>
                    <a href="{{ route('permintaans.index') }}" class="btn btn-info text-white w-100">Lihat Status</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

