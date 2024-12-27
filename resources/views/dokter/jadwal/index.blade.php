@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
    <h1>Jadwal Periksa</h1>
    <a href="{{ route('dokter.jadwal.create') }}" class="btn btn-primary">Tambah Jadwal</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Nama Dokter</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwals as $jadwal)
                <tr>
                <td class="py-2 px-4">{{ $jadwal->dokter->nama ?? '-' }}</td> <!-- Sesuaikan dengan relasi dokter -->
                    <td>{{ $jadwal->hari }}</td>
                    <td>{{ $jadwal->jam_mulai }}</td>
                    <td>{{ $jadwal->jam_selesai }}</td>
                    <td>
                        <a href="{{ route('dokter.jadwal.edit', $jadwal) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('dokter.jadwal.destroy', $jadwal) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



