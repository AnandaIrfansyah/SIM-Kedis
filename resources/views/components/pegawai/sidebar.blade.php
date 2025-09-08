<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('pegawai') }}">SIM Kedis</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('pegawai') }}">SK</a>
        </div>
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
