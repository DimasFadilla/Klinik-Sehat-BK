@extends('dokter.layouts.dokter-app')

@section('content')
<h1>Riwayat Pemeriksaan Pasien: {{ $pasien ? $pasien->nama : 'Data tidak ditemukan' }}</h1>
  <table>
    <thead>
      <tr>
        <th>Tanggal Pemeriksaan</th>
        <th>Catatan</th>
        <th>Biaya Pemeriksaan</th>
        <th>Obat yang Diberikan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($daftar_periksa as $periksa)
        <tr>
          <td>{{ $periksa->tgl_periksa }}</td>
          <td>{{ $periksa->catatan }}</td>
          <td>{{ $periksa->biaya_periksa }}</td>
          <td>
            <ul>
              @foreach($periksa->detailPeriksa as $detail)
                <li>{{ $detail->obat->nama_obat }}</li>
              @endforeach
            </ul>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection