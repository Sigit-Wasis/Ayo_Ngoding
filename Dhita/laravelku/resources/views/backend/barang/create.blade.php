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


<form method="POST" action="{{ route('store_barang') }}" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" value ="{{ old('nama_barang') }}" id="nama_barang" name="nama_barang" placeholder="masukan nama barang">
        </div>

        <div class="form-group">
            <label for="id_jenis_barang">ID Jenis Barang</label>
            <select name="id_jenis_barang" class="form-control">
                <option value="">--pilih jenis barang --</option>
                @foreach($jenisBarang as $jenis)
                <option value="{{$jenis->id}}">{{ $jenis->nama}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="kode_barang">Kode Barang</label>
            <input type="text" class="form-control" value ="{{ $rand_8_char}}" id="kode_barang" name="kode_barang" readonly="">
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" value ="{{ old('harga')}}" id="harga" name="harga" placeholder="masukan deskripsi barang">
        </div>

        <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" class="form-control" value ="{{ old('satuan')}}" id="satuan" name="satuan" placeholder="masukan deskripsi barang">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" class="form-control" value ="{{ old('deskrispi')}}" id="deskripsi" name="deskripsi" placeholder="masukan deskripsi barang">
        </div>

        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" class="form-control" value ="{{ old('gambar')}}" id="gambar" name="gambar" placeholder="masukan deskripsi barang">
        </div>

        <div class="form-group">
            <label for="stok_barang">Stok Barang</label>
            <input type="text" class="form-control" value ="{{ old('stok_barang')}}" id="stok_barang" name="stok_barang" placeholder="masukan deskripsi barang">
        </div>


    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan Data Barang</button>
        <a href="{{ route('jenis_barang') }}" class="btn btn-info">Kembali</a>
    </div>
</form>

</section>

</div>




@endsection