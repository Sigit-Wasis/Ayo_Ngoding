@extends('backend.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jenis-barang') }}">Permission</a></li>
                        <li class="breadcrumb-item active">Edit Permission</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if(Session::has('permission_message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{ Session('permission_message')}}
                </div>
                @endif

                <form action="{{ route('update_permission', $editPermission->id) }}" method="post">
                    @csrf
                    @method('put') <!-- Metode PUT untuk pembaruan -->

                    <div class="form-group">
                        <label for="nama_permissions">Nama Permission</label>
                        <input type="text" class="form-control" id="nama_permissions" name="nama_permissions" value="{{ $editPermission->name }}" required>
                    </div>



                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection