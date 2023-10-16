<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{url('assets/dist/img/avatar5.png')}}" class="brand-link">
        <img src="{{url('assets/dist/img/avatar5.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('assets/dist/img/user8-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{url('assets/dist/img/user8-128x128.jpg')}}" class="d-block">{{ Auth::user()->username }}</a>
            </div>
        </div>

        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('beranda')}}" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Beranda
                    </p>
                </a>
            </li>
            @can('user-list')
            <li class="nav-item">
                <a href="{{ route('user')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
            @endcan
            @can('vendor-list')
            <li class="nav-item">
                <a href="{{ route('vendor')}}" class="nav-link">
                    <i class="nav-icon fas fa-briefcase"></i>
                    <p>
                        Vendor
                    </p>
                </a>
            </li>
            @endcan
            @can('role-list')
            <li class="nav-item">
                <a href="{{ route('roles.index')}}" class="nav-link">
                    <i class="nav-icon fas fa-code"></i>
                    <p>
                        Role
                    </p>
                </a>
            </li>
            @endcan
            @can('jenis_barang-list')
            <li class="nav-item">
                <a href="{{ route('jenis_barang')}}" class="nav-link">
                    <i class="nav-icon fas fa-cubes "></i>
                    <p>
                        Jenis Barang
                    </p>
                </a>
            </li>
            @endcan
            @can('barang-list')
            <li class="nav-item">
                <a href="{{ route('barang')}}" class="nav-link">
                    <i class="nav-icon fas fa-cube"></i>
                    <p>
                        Barang
                    </p>
                </a>
            </li>
            @endcan
            @can('pengajuan-list')
            <li class="nav-item">
                <a href="{{ route('pengajuan')}}" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Pengajuan
                    </p>
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="nav-link">
                    <i class="nav-icon fas fa-reply"></i>
                    <p>
                        Logout
                    </p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        </nav>
    </div>
</aside>