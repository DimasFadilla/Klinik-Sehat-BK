@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Dokter</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('dokter.store') }}" method="POST">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Dokter</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                </div>

                <!-- Input Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                </div>

                <!-- Input Nomor HP -->
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" required>
                </div>

                <!-- Input Poli -->
                <div class="mb-3">
                    <label for="id_poli" class="form-label">Poli</label>
                    <select name="id_poli" id="id_poli" class="form-select" required>
                        <option value="" disabled selected>Pilih Poli</option>
                        @foreach ($polis as $poli)
                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('dokter.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Tambah Dokter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
