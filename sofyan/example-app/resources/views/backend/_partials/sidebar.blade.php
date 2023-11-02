<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../../index3.html" class="brand-link">
        <img src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ auth()->user()->name}}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @auth
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                @else
                <a href="#" class="d-block">Guest User</a> <!-- You can customize the guest user's name here -->
                @endauth
            </div>
        </div>

       

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('beranda')}}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

                @can('vendors-list')
                <li class="nav-item">
                    <a href="{{route('vendors')}}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Vendors
                        </p>
                    </a>
                </li>
                @endcan

                @can('jenis_barang-list')
                <li class="nav-item">
                    <a href="{{route('jenis-barang')}}" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Jenis Barang
                        </p>
                    </a>
                </li>
                @endcan

                @can('data_barang-list')
                <li class="nav-item">
                    <a href="{{route('data_barang')}}" class="nav-link">
                        <i class="nav-icon fas fa-cube"></i>
                        <p>
                            Data Barang
                        </p>
                    </a>
                </li>
                @endcan

                @can('user-list')
                <li class="nav-item">
                    <a href="{{route('user')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            USERS
                        </p>
                    </a>
                </li>
                @endcan

                @can('pengajuan-list')
                <li class="nav-item">
                    <a href="{{route('pengajuan')}}" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pengajuan
                        </p>
                    </a>
                </li>
                @endcan

                @can('laporan_list')
                <li class="nav-item">
                    <a href="{{route('laporan')}}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                @endcan

                @can('role-list')
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-code"></i>
                        <p>
                            Roles
                        </p>
                    </a>
                </li>
                @endcan


                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i> <!-- Menggunakan kelas CSS "fas fa-sign-out-alt" -->
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