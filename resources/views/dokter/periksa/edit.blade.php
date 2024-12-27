@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Periksa Pasien</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('periksa.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nama_pasien" class="form-label">Nama Pasien</label>
                    <input type="text" class="form-control" id="nama_pasien" value="{{ $pasien->pasien->nama }}" disabled>
                </div>

                <div class="form-group mb-3">
                    <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
                    <input type="datetime-local" name="tgl_periksa" id="tgl_periksa" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="catatan" class="form-label">Catatan</label>
                    <textarea name="catatan" id="catatan" class="form-control" rows="4" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="obat" class="form-label">Obat</label>
                    <input type="text" name="obat[]" id="obat" class="form-control" placeholder="Nama Obat" required>
                    <small class="form-text text-muted">Masukkan obat yang diberikan pada pasien.</small>
                </div>

                <div class="form-group mb-3">
                    <label for="biaya_periksa" class="form-label">Biaya Periksa</label>
                    <input type="number" name="biaya_periksa" id="biaya_periksa" class="form-control" required>
                    <small class="form-text text-muted">Masukkan biaya periksa pasien.</small>
                </div>
                
                <div class="form-group mb-3">
                        <label for="obat" class="form-label">Obat</label>
                <div id="obat-container">
                    <input type="text" name="obat[]" class="form-control mb-2" placeholder="Nama Obat" required>
                </div>
                <button type="button" id="add-obat" class="btn btn-link">Tambah Obat</button>
            </div>

                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('periksa.index') }}" class="btn btn-outline-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('add-obat').addEventListener('click', function() {
        var container = document.getElementById('obat-container');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'obat[]';
        input.classList.add('form-control', 'mb-2');
        input.placeholder = 'Nama Obat';
        container.appendChild(input);
    });
</script>
@endsection
