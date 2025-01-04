@extends('pasien.layouts.pasien-app')

@section('title', 'Daftar Pendaftaran Poli')

@section('content')
<div class="container-fluid px-0">
  <!-- Navbar dengan lebar penuh dan menyentuh menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-4" style="margin-left: -250px; width: calc(100% + 250px);">
    <a class="navbar-brand ml-3" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
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
    </div>
  </nav>

  <!-- Konten utama -->
  <div class="container mt-4">
    <h3 class="text-center mb-4">Pendaftaran Poli Anda</h3>

    <div class="mb-3 text-right">
      <a href="{{ route('daftar.create') }}" class="btn btn-primary">Tambah Daftar</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <!-- Card Table -->
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Riwayat Pendaftaran Poli</h5>
      </div>
      <div class="card-body p-0">
            <table class="table table-striped mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Dokter</th>
                            <th>Poli</th>
                            <th>Keluhan</th>
                            <th>Nomor Antrian</th>
                            <th>Jadwal Praktek</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($pemeriksaan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->jadwalPeriksa->dokter->nama ?? 'Tidak ada data dokter' }}</td>
            <td>{{ $item->jadwalPeriksa->dokter->poli->nama_poli ?? 'Tidak ada data poli' }}</td>
            <td>{{ $item->keluhan }}</td>
            <td>{{ $item->no_antrian }}</td>
            <td>
                @if($item->jadwalPeriksa)
                    {{ $item->jadwalPeriksa->hari }}
                    @ {{ $item->jadwalPeriksa->jam_mulai }} - {{ $item->jadwalPeriksa->jam_selesai }}
                @else
                    Tidak ada jadwal
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="text-center">Belum ada data pendaftaran.</td>
        </tr>
    @endforelse
</tbody>

            </table>
      </div>
    </div>
  </div>
</div>
@endsection
