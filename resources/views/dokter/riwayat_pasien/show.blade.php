<!-- resources/views/riwayat_pasien/show.blade.php -->

@extends('dokter.layouts.dokter-app')

@section('content')
<div class="container">
    <h1>Riwayat Pemeriksaan Pasien: {{ $pasien->nama }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal Pemeriksaan</th>
                <th>Keluhan</th>
                <th>Diagnosa</th>
                <th>Obat yang Diresepkan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($periksa as $item)
            <tr>
                <td>{{ $item->tanggal_periksa }}</td>
                <td>{{ $item->keluhan }}</td>
                <td>{{ $item->diagnosa }}</td>
                <td>
                    @foreach($item->detail_periksa as $detail)
                        {{ $detail->obat->nama }}@if (!$loop->last), @endif
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection