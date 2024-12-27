@extends('pasien.layouts.pasien-app')

@section('content')
<div class="container my-5">
    <!-- Judul Halaman -->
    <h2 class="text-center mb-4">Pendaftaran Poli</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Pendaftaran Poli -->
    <div class="card shadow-lg p-4">
        <div class="card-body">
            <form action="{{ route('daftar.store') }}" method="POST">
                @csrf
                <!-- Keluhan -->
                <div class="mb-4">
                    <label for="keluhan" class="form-label fs-5">Keluhan</label>
                    <textarea name="keluhan" id="keluhan" class="form-control" rows="4" placeholder="Tuliskan keluhan Anda" required></textarea>
                </div>

                <!-- Pilihan Dokter & Jadwal -->
                <div class="mb-4">
                    <label for="id_jadwal" class="form-label fs-5">Pilih Dokter & Jadwal</label>
                    <select name="id_jadwal" id="id_jadwal" class="form-select" required>
                        <option value="" selected disabled>-- Pilih Dokter & Jadwal --</option>
                        @foreach($dokters as $dokter)
                            @foreach($dokter->jadwalPeriksa as $jadwal)
                                <option value="{{ $jadwal->id }}">
                                    {{ $dokter->nama }} - {{ $dokter->poli->nama_poli }} 
                                    ({{ $jadwal->hari }}: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Daftar -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-50">
                        <i class="fas fa-user-check"></i> Daftar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endpush

<!-- @extends('pasien.layouts.pasien-app')

@section('content')
<div class="container">
    <h2>Pendaftaran Poli</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('daftar.poli.store') }}" method="POST">
        @csrf

        <!-- Input Keluhan -->
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" rows="3" required></textarea>
        </div>

        <!-- Pilihan Dokter dan Jadwal -->
        <div class="mb-3">
            <label for="id_jadwal" class="form-label">Pilih Dokter & Jadwal</label>
            <select name="id_jadwal" id="id_jadwal" class="form-select" required>
                <option value="">-- Pilih Dokter & Jadwal --</option>
                @foreach($dokters as $dokter)
                    @foreach($dokter->jadwalPeriksa as $jadwal)
                        <option value="{{ $jadwal->id }}">
                            {{ $dokter->nama }} - {{ $dokter->poli->nama_poli }} 
                            ({{ $jadwal->hari }}: {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }})
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Daftar</button>
    </form>
</div>
@endsection -->




<!-- @extends('pasien.layouts.pasien-app')

@section('content')
<h2>Daftar Poli Saya</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Poli</th>
            <th>Dokter</th>
            <th>Jadwal</th>
            <th>Keluhan</th>
            <th>No Antrian</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($daftarPolis as $daftar)
            <tr>
                <td>{{ $loop-> iteration }}</td>
                <td>{{ $daftar->jadwalPeriksa->dokter->poli->nama_poli }}</td>
                <td>{{ $daftar->jadwalPeriksa->dokter->nama }}</td>
                <td>{{ $daftar->jadwalPeriksa->hari }} - {{ $daftar->jadwalPeriksa->jam_mulai }} s.d. {{ $daftar->jadwalPeriksa->jam_selesai }}</td>
                <td>{{ $daftar->keluhan }}</td>
                <td>{{ $daftar->no_antrian }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pendaftaran poli.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection -->