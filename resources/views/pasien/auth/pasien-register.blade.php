@extends('layouts.login')

@section('content')
    <section class="login-section">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="card-login" style="width: 100%; max-width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                <h3 class="text-center">Registrasi Pasien</h3>
                
                <!-- Menampilkan pesan error jika ada -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Registrasi Form -->
                <form class="form" action="{{ route('pasien.register.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-input @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="error-message" style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-input @error('alamat') is-invalid @enderror" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat') }}" required>
                        @error('alamat')
                            <div class="error-message" style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_ktp">No KTP</label>
                        <input type="text" class="form-input @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" placeholder="Masukkan No KTP" value="{{ old('no_ktp') }}" required>
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
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-input @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="Masukkan No HP" value="{{ old('no_hp') }}" required>
                        @error('no_hp')
                            <div class="error-message" style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_rm">No RM</label>
                        <input type="text" class="form-input @error('no_rm') is-invalid @enderror" id="no_rm" name="no_rm" placeholder="Masukkan No RM" value="{{ old('no_rm') }}" required>
                        @error('no_rm')
                            <div class="error-message" style="color: red;">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn">Daftar</button>
                </form>

                <p class="text-create-account text-center">Sudah punya akun? <a href="{{ route('pasien.login') }}" class="text-sign-up">Login</a></p>
            </div>
        </div>
    </section>
@endsection
