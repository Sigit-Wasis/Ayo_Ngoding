@extends('backend.app')

@section('title', 'Tambah Barang')

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
                        <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
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
                        <label for="id_jenis_barang">Jenis Barang</label>
                        <select name="id_jenis_barang" class="form-control">
                            <option value="">--pilih jenis barang --</option>
                            @foreach ($createBarang as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" value="{{ $rand_8_char }}" id="kode_barang" name="kode_barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" value="{{ old('nama_barang')}}" id="nama_barang" name="nama_barang" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="id_vendor">Nama Vendor</label>
                        <select name="id_vendor" class="form-control">
                            <option value="">--pilih vendor --</option>
                            @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" value="{{ old('harga')}}" id="harga" name="harga" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" value="{{ old('satuan')}}" id="satuan" name="satuan" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" value="{{ old('deskripsi')}}" id="deskripsi" name="deskripsi" placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" value="{{ old('gambar')}}" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input type="number" class="form-control" value="{{ old('stok_barang')}}" id="stok_barang" name="stok_barang" placeholder="">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('barang') }}" class="btn btn-info">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection