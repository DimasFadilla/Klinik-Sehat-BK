@extends('layouts.admin')

@section('content')
@include('admin.navbar-admin')
<div class="container mt-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary">Daftar Dokter</h1>
        <a href="{{ route('dokter.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Dokter
        </a>
    </div>

    <!-- Tabel Dokter -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Dokter</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Dokter</th>
                            <th>Alamat</th>
                            <th>Nomor HP</th>
                            <th>Poli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dokters as $dokter)
                            <tr>
                                <td>{{ $dokter->nama }}</td>
                                <td>{{ $dokter->alamat }}</td>
                                <td>{{ $dokter->no_hp }}</td>
                                <td>{{ $dokter->poli->nama_poli ?? 'Tidak ada poli' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data Dokter ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data dokter.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
