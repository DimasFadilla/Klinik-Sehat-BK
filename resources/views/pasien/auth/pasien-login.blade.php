@extends('layouts.login')

@section('content')
    <section class="login-section">
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="card-login" style="width: 100%; max-width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0,0,0,0.1);">
            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Logo di Tengah -->
                <div class="text-center mb-4">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-center">
                </div>
                
                <h3 class="text-center">Log in as Pasien</h3>

                <!-- login form -->
                <form class="form" action="{{ route('pasien.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-input" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-input" id="alamat" name="alamat" placeholder="Enter your alamat" required>
                    </div>
                    <button type="submit" class="btn">Log in</button>
                </form>

                <p class="text-create-account">Don't have an account? <a href="{{ route('pasien.register') }}" class="text-sign-up">Sign up</a></p>
            </div>
        </div>
    </section>
@endsection

<!-- resources/views/pasien/auth/pasien-login.blade.php

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login Pasien</h2>
                <form action="{{ route('pasien.login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                    <div class="text-center mt-3">
                        <a href="{{ route('pasien.register') }}">Registrasi Pasien</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
