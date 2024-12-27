@extends('layouts.login')

@section('content')
    <section class="login-section">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="card-login" style="width: 100%; max-width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                <h3 class="text-center">Registrasi Pasien</h3>

                <!-- Registrasi Form -->
                <form class="form" action="{{ route('pasien.register.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-input" id="name" name="name" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-input" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="no_ktp">No KTP</label>
                        <input type="text" class="form-input" id="no_ktp" name="no_ktp" placeholder="Masukkan No KTP" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-input" id="no_hp" name="no_hp" placeholder="Masukkan No HP" required>
                    </div>
                    <div class="form-group">
                        <label for="no_rm">No RM</label>
                        <input type="text" class="form-input" id="no_rm" name="no_rm" placeholder="Masukkan No RM" required>
                    </div>
                    <button type="submit" class="btn">Daftar</button>
                </form>

                <p class="text-create-account text-center">Sudah punya akun? <a href="{{ route('pasien.login') }}" class="text-sign-up">Login</a></p>
            </div>
        </div>
    </section>
@endsection
