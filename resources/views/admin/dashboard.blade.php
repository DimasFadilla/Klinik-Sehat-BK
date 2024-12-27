@extends('layouts.admin')

@section('content')
@include('admin.navbar-admin')

<div class="container">
    <!-- Judul Dashboard -->
    <h1 class="mb-4 text-center">Dashboard Admin</h1>

    <!-- Card Statistik -->
    <div class="row">
        <!-- Total Dokter -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Dokter</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dokterCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Pasien -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pasien</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pasienCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Poli -->
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Poli</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $polisCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      

    <!-- Tabel Daftar Dokter -->
    <h2 class="mt-4">Daftar Dokter</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Nama</th>
                    <th>Poli</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokters as $dokter)
                <tr>
                    <td>{{ $dokter->nama }}</td>
                    <td>{{ $dokter->poli->nama_poli ?? 'Tidak Ada' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel Daftar Pasien -->
    <h2 class="mt-4">Daftar Pasien</h2>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="bg-success text-white">
                <tr>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasiens as $pasien)
                <tr>
                    <td>{{ $pasien->nama }}</td>
                    <td>{{ $pasien->no_hp }}</td>
                    <td>{{ $pasien->alamat }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light py-3 text-center">
    <div class="container">
        <span class="text-muted">&copy; 2024 Klinik Sehat. All Rights Reserved.</span>
    </div>
</footer>

@endsection
