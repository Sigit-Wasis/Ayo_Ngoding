<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## READ DATA USER
1. BUAT ROUTER UNTUK USER
        ```
        Route::get('/user', 'Backend\UserController@index')->name('user');
        Route::get('/tambah_user', 'Backend\UserController@create')->name('tambah_jenis_user');
        Route::post('/store_user', 'Backend\UserController@store')->name('store_jenis_user');
        Route::get('/delete_user/{id}','Backend\UserController@destroy')->name('delete_jenis_user');
        Route::get('/edit_user/{id}','Backend\UserController@edit')->name('edit_jenis_user');
        Route::post('/update_user/{id}','Backend\UserController@update')->name('update_jenis_user');
        ```
2. BUAT CONTROLLER DI TERMINAL DENGAN PERINTAH
    ```
    php artisan make:controller Backend/UserController
    ```

3. update pada file user controller yang ada di folder app/Http/Controller/Backend
    ```
    <?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB; // <- TAMBAHKAN DB

    class UserController extends Controller
    {
        public function index() {
            // query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
            $users = DB::table('users')->select('users.*', 'nama_lengkap as created_by')->orderBy('users.id', 'DESC')->paginate(5);

            // dd($jenisBarang);

            return view('backend.user.index', compact('users'));
        }

    }
    ```
4. Buat View untuk menampilkan data user di dalam folder resources/views/backend/user
    ```
            @extends('backend.app')

        @section('content')

        <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
        <!-- BUTTON TAMBAH JENIS BARANG -->
                <div class="col-md-2 mb-2">
                <!-- <a href="{{ route('tambah_jenis_barang') }}" class="btn btn-sm btn-block btn-success">Tambah Jenis Barang</a> -->
            </div>
            <!-- END BUTTON TAMBAH JENIS BARANG -->

        <thead>

            <section class="content">

                <div class="card">
                    <div class="card-body">

                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>

                    <i class="icon fas fa-check"></i> Sukses!!</h5>
                    
                    {{ (Session('message')) }}
            </div>
                @endif

                    <table class="table">
                    <thead>
                <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>


            @foreach($users as $user)
            <tr>
            <!-- <th scope="row">{{ $loop->iteration}}</th> -->
            <td>{{ $users->firstItem() + $loop->index }}</td>
            <td>{{ $user->nama lengkap }}</td>
            <td>{{ $user->Username }}</td>
            <td>{{ $user->Email }}</td>

            <td>
            <!-- <a href=" "class="btn btn-sm btn-primary">Edit</a> -->
            <a href="{{ route('edit_jenis_barang',$jenis->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('delete_jenis_barang',$jenis->id) }}" onclick="return confirm('Apakah Kamu Ingin Menghapus ini?')" class="btn btn-sm btn-danger">Hapus</a>
            </td>

            </tr>


            @endforeach
        </tbody>
        </table>
                {{$users->links() }}
                    </div>
                </div>
            </section>
        </div>

        @endsection
        ```

5. Buat menu user di dalam file sidebar.blade.php yang ada di dalam folder resource/view/backend
    /_partials/sidebar.blade.php

    ```
    <li class="nav-item">
<a href="{{ route('user') }}" class="nav-link">
<i class="nav-icon fas fa-user-alt"></i>
            <p>
                  Data User
            </p>
            </a>
        </li>
    ```
    
