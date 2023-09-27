<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## READ DATA USER

1.Buat route untuk user
    ```
    Route::get('/user','Backend\UserController@index')->name('users');
    Route ::get ('/tambah_user', 'Backend\UserController@create')->name('tambah_user');
    Route ::post ('/store_user', 'Backend\UserController@store')->name('store_user');
    Route::get('delete_user/{id}','Backend\UserController@destroy')->name('delete_user');
    Route::get('edit_user/{id}', 'Backend\UserController@edit')->name('edit_user');
    Route::post('update_user/{id}', 'Backend\UserController@update')->name('update_user');
    ``````

2.Buat Controller di terminal dengan perintah
    ```
    php artisan make:Controller Backend/UserController
    ```

3. updatepada file UserController yang ada pada folder app/Http/Controller/Backend
   ``<?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;  // <-tambahkan DB

    class UserController extends Controller
    {
    public function index() {
        //query ini untuk mengambil data user secara keseluruhan dengan id secara discending(dari yang terbesar ke id yang terkecil)
        $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')
        ->paginate(5);



        return view ('backend.users.index', compact('users'));
    }
    }
        ``

4. Membuat View untuk menampilkan data user di dalam folder Resources/View/Backend/index.blade.php

    ``@extends('backend.app')

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
  <!--BUTTON TAMBAH User-->
  <div class="col-md-2 mb-2">
    <!--a href="{{ route('tambah_jenis_barang') }}" class ="btn btn-sm btn-block btn-success"> Tambah Jenis Barang</a>
</div>
<!-END BUTTON TAMBAH JENIS BARANG-->

    <div class="card">
       <div class="card-body">

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5>
            <i class="icon fas fa-check"></i> Sukses!
        </h5>
          {{ (Session('message')) }}
</div>
@endif
          <table class="table">
            <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">username</th>
      <th scope="col">nama_lengkap</th>
      <th scope="col">email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $users)
    <tr>
      <!--<th scope="row">{{ $loop->iteration }}</th>-->
      <td>{{$users->firstItem() + $loop->index }}</td>
      <td>{{ $users->username}}</td>
      <td>{{ $users->nama_engkap}}</td>
      <td>{{ $users->email}} </td>
        <td>

            <a href="{{ route('edit_jenis_barang',$jenis->id)}}" class="btn btn-sm btn-primary">edit</a>
          <a href="{{ route('delete_jenis_barang', $jenis->id) }}" onclick="return confirm('Are You Sure?')"
           class="btn btn-sm btn-danger">Delete</a>
        </td>
      </tr>
    @endforeach
  </tbody>
      </table>
      
      {{$jenisBarang->links()}}


   </div>
     </div>
       </section>
         </div>
@endsection

````


6. Buat Menu User di dalam sidebar.blade.php yang ada di dalam folder resources/view/backend/partials/sidebar.blade.php
```
 <li class="nav-item">
        <a href="{{ route('user') }} " class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
           Data User
         <p>
    </a>
    </li>
```







