@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mengelola Poli</h1>
    <a href="{{ route('poli.create') }}" class="btn btn-primary mb-3">Tambah Poli</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Poli</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($polis as $poli)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $poli->nama }}</td>
                <td>
                    <a href="{{ route('poli.edit', $poli->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('poli.destroy', $poli->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
