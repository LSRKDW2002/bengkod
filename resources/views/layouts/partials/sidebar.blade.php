<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="brand-link text-center">
        <span class="brand-text font-weight-light">
            {{ Auth::user()->role == 'dokter' ? 'Dashboard Dokter' : 'Dashboard Pasien' }}
        </span>
    </div>

    <!-- Sidebar user panel -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
    <div class="image">
        <img src="{{ Auth::user()->role == 'dokter' 
                    ? 'https://previews.123rf.com/images/jemastock/jemastock1611/jemastock161103711/68995767-doctor-cartoon-icon-medical-and-health-care-theme-isolated-design-vector-illustration.jpg' 
                    : 'https://png.pngtree.com/png-clipart/20230805/original/pngtree-medical-volunteer-icon-patient-sick-employee-vector-picture-image_9758815.png' }}"
             class="img-circle elevation-2"
             alt="Foto Pengguna">
    </div>
    <div class="info">
        <span class="d-block text-white">{{ Auth::user()->name ?? 'Nama Pengguna' }}</span>
    </div>
</div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                @if(Auth::user()->role == 'dokter')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ url('dokter/dashboard') }}" class="nav-link {{ request()->is('dokter/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Periksa -->
                    <li class="nav-item">
                        <a href="{{ url('dokter/periksa') }}" class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Periksa</p>
                        </a>
                    </li>

                    <!-- Obat -->
                    <li class="nav-item">
                        <a href="{{ url('dokter/obat') }}" class="nav-link {{ request()->is('dokter/obat*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pills"></i>
                            <p>Obat</p>
                        </a>
                    </li>
                @elseif(Auth::user()->role == 'pasien')
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ url('pasien/dashboard') }}" class="nav-link {{ request()->is('pasien/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Periksa -->
                    <li class="nav-item">
                        <a href="{{ url('pasien/periksa') }}" class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-stethoscope"></i>
                            <p>Periksa</p>
                        </a>
                    </li>

                    <!-- Riwayat -->
                    <li class="nav-item">
                        <a href="{{ url('pasien/riwayat') }}" class="nav-link {{ request()->is('pasien/riwayat*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat</p>
                        </a>
                    </li>
                @endif

                <!-- Logout -->
                <li class="nav-item mt-3">
                    <a href="{{ route('logout') }}" class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
