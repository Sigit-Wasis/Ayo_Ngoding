@extends('backend.app')

@section('title', 'Edit User')

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
                        <li class="breadcrumb-item"><a href="#">User</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN Edit User -->
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
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" value="{{ old('name', $editUser->name) }}" id="name" name="name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" value="{{ old('username', $editUser->username) }}" id="username" name="username" placeholder="Username" value="{{ $editUser->username }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{ old('email', $editUser->email) }}" id="email" name="email" placeholder="Email" value="{{ $editUser->email }}">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="password_corfinmation">Komfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="">
                </div>
                <div class="form-group">
                    <label>Role User</label>
                    <select class="form-control select2-with-bg" id="bg-multiple" multiple="multiple" data-bgcolor="light-info" style="width: 100%; height: 50px;" name="roles[]">
                        @foreach ($roles as $role)
                        <option value="{{ $role }}" @if (in_array($role, $userRole)){{'selected'}} @endif>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('user') }}" class="btn btn-info">Kembali</a>
            </div>
</div>
</form>
</div>
</section>
</div>

@endsection