@extends('backend.app')

@section('content')

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Tambah User</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Tambah users</li>
</ol>
</div>
</div>
</div>
</section>
    <!--KONTEN TAMBAH JENIS BARANG -->
    <section class="content">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-primary">
    <div class="card-header">
        <h3 class ="card-title">Tambah users</h3>
</div>
        <form method="POST" action="{{ route('store_user') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" class="form-control"value="{{old('name')}}" id="deskripsi" name="username" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" class="form-control"value="{{old('name')}}" id="email" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">confirmasi password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                </div>
                

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan user</button>
                <a href="{{ route('user')}}" class="btn btn-info">kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection
