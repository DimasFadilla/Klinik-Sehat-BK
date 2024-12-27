@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Pasien</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Field Nama -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $pasien->nama }}" required>
                </div>

                <!-- Field Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $pasien->alamat }}" required>
                </div>

                <!-- Field No. KTP -->
                <div class="mb-3">
                    <label for="no_ktp" class="form-label">No. KTP</label>
                    <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{ $pasien->no_ktp }}" required>
                </div>

                <!-- Field No. HP -->
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $pasien->no_hp }}" required>
                </div>

                <!-- Field No. RM -->
                <div class="mb-3">
                    <label for="no_rm" class="form-label">No. RM</label>
                    <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ $pasien->no_rm }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('pasien.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save">Simpan Perubahan</i> 
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
