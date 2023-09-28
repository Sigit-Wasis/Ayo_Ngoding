<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## READ DATA USER
1.  Buat Route untuk user
    ```    
    Route::get('/user','Backend\userController@index')->name('user');
    Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store_user', 'Backend\userController@store')->name('store_user');
    Route::get('/edit_user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update_user/{id}', 'Backend\userController@update')->name('update_user');
    Route::get('/delete_user/{id}','Backend\userController@destroy')->name('delete_user');
    ```

    
2.  Buat controller di terminal dengan perintah
    ```
    php artisan make:controller Backend/UserController
    ``` 

3.  Update pada file UserContoller yang ada di folder app/Http/Controllers/Backend
    ```
    <?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;

    class UserController extends Controller
    {
        public function index(){
            // query ini untuk mengambil data users secara keseluruhan dengan id secara descending(dari id terbesar ke terkecil)
            $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')
            ->paginate(10);

            return view('backend.user.index', compact('users'));
        }
    }
    ```

4.  Buat view untuk menampilkan data user di dalam folder Resources/view/backend/user/index.blade.php
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
            <div class="col-md-2 mb-2">
                <!-- <a href="{{ route('tambah_jenis_barang')}}" class="btn btn-sm btn-block btn-success">Tambah User </a> -->
                </div>

                <div class="card">
                <div class="card-body">

                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>    
                            <i class="icon fas fa-check"></i> Sukses!
                        </h5>
                        {{ Session('message') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $juser)    
                            <tr>
                                <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                                <td>{{ $users->firstItem() + $loop->index}}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('enis_jbarang.edit', ['id' => $jenis->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('delete_jenis_barang', $jenis->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </section>
    </div>

    @endsection
    ```

5. Buat menu user di dalam file sidebar.blade.php yang ada di dalam folder resources/view/backend/_partials/sidebar.blade.php
    ```
    <li class="nav-item">
        <a href="{{ route ('user') }}" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
                Data User
            </p>
        </a>
    </li>
    ```
   