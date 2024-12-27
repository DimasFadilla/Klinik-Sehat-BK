<div class="page-wrap">
  <div class="app-sidebar colored">
    <div class="sidebar-header">
      <a class="header-brand" href="{{ url('/dokter/dashboard') }}">
        <div class="logo-img">
          <center><img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid" style="max-height: 50px;"></center>
        </div>
        <center><span class="text">Selamat datang di dashboard dokter  {{ $dokter->nama }}</span></center>
      </a>
       <!--------------------------------------------------------Jam Navbar----------------------------------------------------------------------------------->
       <a href="#" class="nav-link disabled">
                <!--digital clock start-->
                <div class="datetime">
                    <div class="date">
                        <span id="dayname">Day</span>,
                        <span id="month">Month</span>
                        <span id="daynum">00</span>,
                        <span id="year">Year</span>
                    </div>
                    <div class="time">
                        <span id="hour">00</span>:
                        <span id="minutes">00</span>:
                        <span id="seconds">00</span>
                        <span id="period">AM</span>
                    </div>
                </div>
                <!--digital clock end-->
            </a>

    </div>

    <div class="sidebar-content">
      <div class="nav-container">
        <nav id="main-menu-navigation" class="navigation-main">
          <div class="nav-item active">
            <a href="{{ url('/dokter/dashboard') }}">
              <i class="ik ik-bar-chart-2"></i>
              <span>Dashboard</span>
            </a>
          </div>

          <div class="nav-item">
            <a href="{{ route('dokter.profile') }}">
              <i class="ik ik-user"></i>
              <span>Profile</span>
            </a>
          </div>

          <div class="nav-item">
            <a href="{{ route('dokter.jadwal.index') }}">
              <i class="ik ik-calendar"></i>
              <span>Jadwal Periksa</span>
            </a>
          </div>

          <div class="nav-item">
            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('dokter.logout') }}">
              <i class="ik ik-power dropdown-icon"></i>
              <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('dokter.logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>

    <!--------------------------------------------------------fungsi jam----------------------------------------------------------------------------------->
    <script type="text/javascript">
        function updateClock() {
            var now = new Date();
            var dname = now.getDay(),
                mo = now.getMonth(),
                dnum = now.getDate(),
                yr = now.getFullYear(),
                hou = now.getHours(),
                min = now.getMinutes(),
                sec = now.getSeconds(),
                pe = "AM";

            if (hou >= 12) {
                pe = "PM";
            }
            if (hou == 0) {
                hou = 12;
            }
            if (hou > 12) {
                hou = hou - 12;
            }

            Number.prototype.pad = function(digits) {
                for (var n = this.toString(); n.length < digits; n = 0 + n);
                return n;
            }

            var months = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
            var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
            var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
            for (var i = 0; i < ids.length; i++)
                document.getElementById(ids[i]).firstChild.nodeValue = values[i];
        }

        function initClock() {
            updateClock();
            window.setInterval("updateClock()", 1);
        }
    </script>