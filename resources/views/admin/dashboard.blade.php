@extends('layouts.admin')

@section('content')
@include('admin.navbar-admin')

<div class="container-fluid">
    <!-- Judul Dashboard -->
    <h1 class="mb-5 text-center text-dark">Dashboard Admin</h1>

    <!-- Card Statistik - Tengah -->
    <div class="row d-flex justify-content-center mb-5">
        <!-- Total Dokter -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow-lg h-100 py-4">
                <div class="card-body text-center">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Dokter</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $dokterCount }}</div>
                    <i class="fas fa-user-md fa-3x text-primary mt-3"></i>
                </div>
            </div>
        </div>

        <!-- Total Pasien -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow-lg h-100 py-4">
                <div class="card-body text-center">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pasien</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $pasienCount }}</div>
                    <i class="fas fa-users fa-3x text-success mt-3"></i>
                </div>
            </div>
        </div>

        <!-- Total Poli -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow-lg h-100 py-4">
                <div class="card-body text-center">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Poli</div>
                    <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $polisCount }}</div>
                    <i class="fas fa-clinic-medical fa-3x text-info mt-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
    <!-- Tabel Daftar Dokter dalam Card -->
    <div class="card mb-5 shadow">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0 text-uppercase">Daftar Dokter</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light text-dark">
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
        </div>
    </div>

    <!-- Tabel Daftar Pasien dalam Card -->
    <div class="card mb-5 shadow">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0 text-uppercase">Daftar Pasien</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="bg-light text-dark">
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
    </div>

</div>

<!-- Footer -->
<footer class="bg-light py-4 text-center mt-5">
    <div class="container">
        <span class="text-muted">&copy; 2024 Klinik Sehat. All Rights Reserved.</span>
    </div>
</footer>

<!-- CSS Custom untuk Dashboard Admin -->
<style>
    /* Mengatur Gaya Umum */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f8f9fc;
        color: #333;
    }

    /* Card Statistik */
    .card {
    border-radius: 8px;
    overflow: hidden;
}

.card-header {
    font-weight: bold;
    font-size: 1.5rem;
    text-transform: uppercase;
}

    .card-body {
        padding: 1.5rem;
    }

    /* Menambahkan efek hover pada card */
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Card dengan warna tertentu */
    .card.border-left-primary {
        border-left: 5px solid #4e73df;
    }

    .card.border-left-success {
        border-left: 5px solid #1cc88a;
    }

    .card.border-left-info {
        border-left: 5px solid #36b9cc;
    }

    /* Judul Tabel */
    h2 {
        font-size: 1.8rem;
        color:rgb(0, 0, 0);
        font-weight: bold;
        margin-bottom: 1rem;
    }

    /* Tabel */
    table {
    border-collapse: separate;
    border-spacing: 0;
}

.table th, .table td {
    padding: 1rem;
    text-align: center;
    vertical-align: middle;
    border: 1px solid #ddd;
}

.table thead tr {
    background-color: #f8f9fa;
    color: #333;
    font-weight: bold;
}

    .table tbody tr:nth-child(even) {
        background-color: #f4f6fc;
    }

    .table tbody tr:hover {
    background-color: #e9ecef;
}

    /* Footer */
    footer {
        background-color: #f1f1f1;
        border-top: 1px solid #e3e6f0;
    }

    footer .container {
        padding: 0.5rem;
        font-size: 0.875rem;
        color: #6c757d;
    }
    /* Colors for Text */
.text-primary {
    color:rgb(0, 86, 179) !important;
}

.text-success {
    color: #28a745 !important;
}

.bg-primary {
    background-color: #0056b3 !important;
}

.bg-success {
    background-color: #28a745 !important;
}

.text-white {
    color: #fff !important;
}

.text-dark {
    color: #212529 !important;
}

    /* Menambahkan Responsivitas */
    @media (max-width: 768px) {
        .row .col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        h1, h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .card-body {
            padding: 1rem;
        }

        .table th, .table td {
            font-size: 0.875rem;
            padding: 0.75rem;
        }

        footer .container {
            font-size: 0.75rem;
        }
    }
</style>

@endsection
