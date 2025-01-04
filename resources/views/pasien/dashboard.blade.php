@extends('pasien.layouts.pasien-app')

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
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('pasien_nama') }}</span>
          <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('pasien.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('pasien.logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="card shadow-sm p-4">
      <h1 class="text-center mb-4">Selamat Datang, {{ $pasien->nama }}</h1>

      <!-- Informasi Pasien -->
      <div class="patient-info mb-4">
        <div><strong>Alamat:</strong> {{ $pasien->alamat }}</div>
        <div><strong>No. HP:</strong> {{ $pasien->no_hp }}</div>
        <div><strong>No. KTP:</strong> {{ $pasien->no_ktp }}</div>
      </div>

      <!-- Riwayat Pemeriksaan -->
      <h2>Riwayat Pemeriksaan</h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Keluhan</th>
            <th>Catatan</th>
            <th>Obat</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($pemeriksaan as $item)
          <tr>
            <td>{{ $item->tgl_periksa }}</td>
            <td>{{ $item->keluhan }}</td>
            <td>{{ $item->catatan }}</td>
            <td>
              @if ($item->detailPeriksa->isNotEmpty())
                <ul>
                  @foreach ($item->detailPeriksa as $detail)
                    <li>{{ $detail->obat->nama_obat }} - {{ $detail->obat->kemasan }}</li>
                  @endforeach
                </ul>
              @else
                Tidak ada obat.
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center">Tidak ada data pemeriksaan.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
