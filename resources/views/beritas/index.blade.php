@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Berita</li>
@endsection

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Daftar Berita</h1>

    @auth
    <a href="{{ route('beritas.create') }}" class="btn btn-primary mb-4">Tambah Berita</a>
    @endauth

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @forelse($beritas as $index => $berita)
            <div class="col" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="card h-100 shadow rounded-4 overflow-hidden">
                    <div class="position-relative">
                        @if($berita->foto)
                            <img src="{{ asset('storage/' . $berita->foto) }}" 
                                 class="card-img-top" 
                                 alt="Foto Berita" 
                                 style="height: 300px; object-fit: cover;">
                        @else
                            <div class="bg-light card-img-top" style="height: 300px;"></div>
                        @endif
                        <div class="card-img-overlay d-flex flex-column justify-content-end text-white" 
                             style="background: linear-gradient(to bottom, 
                                    rgba(25, 25, 112, 0) 0%, 
                                    rgba(25, 25, 112, 0.7) 100%);">
                            <h5 class="card-title fw-bold mb-0">{{ $berita->judul }}</h5>
                        </div>
                    </div>

                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a href="{{ route('beritas.show', $berita->id) }}" class="btn btn-link p-0 text-primary">
                        Selengkapnya
                    </a>

                        @auth
                        <div>
                            <a href="{{ route('beritas.edit', $berita) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                            <form action="{{ route('beritas.destroy', $berita) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus berita ini?')" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada berita yang dipublikasikan.</div>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $beritas->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="beritaModalLabel">Judul Berita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-3">
          <img id="modalFoto"
               src=""
               alt="Foto Berita"
               class="rounded"
               style="height: 300px; width: auto;">
        </div>

        <p class="text-muted mb-3" style="text-align: left;">
          <span id="modalTanggal"></span>
        </p>

        <p id="modalIsi"></p>
      </div>
    </div>
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

    function showModal(berita) {
        document.getElementById('beritaModalLabel').innerText =
            berita.judul ?? 'Judul tidak tersedia';

        document.getElementById('modalIsi').innerText =
            berita.isi ?? 'Konten tidak tersedia';

        const fotoPath = berita.foto
            ? `/storage/${berita.foto}`
            : 'https://via.placeholder.com/800x400?text=No+Image';
        document.getElementById('modalFoto').src = fotoPath;

        const date = new Date(berita.created_at);
        document.getElementById('modalTanggal').innerText =
            date.toLocaleDateString('id-ID', {
                weekday: 'long',
                day:     'numeric',
                month:   'long',
                year:    'numeric'
            });
    }
</script>

<style>
.card {
    transition: transform 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
}

.pagination {
    margin-bottom: 2rem;
}
    
.page-link {
    color: #191970;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    margin: 0 0.25rem;
}
    
.page-item.active .page-link {
    background-color: #191970;
    border-color: #191970;
}
    
.page-link:hover {
    color: #191970;
    background-color: #e9ecef;
}
</style>
@endsection
