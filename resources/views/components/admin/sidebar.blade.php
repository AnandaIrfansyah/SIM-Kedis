<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <!-- Brand -->
        <div class="sidebar-brand">
            <a href="{{ url('admin') }}">SIM Kedis</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('admin') }}">SIM</a>
        </div>

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
                    <i class="fas fa-file-contract"></i> <span>Kepemilikan Kendaraan</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('pemeliharaan*') ? 'active' : '' }}">
                <a href="{{ url('pemeliharaan') }}" class="nav-link">
                    <i class="fas fa-tools"></i> <span>Pemeliharaan</span>
                </a>
            </li>

        </ul>
    </aside>
</div>
