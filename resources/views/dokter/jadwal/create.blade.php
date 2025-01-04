@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
    <h1>Tambah Jadwal Periksa</h1>
    <form action="{{ route('dokter.jadwal.store') }}" method="POST">
        @csrf

        {{-- Menampilkan Pesan Error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Dropdown untuk Hari --}}
        <div class="form-group">
            <label for="hari">Hari</label>
            <select name="hari" id="hari" class="form-control" required>
                <option value="">-- Pilih Hari --</option>
                @php
                    $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];
                @endphp
                @foreach($days as $day)
                    <option value="{{ $day }}" {{ old('hari') == $day ? 'selected' : '' }}>
                        {{ ucfirst($day) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Input Jam Mulai --}}
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
        </div>

        {{-- Input Jam Selesai --}}
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
