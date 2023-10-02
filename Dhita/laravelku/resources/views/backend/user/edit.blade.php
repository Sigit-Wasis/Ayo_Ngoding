@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- KONTEN TAMBAH JENIS BARANG -->

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


        <form method="POST" action="{{ route('update_user', $editUser->id) }}">
            @csrf
            
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" value="{{ $editUser->username }}" id="username" name="username" placeholder="masukan username">
                </div>
            
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $editUser->nama_lengkap }}" id="nama_lengkap" name="nama_lengkap" placeholder="masukan nama_lengkap">
                </div>
            
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" value="{{ $editUser->alamat }}" id="alamat" name="alamat" placeholder="masukan alamat">
                </div>
            
                <div class="form-group">
                    <label for="no_telephone">No Telephone</label>
                    <input type="text" class="form-control" value="{{ $editUser->no_telephone }}" id="no_telephone" name="no_telephone" placeholder="masukan no telephone">
                </div>
            
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{ $editUser->email }}" id="email" name="email" placeholder="masukan email">
                </div>
            

            
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="masukan password">
                </div>
            
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="masukan password">
                </div>
            
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('user') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>

    </section>

</div>




@endsection