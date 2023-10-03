@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Barang</h1>
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

    <!--KONTEN TAMBAH Data BARABG -->
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

        <form method="POST" action="{{ route('store_barang') }}" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
            <div class="form-group">
                    <label for="id_jenis_barang">Id Jenis Barang</label>
                    <select name="id_jenis_barang" class ="form-control">
                        <option value="">--pilih jenis barang --</option>
                        @foreach($DataBarang as $barang)
                        <option value="{{ $barang->id }}">{{ $barang->nama_jenis_barang}}</option>
                        @endforeach
            </select>
            </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Kode Barang</label>
                    <input type="text" class="form-control"value="{{ $rand_8_char}}" id="kode_barang" name="kode_barang" readonly="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="">
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" id="image" name="image" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" placeholder="">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" fdprocessedid="gjaft">Simpan Data Barang</button>
                <a href="{{ route('jenis_barang') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection