@extends('backend.app')
@section('title','Jenis Barang')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Jenis Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Jenis Barang</li>
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
        <form method="POST" action="{{ route('update_jenis_barang', $editJenisBarang->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_jenis_barang">Nama Jenis Barang</label>
                    <input type="text" class="form-control" value="{{$editJenisBarang->nama_jenis_barang}}"
                        id="nama_jenis_barang" name="nama_jenis_barang" placeholder="Nama Jenis Barang">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control" value=" {{$editJenisBarang->deskripsi}}" id="deskripsi"
                        name="deskripsi" placeholder="Deskripsi">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('jenis_barang') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection