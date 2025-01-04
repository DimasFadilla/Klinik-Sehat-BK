@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
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

    <h1 class="h3 mb-4 text-gray-800">Detail Pemeriksaan Pasien</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Pasien</h6>
        </div>
        <div class="card-body">
            <p><strong>Nama Pasien:</strong> {{ $pasien->pasien->nama }}</p>
            <p><strong>Keluhan:</strong> {{ $pasien->keluhan }}</p>
            <p><strong>Tanggal Periksa:</strong> {{ $pasien->periksa->tgl_periksa ?? 'Belum diperiksa' }}</p>
            <p><strong>Catatan Dokter:</strong> {{ $pasien->periksa->catatan ?? 'Belum ada catatan' }}</p>
            <p><strong>Biaya Periksa:</strong> Rp {{ number_format($pasien->periksa->biaya_periksa ?? 0, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Obat</h6>
        </div>
        <div class="card-body">
            @if($pasien->periksa && $pasien->periksa->detailPeriksa->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pasien->periksa->detailPeriksa as $detail)
                            <tr>
                                <td>{{ $detail->obat->nama_obat }}</td>
                                <td>Rp {{ number_format($detail->obat->harga, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">Tidak ada obat yang diberikan.</p>
            @endif
        </div>
    </div>
</div>
@endsection
