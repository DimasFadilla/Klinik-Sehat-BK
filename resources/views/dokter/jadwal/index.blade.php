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
    <div class="card shadow-lg border-0">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Jadwal Periksa</h3>
        <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-light text-primary btn-sm">Tambah Jadwal</a>
      </div>
      <div class="card-body">
        @if (session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
          <table class="table table-hover table-bordered text-center" style="font-size: 14px;">
            <thead class="thead-dark">
              <tr>
                <th>Nama Dokter</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jadwals as $jadwal)
                <tr>
                  <td class="py-2 px-4">{{ $jadwal->dokter->nama ?? '-' }}</td>
                  <td>{{ $jadwal->hari }}</td>
                  <td>{{ $jadwal->jam_mulai }}</td>
                  <td>{{ $jadwal->jam_selesai }}</td>
                  <td>
                    <a href="{{ route('dokter.jadwal.edit', $jadwal) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('dokter.jadwal.destroy', $jadwal) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        @if ($jadwals->isEmpty())
          <div class="text-center mt-4">
            <p class="text-muted">Belum ada data jadwal periksa.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Tambahkan CSS untuk tampilan -->
<style>
  /* Tabel dengan border dan hover efek */
  .table {
    border-collapse: separate;
    border-spacing: 0;
  }

  .table thead th {
    background-color: #343a40;
    color: #ffffff;
  }

  .table-bordered {
    border: 1px solid #dee2e6;
    border-radius: 8px;
  }

  .table-hover tbody tr:hover {
    background-color: #f8f9fa;
  }

  /* Card header styling */
  .card-header {
    border-radius: 8px 8px 0 0;
    font-size: 16px;
  }

  /* Button styling */
  .btn {
    border-radius: 20px;
  }

  .btn-sm {
    font-size: 12px;
    padding: 5px 10px;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
  }

  .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
  }

  /* Alert styling */
  .alert {
    border-radius: 8px;
    padding: 10px 20px;
  }

  .alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
  }
</style>
@endsection
