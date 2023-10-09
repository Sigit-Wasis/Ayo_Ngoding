<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../../index3.html" class="brand-link">
        <img src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('beranda') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                @can('jenis-barang-list')
                <li class="nav-item">
                    <a href="{{ route('jenis_barang') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Jenis Barang</p>
                    </a>
                </li>
                @endcan
                @can('barang-list')
                <li class="nav-item">
                    <a href="{{ route('barang.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Data Barang</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('pengajuan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Transaksi Pengajuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('vendor.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Vendor</p>
                    </a>
                </li>
                
                @can('user-list')
                <li class="nav-item">
                    <a href="{{ route('user') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Data User</p>
                    </a>
                </li>
                @endcan
                @can('role-list')
                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Data Role</p>
                    </a>
                </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route('jenis_barang') }}" class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
