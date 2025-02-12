<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Klinik Sehat</title>
  <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/fontawesome.min.css" rel="stylesheet">
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dokter.dashboard') }}">
        <div class="sidebar-brand-icon">
          <i class="fas fa-hospital-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Klinik Sehat</div>
      </a>

      <!-- Pastikan dokter sudah login -->
      @if (session('dokter_id'))
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('dokter.dashboard') }}">
            <i class="fas fa-chart-line"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Menu</div>

        <!-- Profile -->
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('dokter.profile.profile') }}">
            <i class="fas fa-user-injured"></i>
            <span>Profile</span>
          </a>
        </li>

        <!-- Jadwal Periksa -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('dokter.jadwal.index') }}">
            <i class="fas fa-calendar"></i>
            <span>Jadwal Periksa</span>
          </a>
        </li>

        
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('dokter.periksa.index') }}">
            <i class="fas fa-stethoscope"></i>
            <span>Memeriksa Pasien</span>
            </a>
        </li>

        


        <!-- Logout -->
        <li class="nav-item">
          <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
            <i class="ik ik-power"></i>
            <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('dokter.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      @endif

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">
      @yield('content')

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Klinik Sehat 2024</span>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/datatables-demo.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
</body>
</html>
