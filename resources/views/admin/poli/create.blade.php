@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Poli</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('poli.store') }}" method="POST">
                @csrf

                <!-- Input Nama Poli -->
                <div class="mb-3">
                    <label for="nama_poli" class="form-label fw-bold">Nama Poli</label>
                    <input 
                        type="text" 
                        name="nama_poli" 
                        id="nama_poli" 
                        class="form-control @error('nama_poli') is-invalid @enderror" 
                        value="{{ old('nama_poli') }}" 
                        required 
                        placeholder="Masukkan Nama Poli">
                    @error('nama_poli')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Input Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                    <textarea 
                        name="keterangan" 
                        id="keterangan" 
                        rows="3" 
                        class="form-control @error('keterangan') is-invalid @enderror" 
                        placeholder="Masukkan Keterangan">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('poli.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
