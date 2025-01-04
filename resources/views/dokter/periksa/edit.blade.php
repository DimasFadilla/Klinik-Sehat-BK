@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Form Pemeriksaan Pasien</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('periksa.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Informasi Pasien -->
                <div class="form-group">
                    <label for="nama_pasien"><strong>Nama Pasien</strong></label>
                    <input type="text" id="nama_pasien" class="form-control" value="{{ $pasien->pasien->nama }}" readonly>
                </div>

                <!-- Informasi Dokter -->
                <div class="form-group">
                    <label for="nama_dokter"><strong>Nama Dokter</strong></label>
                    <input type="text" id="nama_dokter" class="form-control" value="{{ $pasien->jadwalPeriksa->dokter->nama }}" readonly>
                </div>

                <!-- Keluhan Pasien -->
                <div class="form-group">
                    <label for="keluhan"><strong>Keluhan Pasien</strong></label>
                    <textarea id="keluhan" class="form-control" rows="3" readonly>{{ $pasien->keluhan }}</textarea>
                </div>

                <!-- Tanggal Periksa -->
                <div class="form-group">
                    <label for="tgl_periksa"><strong>Tanggal Periksa</strong></label>
                    <input type="date" id="tgl_periksa" name="tgl_periksa" class="form-control" required>
                </div>

                <!-- Catatan Pemeriksaan -->
                <div class="form-group">
                    <label for="catatan"><strong>Catatan Pemeriksaan</strong></label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="4" placeholder="Masukkan catatan pemeriksaan..." required></textarea>
                </div>

                <!-- Pilih Obat -->
                <div class="form-group">
                    <label for="obat"><strong>Pilih Obat</strong></label>
                    <select id="obat" name="obat[]" class="form-control" multiple>
                        @foreach($obatList as $obat)
                            <option value="{{ $obat->id }}">{{ $obat->nama_obat }} - Rp {{ number_format($obat->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Pilih obat yang diberikan kepada pasien (Tekan <kbd>Ctrl</kbd> untuk memilih lebih dari satu).</small>
                </div>

                <!-- Total Biaya -->
                <div class="form-group">
                    <label for="biaya_periksa"><strong>Biaya Periksa</strong></label>
                    <input type="text" id="biaya_periksa" name="biaya_periksa" class="form-control" readonly placeholder="Total biaya akan dihitung otomatis">
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Pemeriksaan</button>
                    <a href="{{ route('dokter.periksa.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk menghitung total biaya -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const obatSelect = document.getElementById('obat');
        const biayaPeriksaInput = document.getElementById('biaya_periksa');

        // Biaya jasa dokter tetap
        const biayaJasaDokter = 150000;

        // Event listener saat obat dipilih/dihapus
        obatSelect.addEventListener('change', function () {
            let selectedOptions = Array.from(obatSelect.selectedOptions);
            let totalHargaObat = selectedOptions.reduce((sum, option) => {
                let harga = parseInt(option.textContent.split('- Rp ')[1].replace(/\./g, ''));
                return sum + harga;
            }, 0);

            // Hitung total biaya periksa
            biayaPeriksaInput.value = new Intl.NumberFormat('id-ID').format(biayaJasaDokter + totalHargaObat);
        });
    });
</script>
@endsection
