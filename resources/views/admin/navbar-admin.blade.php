<div class="container-fluid sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
            <!-- Logo di Pojok Kiri -->
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 40px; height: 40px;" class="me-2">
                <h1 class="m-0 text-uppercase" style="color: navy;">Admin</h1>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link">Dashboard</a>

                    <!-- Mengelola Poli -->
                    <a href="{{ route('poli.index') }}" class="nav-item nav-link">Mengelola Poli</a>

                    <!-- Mengelola Dokter -->
                    <a href="{{ route('dokter.index') }}" class="nav-item nav-link">Mengelola Dokter</a>

                    <!-- Mengelola Pasien -->
                    <a href="{{ route('admin.pasien.index') }}" class="nav-item nav-link">Mengelola Pasien</a>

                    <!-- Mengelola Obat -->
                    <a href="{{ route('obat.index') }}" class="nav-item nav-link">Mengelola Obat</a>

                    <!-- Logout -->
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-item nav-link btn btn-link">Logout</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>
