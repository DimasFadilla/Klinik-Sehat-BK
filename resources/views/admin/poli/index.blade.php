@extends('layouts.admin')

@section('content')
@include('admin.navbar-admin')

<div class="container mt-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary">Daftar Poli</h1>
        <a href="{{ route('poli.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Poli
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Poli</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-uppercase">Nama Poli</th>
                            <th class="text-uppercase">Keterangan</th>
                            <th class="text-uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($polis as $poli)
                            <tr>
                                <td class="fw-bold">{{ $poli->nama_poli }}</td>
                                <td>{{ $poli->keterangan }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus poli ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted">Data poli belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
