@extends('layouts.admin')

@section('content')
@include('admin.navbar-admin')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Pasien</h1>

    <a href="{{ route('admin.pasien.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Tambah Pasien
    </a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. KTP</th>
                            <th>No. HP</th>
                            <th>No. RM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasiens as $pasien)
                            <tr>
                                <td>{{ $pasien->nama }}</td>
                                <td>{{ $pasien->alamat }}</td>
                                <td>{{ $pasien->no_ktp }}</td>
                                <td>{{ $pasien->no_hp }}</td>
                                <td>{{ $pasien->no_rm }}</td>
                                <td>
                                    <a href="{{ route('pasien.edit', $pasien->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-muted">Belum ada data pasien.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
