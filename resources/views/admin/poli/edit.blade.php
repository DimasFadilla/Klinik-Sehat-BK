@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Poli</h4>
        </div>
        <div class="card-body">
            <form id="edit-form" action="{{ route('poli.update', $poli->id) }}" method="POST" onsubmit="return confirmSave()">
                @csrf
                @method('PUT')

                <!-- Input Nama Poli -->
                <div class="mb-3">
                    <label for="nama_poli" class="form-label fw-bold">Nama Poli</label>
                    <input 
                        type="text" 
                        name="nama_poli" 
                        id="nama_poli" 
                        class="form-control @error('nama_poli') is-invalid @enderror" 
                        value="{{ old('nama_poli', $poli->nama_poli) }}" 
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
                        placeholder="Masukkan Keterangan">{{ old('keterangan', $poli->keterangan) }}</textarea>
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
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript Alert -->
<script>
    function confirmSave() {
        return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
    }
</script>
@endsection
