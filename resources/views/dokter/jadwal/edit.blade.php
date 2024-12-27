@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
    <h1>Edit Jadwal Periksa</h1>

    <form action="{{ route('dokter.jadwal.update', $jadwal) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="hari">Hari</label>
            <input type="text" class="form-control" id="hari" name="hari" value="{{ $jadwal->hari }}" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $jadwal->jam_mulai }}" required>
        </div>
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $jadwal->jam_selesai }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('dokter.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection