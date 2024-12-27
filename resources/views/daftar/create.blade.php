@extends('pasien.layouts.pasien-app')

@section('title', 'Pendaftaran Poli')

@section('content')
<div class="container mt-4">
    <h3 class="text-center">Pendaftaran Poli</h3>

    <!-- Menampilkan pesan sukses setelah pendaftaran berhasil -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('daftar.store') }}" method="POST">
    @csrf

    <!-- Pilih Poli -->
    <div class="form-group">
        <label for="id_poli">Pilih Poli</label>
        <select id="id_poli" name="id_poli" class="form-control">
    <option value="">Pilih Poli</option>
    @foreach($polis as $poli)
        <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
    @endforeach
</select>
    </div>

    <!-- Pilih Dokter -->
    <div class="form-group">
        <label for="id_dokter">Pilih Dokter</label>
        <select id="id_dokter" name="id_dokter" class="form-control" >
            <option value="">Pilih Dokter</option>
        </select>
    </div>

    <!-- Pilih Jadwal -->
    <div class="form-group">
        <label for="id_jadwal">Pilih Jadwal</label>
        <select id="id_jadwal" name="id_jadwal" class="form-control" >
            <option value="">Pilih Jadwal</option>
        </select>
    </div>

    <!-- Keluhan -->
    <div class="form-group">
        <label for="keluhan">Keluhan</label>
        <textarea id="keluhan" name="keluhan" class="form-control" required></textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Daftar</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
// Mengambil dokter berdasarkan poli
$('#id_poli').change(function() {
    var poli_id = $(this).val();
    console.log('Poli ID yang dipilih:', poli_id); // Debugging

    if (poli_id) {
        $.get('/dokter/' + poli_id, function(data) {
            console.log('Data dokter:', data); // Debugging
            $('#id_dokter').prop('disabled', false).html('<option value="">Pilih Dokter</option>');
            data.forEach(function(dokter) {
                $('#id_dokter').append('<option value="' + dokter.id + '">' + dokter.nama + '</option>');
            });
        }).fail(function(xhr) {
            console.error('Error:', xhr.responseText); // Debugging error
            alert('Gagal memuat data dokter.');
        });
    } else {
        $('#id_dokter').prop('disabled', true).html('<option value="">Pilih Dokter</option>');
    }
});

// Mengambil jadwal berdasarkan dokter
$('#id_dokter').change(function() {
    var dokter_id = $(this).val();
    console.log('Dokter ID yang dipilih:', dokter_id); // Debugging

    if (dokter_id) {
        $.get('/jadwal/' + dokter_id, function(data) {
            console.log('Data jadwal:', data); // Debugging
            $('#id_jadwal').prop('disabled', false).html('<option value="">Pilih Jadwal</option>');
            data.forEach(function(jadwal) {
                $('#id_jadwal').append('<option value="' + jadwal.id + '">' + jadwal.hari + ' ' + jadwal.jam_mulai + ' - ' + jadwal.jam_selesai + '</option>');
            });
        }).fail(function(xhr) {
            console.error('Error:', xhr.responseText); // Debugging error
            alert('Gagal memuat data jadwal.');
        });
    } else {
        $('#id_jadwal').prop('disabled', true).html('<option value="">Pilih Jadwal</option>');
    }
});

</script>
@endsection
