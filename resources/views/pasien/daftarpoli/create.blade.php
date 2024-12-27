<form action="{{ route('pasien.daftar_poli.store') }}" method="POST">
    @csrf
    <label for="id_poli">Pilih Poli:</label>
    <select name="id_poli" id="id_poli" required>
        <option value="">-- Pilih Poli --</option>
        @foreach($polis as $poli)
            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
        @endforeach
    </select>

    <div id="dokter-section">
        <!-- Dokter akan dimuat di sini menggunakan JavaScript -->
    </div>

    <div id="jadwal-section">
        <!-- Jadwal akan dimuat di sini menggunakan JavaScript -->
    </div>

    <label for="keluhan">Keluhan:</label>
    <textarea name="keluhan" required></textarea>

    <button type="submit">Daftar Poli</button>
</form>

<script>
    document.getElementById('id_poli').addEventListener('change', function() {
        let id_poli = this.value;
        if (id_poli) {
            fetch(`{{ url('pasien/daftar-poli/get-dokter') }}/${id_poli}`)
                .then(response => response.json())
                .then(data => {
                    let dokterSection = document.getElementById('dokter-section');
                    dokterSection.innerHTML = '<label for="id_dokter">Pilih Dokter:</label><select name="id_dokter" id="id_dokter" required>';
                    data.forEach(dokter => {
                        dokterSection.innerHTML += `<option value="${dokter.id}">${dokter.nama}</option>`;
                    });
                    dokterSection.innerHTML += '</select>';
                });
        }
    });

    document.getElementById('id_dokter').addEventListener('change', function() {
        let id_dokter = this.value;
        if (id_dokter) {
            fetch(`{{ url('pasien/daftar-poli/get-jadwal') }}/${id_dokter}`)
                .then(response => response.json())
                .then(data => {
                    let jadwalSection = document.getElementById('jadwal-section');
                    jadwalSection.innerHTML = '<label for="id_jadwal">Pilih Jadwal:</label><select name="id_jadwal" required>';
                    data.forEach(jadwal => {
                        jadwalSection.innerHTML += `<option value="${jadwal.id}">${jadwal.hari} - ${jadwal.jam_mulai} s.d. ${jadwal.jam_selesai}</option>`;
                    });
                    jadwalSection.innerHTML += '</select>';
                });
        }
    });
</script>