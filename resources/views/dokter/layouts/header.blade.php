<header class="bg-blue-900 text-white py-6">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-bold">
            <a href="/" class="text-white hover:text-blue-300">Klinik Majusejahtera</a>
        </h1>

        <nav class="flex space-x-4">
            <a href="#" class="text-white hover:text-blue-300">Home</a>
            <a href="#services" class="text-white hover:text-blue-300">Layanan</a>
            <a href="#contact" class="text-white hover:text-blue-300">Kontak</a>
            <a href="{{ route('dokter.login') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                <i class="fas fa-user-md"></i> Login Dokter
            </a>
            <a href="{{ route('pasien.login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                <i class="fas fa-user"></i> Login Pasien
            </a>
        </nav>
    </div>
</header>