@extends('pasien.layouts.pasien-app')

@section('title', 'Daftar Pendaftaran Poli')

@section('content')
<div class="container mt-4">
    <h3 class="text-center">Pendaftaran Poli Anda</h3>
    <a href="{{ route('daftar.create') }}" class="btn btn-primary">Tambah Daftar</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Dokter</th>
                <th>Poli</th>
                <th>Keluhan</th>
                <th>Nomor Antrian</th>
                <th>Jadwal Praktek</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemeriksaan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->jadwalPeriksa->dokter->nama }}</td>
                    <td>{{ $item->jadwalPeriksa->dokter->poli->nama_poli }}</td>
                    <td>{{ $item->keluhan }}</td>
                    <td>{{ $item->no_antrian }}</td>
                    <td>
                        {{ $item->jadwalPeriksa->hari }} 
                        @ {{ $item->jadwalPeriksa->jam_mulai }} - {{ $item->jadwalPeriksa->jam_selesai }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
