@extends('backend.app')
@section('title', 'Edit Role')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


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

        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama Role</label>
                    <input type="text" class="form-control" value="{{ old('name', $role->name) }}" id="nama" name="name" placeholder="Nama Role">
                </div>
                
                <div class="form-group">
                    <label for="permission">Permission</label>
                    <div class="select-group selectgroup-pills">
                        @foreach($permission as $value)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $value->id }}" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            <label>
                                {{ $value->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('roles.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection
