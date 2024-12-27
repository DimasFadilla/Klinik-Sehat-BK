@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Update Profil Dokter</h3>
        </div>
        <div class="card-body">
        <form action="{{ route('dokter.update-profile') }}" method="POST">
            @csrf
            @method('PUT') 

                <div class="form-group mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $dokter->nama }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $dokter->no_hp }}">
                </div>

                <div class="form-group mb-3">
                    <label for="id_poli" class="form-label">Poli</label>
                    <select name="id_poli" id="id_poli" class="form-control" required>
                        @foreach ($polis as $poli)
                            <option value="{{ $poli->id }}" {{ $dokter->id_poli == $poli->id ? 'selected' : '' }}>
                                {{ $poli->nama_poli }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="alamat" class="form-label">Alamat Baru</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $dokter->alamat }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Alamat</label>
                    <input type="text" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi alamat baru" required>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('dokter.profile.profile') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
