@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Edit Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH BARANG -->
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

        <form method="POST" action="{{ route('update_barang', $editBarang->id ) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="id_jenis_barang">Nama Jenis Barang</label>
                <select name="id_jenis_barang" class="form-control">
                    <option value="">-- pilih jenis barang --</option>
                    @foreach($jenisBarang as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->nama_barang}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kode_barang">Kode Barang</label>
                <input type="text" class="form-control" value="{{ $editBarang->kode_barang }}" id="kode_barang" name="kode_barang" readonly>
            </div>
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control" value="{{ $editBarang->nama_barang }}" id="nama_barang" name="nama_barang" placeholder="">
            </div>
            <div class="form-group">
                <label for="harga">Harga Barang</label>
                <input type="text" class="form-control" value="{{ $editBarang->harga }}" name="harga" placeholder="">
            </div>
            <div class="form-group">
                <label for="satuan">Satuan Barang</label>
                <input type="text" class="form-control" value="{{ $editBarang->satuan }}" name="satuan" placeholder="">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Jenis Barang</label>
                <input type="text" class="form-control" value="{{ $editBarang->deskripsi }}" id="deskripsi" name="deskripsi" placeholder="">
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Barang</label>
                <input type="file" class="form-control" value="{{ $editBarang->gambar }}" name="gambar_barang" placeholder="">
            </div>
            <div class="form-group">
                <label for="stok_barang">Stok Barang</label>
                <input type="text" class="form-control" value="{{ $editBarang->stok_barang }}" name="stok_barang" placeholder="">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Jenis Barang</button>
                <a href="{{ route('barang') }}" class="btn btn-info">Kembali</a>

            </div>
        </form>

    </section>
</div>

@endsection