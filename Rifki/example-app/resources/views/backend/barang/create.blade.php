@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
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
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('store_barang') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="id_jenis_barang">id jenis Barang</label>
                        <input type="text" class="form-control" id="id_jenis_barang" name="id_jenis_barang" placeholder="id jenis barang">
                    </div>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga_barang" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label for="satuan_barang">Satuan Barang</label>
                        <input type="text" class="form-control" id="satuan_barang" name="satuan_barang" placeholder="Satuan Barang">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" placeholder="Deskripsi"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar_barang" name="gambar_barang">
                    </div>
                    <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input type="number" class="form-control" id="stok_barang" name="stok_barang" placeholder="Stok Barang">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('barang.index') }}" class="btn btn-info">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection