@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Pasien</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tampilkan error jika ada -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Edit Pasien -->
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
                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                    
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="form-text text-muted">
                        Contoh format yang benar: <strong>08xxxxxxxxxx</strong> atau <strong>62xxxxxxxxxx</strong> (tanpa spasi atau karakter lain).
                    </small>

                    <!-- Menambahkan elemen untuk menampilkan pesan error ketika format tidak valid -->
                    <div id="phone-help" style="display: none; color: red;"></div>
                </div>

                <script>
                    document.getElementById('no_hp').addEventListener('input', function(event) {
                        var phoneNumber = event.target.value.replace(/[^0-9]/g, ''); // Menghapus karakter selain angka
                        var regex = /^(08|62)[0-9]{8,12}$/; // Regex untuk format nomor HP
                        
                        var message = document.getElementById('phone-help');
                        if (!regex.test(phoneNumber)) {
                            message.style.display = 'block';
                            message.innerHTML = 'Format nomor tidak valid. Pastikan nomor dimulai dengan 08 atau 62 dan memiliki 8-12 digit.';
                            message.style.color = 'red';
                        } else {
                            message.style.display = 'none';
                        }
                    });
                </script>


                <!-- Field No. RM -->
                <div class="mb-3">
                    <label for="no_rm" class="form-label">No. RM</label>
                    <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ $pasien->no_rm }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.pasien.index') }}" class="btn btn-secondary me-2">
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
