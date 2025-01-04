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
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $dokter->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input 
                        type="text" 
                        name="no_hp" 
                        id="no_hp" 
                        class="form-control @error('no_hp') is-invalid @enderror" 
                        value="{{ old('no_hp', $dokter->no_hp) }}" 
                        required 
                        maxlength="15"
                        minlength="10"
                        pattern="[0-9]+"
                        title="Nomor HP hanya boleh berisi angka, minimal 10 digit dan maksimal 15 digit">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


            <div class="form-group mb-3">
                <label for="id_poli" class="form-label">Poli</label>
                <select name="id_poli" id="id_poli" class="form-control @error('id_poli') is-invalid @enderror" required>
                    @foreach ($polis as $poli)
                        <option value="{{ $poli->id }}" {{ old('id_poli', $dokter->id_poli) == $poli->id ? 'selected' : '' }}>
                            {{ $poli->nama_poli }}
                        </option>
                    @endforeach
                </select>
                @error('id_poli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


                    <div class="form-group mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Alamat</label>
                        <input type="text" name="alamat_confirmation" id="alamat_confirmation" class="form-control @error('alamat_confirmation') is-invalid @enderror" placeholder="Konfirmasi alamat baru" required>
                        @error('alamat_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
