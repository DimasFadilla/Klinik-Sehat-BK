<header class="bg-blue-900 text-white py-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 href="/" class="text-xl font-bold">Klinik Majusejahtera</h1>
        <nav>
        <ul>
                <li><a href="#" class="btn">Home</a></li>
                <li><a href="#services" class="btn">Layanan</a></li>
                <li><a href="#contact" class="btn">Kontak</a></li>
                <li><a href="{{ route('dokter.login') }}" class="btn btn-success btn-lg px-4 py-2 shadow"><i class="fas fa-user-md"></i> Login Dokter</a></li>
                <li><a href="{{ route('pasien.login') }}" class="btn btn-primary btn-lg px-4 py-2 shadow"><i class="fas fa-user"></i> Login Pasien</a></li>
            </ul>
        </nav>
    </div>
</header>
