@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Tambah Users</li>
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

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Users</h3>
            </div>

            <form method="POST" action="{{route('userAdd')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Username</label>
                        <input type="text" class="form-control" value="{{ old('username') }}" id="username" name="username" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Email</label>
                        <input type="text" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Password</label>
                        <input type="password" class="form-control" value="{{ old('password') }}" id="password" name="password" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" id="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Role User <strong style="color: red;">*</strong></label>
                            <select class="form-control select2-with-bg" id="bg-multiple" multiple="multiple" data-bgcolor="light-info" style="width: 100%; height: 50px;" name="roles[]">
                             
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('user')}}" class="btn btn-info">kembali</a>
                    </div>
            </form>
        </div>
    </section>
</div>
@endsection