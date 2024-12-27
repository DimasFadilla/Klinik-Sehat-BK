@extends('layouts.admin')

@section('content')

@include('admin.navbar-admin')
<div class="container mt-5">
    <h1 class="text-center mb-4">Daftar Obat</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('obat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Obat
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama Obat</th>
                            <th>Kemasan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($obats as $obat)
                            <tr>
                                <td>{{ $obat->nama_obat }}</td>
                                <td>{{ $obat->kemasan }}</td>
                                <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus obat ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada data obat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
