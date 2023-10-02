@extends('backend.app')

@section('content')

<div class="content-wrapper">
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Data Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Data Barang</li>
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


<form method="POST" action="{{ route('update_barang', $editDataBarang->id) }}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" value="{{ $editDataBarang->nama }}" id="nama_barang" name="nama_barang" placeholder="masukan nama jenis barang">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Deskripsi Data Barang</label>
            <input type="text" class="form-control" value="{{ $editDataBarang->deskripsi }}" id="deskripsi" name="deskripsi" placeholder="masukan deskripsi">
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan Data Barang</button>
        <a href="{{ route('data_barang') }}" class="btn btn-info">Kembali</a>
    </div>
</form>

</section>

</div>




@endsection