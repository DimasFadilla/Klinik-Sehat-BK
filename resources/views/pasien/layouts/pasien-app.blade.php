<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Klinik Sehat - @yield('title')</title>
  
  <!-- CSS -->
  <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  
  <!-- (Contoh) Font Awesome dari CDN, jika mau -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">

</head>
<body id="page-top">
  
  <!-- Sidebar -->
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Branding -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('pasien.dashboard') }}">
        <div class="sidebar-brand-icon">
          <i class="fas fa-hospital-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Klinik Sehat</div>
      </a>
      
      @if (session('pasien_id'))
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('pasien.dashboard') }}">
            <i class="fas fa-chart-line"></i> <span>Dashboard</span>
          </a>
        </li>
        
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Menu</div>

        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('daftar.index') }}">
            <i class="fas fa-user-injured"></i>
            <span>Daftar Poli Pasien</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">
            <i class="ik ik-power"></i>
            <span>Logout</span>
          </a>
          <form id="logout-form" action="{{ route('pasien.logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      @endif

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        @yield('content')
      </div>
      
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Klinik Sehat 2024</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- JAVASCRIPT -->
  <!-- 1) jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-... (opsional)"
        crossorigin="anonymous"></script>
  <!-- 2) Plugin JS lain -->
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/datatables-demo.js') }}"></script>

  <!-- 3) Section script opsional di child -->
  @yield('scripts')

</body>
</html>
