@extends('layouts.login')

@section('content')
    <section class="login-section">
        <div class="container d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
            <!-- Logo di atas card -->
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-width: 120px;">
            </div>
            
            <div class="card-login" style="width: 100%; max-width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
                <h3 class="text-center">Login Dokter</h3>

                @if ($errors->has('login'))
                <div style="color: red;">{{ $errors->first('login') }}</div>
                    <!-- <div class="alert alert-danger">{{ $errors->first('login') }}</div> -->
                @endif

                <!-- Login Form -->
                <form class="form" action="{{ route('dokter.login.post') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-input" id="name" name="name" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-input" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                </form>
            </div>
        </div>
    </section>
@endsection
