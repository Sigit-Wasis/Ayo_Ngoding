<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## READ DATA USER

1. Buat route unutuk user
   ```
    Route::get('/user', 'Backend\userController@index')->name('user');
    Route::get('/tambah-user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store-user', 'Backend\userController@store')->name('store_user');
    Route::get('delete-user/{id}', 'Backend\userController@destory')->name('delete_user');
    Route::get('edit-user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update-user/{id}', 'Backend\userController@update')->name('update_user');
    ``` 

2. Buat controller di terminal dengan perintah
    ```
    php artisan make:controller Backend/UserController    
    ```
3. Update pada file UserController yang ada di folder app/Http/Controllers/Backend    
    ```
    <?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB; // <- tambahkan DB

    class UserController extends Controller
    {
     public function index() {
        // Queri ini untuk mengambil data users  secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
        $users = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')->paginate(5);
    
        return view('backend.user.index', compact('users'));
    }
    }

    ```
4. Buat View untuk menampilkan data user di dalam folder Resources/View/Backend/user/indez.blade.php
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
            <!--<a href="{{ route('tambah_jenis_barang') }}" class="btn btn-sm btn-block btn-success">Tambah User</a>
</div>
<!--END BUTTON JENIS BARANG -->

        <div class="card">
            <div class="card-body">
             @if(Session::has('message'))   
            <div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5>
    <i class="icon fas fa-check"></i> Sukses!
    <h5>
        {{ Session('message')}}
</div>
@endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N0</th>
                            <th scope="col">name</th>
                            <th scope="col">username</th>
                            <th scope="col">email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href=" {{ route('edit_jenis_barang', $jenis->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href=" {{ route('delete_jenis_barang', $jenis->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Hapus</a>
                            <td>

                            </tr>
                        <tr>
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

5. Buat menu user di dalam file sidebar.blade.php yang ada di dalam folder resources/view/backend/_partial/sidebar.php
```
<li class="nav-item">
                <a href="{{ route('user') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Jenis Barang
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
```
5. Buka brouser dan refreash
    

