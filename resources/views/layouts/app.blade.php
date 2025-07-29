<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Lab. Jaringan Komputer, Keamanan Data, dan Internet of Things</title>
  <link rel="icon" href="{{ asset('storage/logo/logo1.png') }}" type="image/png">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    html, body {
      height: 100%;
      min-height: 100vh;
      margin: 0;
      padding: 0;
      padding-top: 56px;
    }

    body {
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
      min-height: calc(100vh - 56px - 60px); /* 56px navbar, 60px footer */
      padding-bottom: 2rem;
    }

    footer {
      flex-shrink: 0;
      background-color: #191970;
      color: white;
      padding: 1rem 0;
    }

    .navbar {
      box-shadow: 0 10px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-item a {
      color: white;
      font-size: 12px;
    }

    .nav-item a:hover {
      color: rgb(104,108,109);
    }

    .navbar-brand-text {
      color: white;
      margin-left: 0.5rem;
      font-size: 20px;
      font-weight: 500;
    }
  </style>
</head>

<body class="mt-0 pt-0">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#191970;">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ secure_asset('storage/logo/logo1.png') }}" alt="Logo" style="max-width: 60px; height: auto;">
        <span class="navbar-brand-text">Lab. Jaringan Komputer, Keamanan Data, dan Internet of Things</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ route('homes.index') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('dosens.index') }}">Dosen</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('beritas.index') }}">Berita</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Event</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('peminjaman-barangs.index') }}">Peminjaman</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('permintaans.index') }}">Permintaan</a></li>

          @auth
            <li class="nav-item"><a class="nav-link" href="{{ route('kehadirans.index') }}">Kehadiran</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.changePasswordForm') }}">Admin</a></li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="btnLogout">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
          @else
            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main>
    {{-- Breadcrumb Section --}}
    @hasSection('breadcrumb')
      <div class="container mt-5">
        <nav aria-label="breadcrumb" class="mb-3 d-inline-block" style="margin-left: 13px;">
          <ol class="breadcrumb bg-white p-2 rounded shadow-sm mb-0">
            @yield('breadcrumb')
          </ol>
        </nav>
      </div>
    @endif

    {{-- Flash Messages via SweetAlert --}}
    <div class="container">
      {{-- Page Content --}}
      @yield('content')
    </div>
  </main>

  <!-- Footer -->
  @include('layouts.footer')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert Logout Confirmation -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const logoutBtn = document.getElementById('btnLogout');
      if (logoutBtn) {
        logoutBtn.addEventListener('click', function (e) {
          e.preventDefault();
          Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Anda akan keluar dari sesi saat ini.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
          }).then((result) => {
            if (result.isConfirmed) {
              document.getElementById('logout-form').submit();
            }
          });
        });
      }

      // Optional: tampilkan flash message sukses sebagai SweetAlert
      @if(session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: "{{ session('success') }}",
          confirmButtonText: 'OK'
        });
      @endif
    });
  </script>
</body>
</html>
