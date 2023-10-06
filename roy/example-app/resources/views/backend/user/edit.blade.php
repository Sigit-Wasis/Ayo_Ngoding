@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Edit User</h1>
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

        <form method="POST" action="{{ route('update_user', $editUser->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="user">User</label>
                    <input type="text" class="form-control" value="{{ $editUser->name }}" id="name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="user_name">User Name</label>
                    <input type="text" class="form-control" value="{{ $editUser->user_name }}" id="user_name" name="user_name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{ $editUser->email }}" id="email" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="pasword">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="">
                </div>
                <div class="form-group">
                    <label for="pasword_confirmation">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="col-md-4">                                <div class="form-group">
                                    <label>Role User <strong style="color: red;">*</strong></label>
                       
                        <select class="form-control select2-with-bg" id="bg-multiple" multiple="multiple" data-bgcolor="light-info" style="width: 100%; height: 50px;" name="roles[]">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" @if (in_array($role, $userRole)) {{'selected'}} @endif>{{ $role }}</option>
                                        @endforeach
                                    </select>
              
                                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan User</button>
                    <a href="{{ route('user') }}" class="btn btn-info">Kembali</a>

                </div>
        </form>

    </section>
</div>

@endsection