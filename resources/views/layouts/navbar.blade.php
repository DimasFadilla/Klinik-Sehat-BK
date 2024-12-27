<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <!-- Logo Klinik -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo-klinik.png') }}" height="55" alt="Logo Klinik">
        </a>

        <!-- Toggle button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Menu untuk semua pengguna -->
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/kontak">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tentang">Tentang Kami</a>
                </li>
            </ul>

            <!-- Menu pengguna -->
            <ul class="navbar-nav ms-auto">
                @if(Auth::check())
                    <!-- Dropdown menu untuk admin -->
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="adminMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminMenu">
                            <li><a href="/manage/dokter" class="dropdown-item">Kelola Dokter</a></li>
                            <li><a href="/manage/pasien" class="dropdown-item">Kelola Pasien</a></li>
                            <li><a href="/manage/obat" class="dropdown-item">Kelola Obat</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- Dropdown menu untuk dokter -->
                    @if(Auth::user()->role === 'dokter')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dokterMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Dokter
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dokterMenu">
                            <li><a href="/jadwal" class="dropdown-item">Jadwal Praktek</a></li>
                            <li><a href="/rekam-medis" class="dropdown-item">Rekam Medis Pasien</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- Dropdown menu untuk pasien -->
                    @if(Auth::user()->role === 'pasien')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="pasienMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Pasien
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pasienMenu">
                            <li><a href="/janji-temu" class="dropdown-item">Janji Temu</a></li>
                            <li><a href="/riwayat" class="dropdown-item">Riwayat Pengobatan</a></li>
                        </ul>
                    </li>
                    @endif

                    <!-- Tombol Logout -->
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    <!-- Menu jika belum login -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrasi</a>
                    </li> -->
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar -->
