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

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Dashboard Section -->
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{ url('admin') }}" class="nav-link">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>

            <!-- Informasi Utama -->
            <li class="menu-header">Informasi Utama</li>
            <li class="nav-item {{ Request::is('asn*') ? 'active' : '' }}">
                <a href="{{ url('asn') }}" class="nav-link">
                    <i class="fas fa-user-tie"></i> <span>Data Pegawai</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('kendaraan*') ? 'active' : '' }}">
                <a href="{{ url('kendaraan') }}" class="nav-link">
                    <i class="fas fa-car"></i> <span>Data Kendaraan</span>
                </a>
            </li>

            <!-- Pengelolaan Aset -->
            <li class="menu-header">Pengelolaan Aset</li>
            <li class="nav-item {{ Request::is('kepemilikan*') ? 'active' : '' }}">
                <a href="{{ url('kepemilikan') }}" class="nav-link">
                    <i class="fas fa-file-contract"></i> <span>Data Kepemilikan</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
