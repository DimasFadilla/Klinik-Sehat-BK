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

  <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Pasien</h1>
    <p class="mb-4">Daftar pasien Anda</p>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pasien Anda</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Pasien</th>
                <th>Alamat Pasien</th>
                <th>Jadwal</th>
                <th>Keluhan</th>
                <th>Obat</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pasiens as $pasien)
              <tr>
                <td>{{ $pasien['nama'] }}</td>
                <td>{{ $pasien['alamat'] }}</td>
                <td>{{ $pasien['jadwal'] }}</td>
                <td>{{ $pasien['keluhan'] }}</td>
                <td>{{ $pasien['obat'] }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">Belum ada data pasien</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
