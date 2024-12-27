<h1>Detail Pasien</h1>
<p>Nama: {{ $pasien->nama }}</p>
<p>Alamat: {{ $pasien->alamat }}</p>
<p>No. KTP: {{ $pasien->no_ktp }}</p>
<p>No. RM: {{ $pasien->no_rm }}</p>
<p>No. HP: {{ $pasien->no_hp }}</p>

<a href="{{ route('pasien.index') }}">Kembali ke Daftar Pasien</a>
