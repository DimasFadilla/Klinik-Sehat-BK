@extends('dokter.layouts.dokter-app')

@section('content')
<div id="content">
  <!-- Navbar dan Informasi Dasar -->
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
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dokter {{ session('dokter_nama') }}</span>
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

<div class="container mt-5">
    <h1 class="mb-4">Profil Dokter</h1>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            Informasi Profil
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <h5>Nama Dokter</h5>
                    <p>{{ $dokter->nama }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Alamat</h5>
                    <p>{{ $dokter->alamat }}</p>
                </div>
                <div class="col-md-4">
                    <h5>No. HP</h5>
                    <p>{{ $dokter->no_hp }}</p>
                </div>
            </div>

            <div class="row">
            <div class="col-md-4">
                    <h5>Poli</h5>
                    <p>{{ optional($dokter->poli)->nama ?? 'Poli tidak ditemukan' }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Jadwal Kerja</h5>
                    <p>Silakan cek jadwal kerja Anda di menu jadwal.</p>
                </div>
            </div>

            <a href="{{ route('dokter.profile.edit-profile') }}" class="btn btn-primary mt-3">Edit Profil</a>
        </div>
    </div>
</div>
@endsection