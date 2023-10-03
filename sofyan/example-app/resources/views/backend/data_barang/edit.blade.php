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
                        <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('update_user', $edituser->id) }}" method="post">
                    @csrf
                    @method('put') <!-- Metode PUT untuk pembaruan -->

                    <div class="form-group">
                        <label for="name">Nama User</label>
                        <input type="text" class="form-control" value="{{ old('name',$edituser->name) }}" id="name" name="name" value="{{ $edituser->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username User</label>
                        <textarea class="form-control" value="{{ old('username',$edituser->username) }}" id="username" name="username">{{ $edituser->username }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="email">Email User</label>
                        <textarea class="form-control" value="{{ old('email',$edituser->email) }}" id="email" name="email">{{ $edituser->email }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection