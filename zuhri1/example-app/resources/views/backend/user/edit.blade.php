@extends('backend.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>edit_user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">edit_user</li>
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
        <form method="POST" action="{{ route('update_user', $edituser->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" value="{{ old( 'name',$edituser->name)}}" id="name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" class="form-control" value="{{ old( 'username',$edituser->username)}}" id="username" name="username" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" class="form-control" value="{{old( 'email', $edituser->email)}}" id="email" name="email" placeholder="">
                </div>
        

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan user</button>
                <a href="{{ route('user')}}" class="btn btn-info">kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection