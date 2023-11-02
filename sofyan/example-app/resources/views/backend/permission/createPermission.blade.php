@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Permission</a></li>
                        <li class="breadcrumb-item active">Tambah Permission</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH Permission -->
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
                <h3 class="card-title">Tambah Permission</h3>
            </div>

            <form method="POST" action="{{route('permissionAdd')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_permision">Nama Permission</label>
                        <input type="text" class="form-control" id="nama_permision" name="nama_permision" placeholder="">
                        @error('nama_permision')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Permission</button>
                        <a href="{{route('roles.index')}}" class="btn btn-info">kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection