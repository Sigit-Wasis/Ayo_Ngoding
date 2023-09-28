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

    <!-- KONTEN TAMBAH USER -->
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
        
        <form method="POST" action="{{ route('update_users',$editusers->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" value="{{old ('username, $editusers->username') }}" id="username" name="username" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" class="form-control"id="password" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{$editusers->nama_lengkap }}"id="nama_lengkap" name="nama_lengkap" placeholder="">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" value="{{$editusers->alamat}}"id="alamat" name="alamat" placeholder="">
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="text" class="form-control"value="{{$editusers->nomor_telepon}}" id="nomor_telepon" name="nomor_telepon" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{$editusers->email}}"id="email" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Email</label>
                    <input type="password" class="form-control" valeu="" id="password_confirmation" name="password_confirmation" placeholder="">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('users') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection
