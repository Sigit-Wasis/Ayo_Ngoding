@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Role</label>
                    <input type="text" class="form-control" value="{{old('name') }}" id="name" name="name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="permission">Permission</label>
                    <div class="selectgroup selectgroup-pilss">
                        @foreach($permission as $value)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="permission[]" value="{{$value->id}}">
                            <label>
                                {{$value->name}}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan User</button>
                        <a href="{{ route('users') }}" class="btn btn-info">Kembali</a>
                    </div>
        </form>
    </section>
</div>
@endsection