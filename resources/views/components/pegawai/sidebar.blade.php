<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center py-3">
            <img src="{{ asset('img/dishub.png') }}" alt="Logo" class="img-fluid" style="max-width: 60px;">
            <div style="margin-top: 0px; font-weight: bold; font-size: 16px;">SIM KEDIS
            </div>
        </div>
        <div class="sidebar-brand sidebar-brand-sm text-center">
            <img src="{{ asset(path: 'img/dishub.png') }}" alt="" style="max-width: 50px;">
        </div>
        <hr class="my-2">
        <ul class="sidebar-menu">
            <!-- Dashboard Section -->
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('pegawai') ? 'active' : '' }}">
                <a href="{{ url('pegawai') }}" class="nav-link">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Kendaraan</li>
            <li class="{{ Request::is('kendaraan*') ? 'active' : '' }}">
                <a class="nav-link" href="">
                    <i class="fas fa-car"></i> <span>Data Kendaraan</span>
                </a>
            </li>
            <li class="{{ Request::is('pemeliharaan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pemeliharaan.index') }}">
                    <i class="fas fa-tools"></i> <span>Pemeliharaan</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
