@extends('pasien.layouts.pasien-app')

@section('content')
<div id="content">
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

    <div class="container">
        <!-- Section for Patient Dashboard -->
        <div class="card shadow-sm p-4">
            <h1 class="text-center mb-4">Welcome, {{ $pasien->nama }}</h1>
            
            <!-- Display Patient Information -->
            <div class="patient-info">
                <div class="mb-3">
                    <strong>Alamat:</strong> {{ $pasien->alamat }}
                </div>
                <div class="mb-3">
                    <strong>No. HP:</strong> {{ $pasien->no_hp }}
                </div>
                <div class="mb-3">
                    <strong>No. KTP:</strong> {{ $pasien->no_ktp }}
                </div>
            </div>


    <h2>Riwayat Pemeriksaan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keluhan</th>
                <th>Diagnosis</th>
            </tr>
        </thead>
        <tbody>
        @if($pemeriksaan)
        @foreach ($pemeriksaan as $item)
            <tr>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->keluhan }}</td>
                <td>{{ $item->diagnosis }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3" class="text-center">Tidak ada data pemeriksaan.</td>
        </tr>
    @endif
        </tbody>
    </table>
            
            <!-- Logout Button -->
            
        </div>
    </div>
</div>
@endsection
