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
        <form method= "POST" action="{{ route('store_user') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name= "username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name= "email" placeholder="Email">
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