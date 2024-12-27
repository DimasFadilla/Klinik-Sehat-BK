@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">Detail Dokter</h4>
        </div>
        <div class="card-body">
            <p><strong>Nama Dokter:</strong> {{ $dokter->nama }}</p>
            <p><strong>Alamat:</strong> {{ $dokter->alamat }}</p>
            <p><strong>Nomor HP:</strong> {{ $dokter->no_hp }}</p>
            <p><strong>Poli:</strong> {{ $dokter->poli->nama_poli ?? 'Tidak ada poli' }}</p>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <a href="{{ route('dokter.index') }}" class="btn btn-secondary me-2">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Dokter
        </a>
    </div>
</div>
@endsection
