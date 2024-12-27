@extends('layouts.app')

@section('header')
    <h1 class="text-xl font-semibold">Halaman Login Admin</h1>
@endsection

@section('content')
    <div class="container mx-auto max-w-md">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Username -->
            <div>
                <label for="username" class="block mt-1 w-full p-2 border rounded-md">Username</label>
                <input type="text" name="username" id="username" required class="w-full p-2 mt-2 border rounded-md" placeholder="Masukkan Username">
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block mt-1 w-full p-2 border rounded-md">Password</label>
                <input type="password" name="password" id="password" required class="w-full p-2 mt-2 border rounded-md" placeholder="Masukkan Password">
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="ml-3" type="submit">Masuk</button>
            </div>
        </form>
    </div>
@endsection
