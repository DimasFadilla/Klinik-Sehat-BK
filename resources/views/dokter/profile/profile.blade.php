@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Profil Dokter</h1>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            Informasi Profil
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <h5>Nama Dokter</h5>
                    <p>{{ $dokter->nama }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Alamat</h5>
                    <p>{{ $dokter->alamat }}</p>
                </div>
                <div class="col-md-4">
                    <h5>No. HP</h5>
                    <p>{{ $dokter->no_hp }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                <h5>Poli</h5>
                    <p>{{ $dokter->poli->nama ?? '-' }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Jadwal Kerja</h5>
                    <p>Silakan cek jadwal kerja Anda di menu jadwal.</p>
                </div>
            </div>

            <a href="{{ route('dokter.profile.edit-profile') }}" class="btn btn-primary mt-3">Edit Profil</a>
        </div>
    </div>
</div>
@endsection