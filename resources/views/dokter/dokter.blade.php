@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Jadwal Dokter</h1>
    <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead class="bg-blue-800 text-white">
            <tr>
                <th class="py-2 px-4">Dokter</th>
                <th class="py-2 px-4">Spesialis</th>
                <th class="py-2 px-4">Hari</th>
                <th class="py-2 px-4">Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwal as $data)
            <tr>
                <td class="py-2 px-4">{{ $data['dokter'] }}</td>
                <td class="py-2 px-4">{{ $data['spesialis'] }}</td>
                <td class="py-2 px-4">{{ $data['hari'] }}</td>
                <td class="py-2 px-4">{{ $data['jam'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
