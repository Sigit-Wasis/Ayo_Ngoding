@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pengguna</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Pengguna</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- TAMBAH PENGGUNA -->

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
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" value="{{old('name')}}" id="nama" name="name" placeholder="Nama Pengguna">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email" placeholder="Alamat Email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" value="{{old('password')}}" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Konfirmasi Password:</label>
                    <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Password">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Role User <strong style="color: red;">*</strong></label>
                            <select class="form-control select2-with-bg" id="bg-multiple" multiple="multiple" data-bgcolor="light-info" style="width: 100%; height: 50px;" name="roles[]">
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                    <a href="{{ route('user') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </form>
    </section>
</div>

@endsection