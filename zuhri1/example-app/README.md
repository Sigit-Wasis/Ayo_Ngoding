<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## READ DATA USER
1 pertama buat route untuk user
```
    Route::get('/user','Backend\userController@index')->name('user');
    Route::get('/tambah-user','Backend\userController@create')->name('tambah_user');
    Route::post('/store-user','Backend\userController@store')->name('store_user');
    Route::get('/delete-user/{id}', 'Backend\userController@destroy')->name('delete_user');
    Route::get('/edit-user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update-user/{id}', 'Backend\userController@update')->name('update_user');

```
2 buat controller di terminal dengan perintah

```
php artisan make:controller Backend/UserController
```
3 upate pada file usercontroller yang ada di folder app/Htpp/
    ```
    <?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB; //<-tambahkan DB

    class UserController extends Controller
    {
        /**
        * Display a listing of the resource.
        */
        public function index()
        {
            //query ini untuk mengambil data users secara keseluruhan dengan id secara discending (dari id terbesar ke terkecil)
            $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')->paginate(3);
            
            return view('backend.users.index',compact('users'));   
        }
    }    
    ````
    4 mmbuat view untuk menampilkan data user didalam folder Resources/views/Backend/user/index.blade.php
```
@extends('backend.app')

@section('content')
<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Jenis Barang</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">users</li>
</ol>
</div>
</div>
</div>
</section>

<section class="content">
 <!-- BUTTON TAMBAH JENIS BARANG -->
 <div class="col-md-2 mb-2">
 <!-- <a href="{{ route('tambah_jenis_barang') }}" class="btn btn-sm btn-block btn-primary">Tambah Jenis Barang</a>-->
</div>
<!-- END BUTTON TAMBAH JENIS BARANG -->

<div class="card">
<div class="card-body">
<div class="card-body">

@if(Session::has('message'))
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5>
  <i class="icon fas fa-check"></i> Sukses 
</h5>
{{ Session('message')}}
</div>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">username</th>
      <th scope="col">email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
<?php $i =1; ?>

    @foreach($users as $user)
    <tr>
      <!--<th scope="row">{{$loop->iteration }}</th>-->
      <th>{{$users->firstItem() +$loop->index }}</td>
      <td>{{ $users->name }}</td>
      <td>{{ $users->username }}</td>
      <td>{{ $users->email}}</td>
    <td>

    <a href="{{route('edit_jenis_barang',$jenis->id)}}"oncklick="return confirm('you sure?')" class="btn btn-sm btn-danger">Edit</a>
    <a href=" {{route('delete_jenis_barang',$jenis->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>
    @endforeach

  </tbody>
</table>
{{ $jenisBarang->render() }}

</div>

</div>


</section>

</div>

@endsection

```
5 buat menu user didalam file sidebar.blade.php yangn ada didalam folder resouces/view/Backend/_partials/sidebar.blade.php
```
users
</li class="nav-item">
<a href="{{ route('users') }}" class="nav-link">
<i class="nav-icon fas fa-th"></i>
<p>
```
6 buka browser dan refresh