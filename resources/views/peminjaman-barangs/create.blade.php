@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('homes.index') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Peminjaman Barang</li>

@endsection



@section('content')
<div class="container">
    <h2>Form Peminjaman Barang</h2>
    <form id="peminjamanForm" action="{{ route('peminjaman-barangs.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
            <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" required>
        </div>
        <div class="mb-3">
            <label for="nim_nip" class="form-label">NIM/NIP</label>
            <input type="text" class="form-control" id="nim_nip" name="nim_nip" required>
        </div>
        <div class="mb-3">
            <label for="nomor_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" required>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
            <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
        </div>
        <div class="mb-3">
            <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
            <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tglPinjam = document.getElementById('tanggal_peminjaman');
    const tglKembali = document.getElementById('tanggal_pengembalian');
    const form = document.getElementById('peminjamanForm');
    
    // Set min date untuk tanggal peminjaman ke hari ini
    const today = new Date().toISOString().split('T')[0];
    tglPinjam.min = today;
    tglKembali.min = today;

    // Validasi saat form disubmit
    form.addEventListener('submit', function(e) {
        if(tglKembali.value < tglPinjam.value) {
            e.preventDefault();
            alert('Tanggal pengembalian tidak boleh lebih awal dari tanggal peminjaman!');
            tglKembali.value = tglPinjam.value;
        } else {
            e.preventDefault(); // Prevent default form submission
            
            // Submit form using fetch API
            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                alert('Peminjaman Berhasil Di Ajukan. Terima Kasih!');
                window.location.href = '{{ route("peminjaman-barangs.index") }}';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }
    });
    
    // Update min date tanggal pengembalian saat tanggal peminjaman berubah
    tglPinjam.addEventListener('change', function() {
        tglKembali.min = this.value;
        
        // Reset tanggal pengembalian jika lebih awal dari peminjaman
        if(tglKembali.value && tglKembali.value < this.value) {
            tglKembali.value = this.value;
        }
    });

    // Tambahan validasi saat tanggal pengembalian diubah
    tglKembali.addEventListener('change', function() {
        if(this.value < tglPinjam.value) {
            alert('Tanggal pengembalian tidak boleh lebih awal dari tanggal peminjaman!');
            this.value = tglPinjam.value;
        }
    });
});
</script>
@endsection
