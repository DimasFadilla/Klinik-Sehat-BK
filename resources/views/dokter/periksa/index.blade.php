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

    <!-- Daftar Pasien Belum Diperiksa -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Daftar Pasien Belum Diperiksa</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pasien Menunggu Pemeriksaan</h6>
            </div>
            <div class="card-body">
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
                        @forelse($daftarBelumDiperiksa as $index => $pasien)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pasien->pasien->nama }}</td>
                            <td>{{ $pasien->keluhan }}</td>
                            <td>
                                @if($pasien->periksa)
                                    {{ $pasien->periksa->catatan }}
                                @else
                                    <span class="text-warning">Belum ada catatan pemeriksaan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dokter.periksa.edit', $pasien->id) }}" class="btn btn-info btn-sm" >Periksa Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada pasien yang menunggu pemeriksaan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Daftar Pasien Selesai Diperiksa -->
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Daftar Pasien Selesai Diperiksa</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Riwayat Pemeriksaan Pasien</h6>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Keluhan</th>
                            <th>Catatan Pemeriksaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarSelesaiDiperiksa as $index => $pasien)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pasien->pasien->nama }}</td>
                            <td>{{ $pasien->keluhan }}</td>
                            <td>{{ $pasien->periksa->catatan ?? 'Belum ada catatan' }}</td>
                            <td>
                                <a href="{{ route('dokter.periksa.detail', $pasien->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada pasien selesai diperiksa</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
