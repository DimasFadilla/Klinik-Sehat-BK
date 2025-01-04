@extends('pasien.layouts.pasien-app')

@section('title', 'Pendaftaran Poli')

@section('content')
<div class="container-fluid px-0">
  <!-- Navbar dengan lebar penuh dan menyentuh menu -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow mb-4" style="margin-left: -250px; width: calc(100% + 250px);">
    <a class="navbar-brand ml-3" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('pasien_nama') }}</span>
            <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="{{ route('pasien.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('pasien.logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Form Pendaftaran Poli</h3>
      </div>
      <div class="card-body">
        <!-- Menampilkan pesan sukses -->
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('daftar.store') }}" method="POST">
          @csrf

          <!-- Pilih Poli -->
          <div class="form-group">
            <label for="id_poli" class="font-weight-bold">Pilih Poli</label>
            <select id="id_poli" name="id_poli" class="form-control" required>
              <option value="">Pilih Poli</option>
              @foreach($polis as $poli)
                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
              @endforeach
            </select>
          </div>

          <!-- Pilih Jadwal -->
          <div class="form-group">
            <label for="id_jadwal" class="font-weight-bold">Pilih Jadwal</label>
            <select id="id_jadwal" name="id_jadwal" class="form-control" disabled required>
              <option value="">Pilih Jadwal</option>
            </select>
          </div>

          <!-- Keluhan -->
          <div class="form-group">
            <label for="keluhan" class="font-weight-bold">Keluhan</label>
            <textarea id="keluhan" name="keluhan" class="form-control" rows="4" placeholder="Tulis keluhan Anda..." required></textarea>
          </div>

          <!-- Submit Button -->
          <div class="text-right">
            <button type="submit" class="btn btn-success">Daftar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Ambil jadwal berdasarkan poli
    $('#id_poli').change(function() {
        var poli_id = $(this).val();
        console.log('Poli ID:', poli_id);

        if (poli_id) {
            $.get('/jadwal-by-poli/' + poli_id, function(data) {
                console.log('Data Jadwal:', data);
                $('#id_jadwal').prop('disabled', false).html('<option value="">Pilih Jadwal</option>');
                data.forEach(function(jadwal) {
                    $('#id_jadwal').append(
                        '<option value="' + jadwal.id + '">' + 
                        jadwal.hari + ' (' + jadwal.jam_mulai + ' - ' + jadwal.jam_selesai + ')</option>'
                    );
                });
            }).fail(function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Gagal memuat data jadwal.');
            });
        } else {
            $('#id_jadwal').prop('disabled', true).html('<option value="">Pilih Jadwal</option>');
        }
    });
});
</script>
@endsection
