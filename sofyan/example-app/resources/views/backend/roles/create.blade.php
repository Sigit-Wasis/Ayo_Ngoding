@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Roles</a></li>
                        <li class="breadcrumb-item active">Tambah Roles</li>
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

            <form method="POST" action="{{route('roles.store')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="permission">Permission</label>
                        <div class="selectgrup selectgrup-pills">
                            @foreach ($permission as $value)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="permission[]" value="{{$value->id}}">
                                <label>
                                    {{ $value->name}}
                                </label>
                            </div>
                            @endforeach
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