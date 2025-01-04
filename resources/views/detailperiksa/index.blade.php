@extends('dokter.layouts.dokter-app')

@section('content')
<h1>Riwayat Pemeriksaan Pasien: {{ $pasien->nama }}</h1>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>Tanggal Pemeriksaan</th>
            <th>Keluhan</th>
            <th>Catatan</th>
            <th>Obat yang Diberikan</th>
            <th>Biaya Pemeriksaan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($daftar_periksa as $periksa)
            <tr>
                <td>{{ $periksa->tgl_periksa }}</td>
                <td>{{ $periksa->keluhan }}</td> <!-- Asumsikan keluhan adalah salah satu field di Periksa -->
                <td>{{ $periksa->catatan }}</td>
                <td>
                    <ul>
                        @foreach($periksa->detailPeriksa as $detail)
                            <li>{{ $detail->obat->nama_obat }}</li> <!-- Menampilkan nama obat -->
                        @endforeach
                    </ul>
                </td>
                <td>{{ $periksa->biaya_periksa }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
