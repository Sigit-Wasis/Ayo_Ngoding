@extends('backend.app')
@section('title','User')
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
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!--kontek tambah jenis barang -->

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
        <form method="POST" action="{{ route('store_user') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" value="{{ old ('name') }}" id=" name" name="name"
                        placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" value="{{ old ('username') }}" id="username" name="username"
                        placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Komfirmasi Password</label>
                    <input type="password" class="form-control" id="password" name="password_confirmation"
                        placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="namalengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ old ('nama_lengkap') }}" id="namalengkap"
                        name="nama_lengkap" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" value="{{ old ('alamat') }}" id="alamat" name="alamat"
                        placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="nomortelpon">Nomor Telpon</label>
                    <input type="text" class="form-control" value="{{ old ('nomor_telpon') }}" id="nomortelpon"
                        name="nomor_telpon" placeholder="Nomor Telpon">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{ old ('email') }}" id="email" name="email"
                        placeholder="Email">
                </div>
                <div class="md-12">
                    <div class="form-group">
                        <label>Role User</label>
                        <select class="form-control select2-with-bg" id="bg-multiple" multiple="multiple"
                            data-bgcolor="light-info" style="width: 100%; height: 50px;" name="roles[]">
                            @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('user') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection