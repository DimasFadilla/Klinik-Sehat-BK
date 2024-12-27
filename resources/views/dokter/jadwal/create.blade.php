@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
    <h1>Tambah Jadwal Periksa</h1>
    <form action="{{ route('dokter.jadwal.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="hari">Hari</label>
            <input type="text" name="hari" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection