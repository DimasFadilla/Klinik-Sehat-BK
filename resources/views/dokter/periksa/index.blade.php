@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            </form>
            <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('dokter_nama') }}</span>
                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('dokter.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('dokter.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </div>
            </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <h1 class="h3 mb-2 text-gray-800">Daftar Periksa Pasien</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No Urut</th>
                        <th>Nama Pasien</th>
                        <th>Keluhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($daftarPasien as $index => $pasien)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pasien->pasien->nama }}</td>
                        <td>{{ $pasien->keluhan }}</td>
                        <td>
                            <a href="{{ route('periksa.edit', $pasien->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endsection
