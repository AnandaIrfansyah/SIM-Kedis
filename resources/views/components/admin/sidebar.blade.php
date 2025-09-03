<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown">
            <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{ url('admin') }}" class="nav-link">
                    <i class="fas fa-home"></i><span>Dashboard</span>
                </a>
            </li>
            </li>
            <li class="menu-header">Menu</li>
            <li class="nav-item {{ Request::is('asn') ? 'active' : '' }}">
                <a href="{{ url('asn') }}" class="nav-link">
                    <i class="fas fa-user"></i><span>Data Pegawai</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
