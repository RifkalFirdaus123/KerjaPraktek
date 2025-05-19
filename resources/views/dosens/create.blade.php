@extends('layouts.app')

@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
  <li class="breadcrumb-item"><a href="{{ route('dosens.index') }}">Dosen</a></li>
  <li class="breadcrumb-item active" aria-current="page">Tambah Dosen</li>
@endsection

@section('content')
<div class="container">
    <h1>Tambah Dosen</h1>

    <!-- @if($errors->any())
      <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
        </ul>
      </div>
    @endif -->

    <form action="{{ route('dosens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>
        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-select" required>
                <option value="">-- Pilih Status --</option>
                <option value="Anggota" {{ old('status') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                <option value="Sekretaris KK" {{ old('status') == 'Sekretaris KK' ? 'selected' : '' }}>Sekretaris KK</option>
                <option value="Ketua KK" {{ old('status') == 'Ketua KK' ? 'selected' : '' }}>Ketua KK</option>
                <option value="Kepala Lab" {{ old('status') == 'Kepala Lab' ? 'selected' : '' }}>Kepala Lab</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Mata Kuliah Diampu</label>
            <div id="matkul-list">
                @if(old('matkul'))
                    @foreach(old('matkul') as $mk)
                        <div class="input-group mb-2">
                            <input type="text" name="matkul[]" class="form-control" value="{{ $mk }}" required>
                            <button type="button" class="btn btn-danger btn-remove-mk">Hapus</button>
                        </div>
                    @endforeach
                @else
                    <div class="input-group mb-2">
                        <input type="text" name="matkul[]" class="form-control" required>
                        <button type="button" class="btn btn-danger btn-remove-mk">Hapus</button>
                    </div>
                @endif
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-mk">Tambah Mata Kuliah</button>
        </div>
        <div class="mb-3">
            <label>Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('dosens.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-mk').onclick = function() {
        let mkList = document.getElementById('matkul-list');
        let div = document.createElement('div');
        div.className = 'input-group mb-2';
        div.innerHTML = `<input type="text" name="matkul[]" class="form-control" required>
            <button type="button" class="btn btn-danger btn-remove-mk">Hapus</button>`;
        mkList.appendChild(div);
    };
    document.addEventListener('click', function(e) {
        if(e.target.classList.contains('btn-remove-mk')) {
            e.target.parentElement.remove();
        }
    });
});
</script>
@endsection
