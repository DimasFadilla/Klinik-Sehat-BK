@extends('layouts.login')

@section('content')
    <style>
        /* CSS Khusus untuk Halaman Login */
        body {
            background-color: #001f3f; /* Biru navy */
            color: #ffffff; /* Warna teks putih agar kontras dengan background */
        }
        .login-section {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-login {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.3); /* Shadow lebih gelap */
            padding: 30px;
            max-width: 400px;
            width: 100%;
        }
        .card-login h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333333; /* Warna teks di card */
        }
        .form-group label {
            font-size: 14px;
            font-weight: bold;
            color: #555555; /* Warna teks label di card */
        }
        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            color: #001f3f;
        }
        .form-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            color: #ffffff;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            color: #ffffff;
            cursor: pointer;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        .text-center img {
            max-width: 120px;
            filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.2)); /* Tambahkan shadow untuk logo */
        }
    </style>

    <section class="login-section">
        <div class="container d-flex justify-content-center align-items-center flex-column">
            <!-- Logo di atas card -->
            <div class="text-center mb-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
            </div>
            
            <!-- Card Login -->
            <div class="card-login">
                <h3>Login Dokter</h3>

                @if ($errors->has('login'))
                    <div style="color: red; text-align: center; margin-bottom: 15px;">
                        {{ $errors->first('login') }}
                    </div>
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
                        <input type="password" class="form-input" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('welcome') }}" class="btn btn-secondary">Kembali</a> 
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
