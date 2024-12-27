@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Data Obat</h1>

    <form action="{{ route('obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Nama Obat -->
                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Nama Obat</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" 
                           value="{{ $obat->nama_obat }}" required>
                </div>

                <!-- Kemasan -->
                <div class="mb-3">
                    <label for="kemasan" class="form-label">Kemasan</label>
                    <input type="text" class="form-control" id="kemasan" name="kemasan" 
                           value="{{ $obat->kemasan }}" required>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" 
                           value="{{ $obat->harga }}" required>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('obat.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
