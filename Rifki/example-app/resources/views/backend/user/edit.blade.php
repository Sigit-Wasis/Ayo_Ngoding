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
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN EDIT USER -->

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

        <div class="container">
            <h1>Edit Pengguna</h1>

            
            <form method="POST" action="{{ route('update_user', $edituser->id) }}">
                @csrf

                
                <div class="form-group">
                    <label for="nama">Nama Pengguna:</label>
                    <input type="text" class="form-control" value="{{old('name', $edituser->name)}}" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email:</label>
                    <input type="email" class="form-control" value="{{old('email', $edituser->email)}}" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Konfirmasi Password:</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password">
                </div>

                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('user') }}" class="btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
