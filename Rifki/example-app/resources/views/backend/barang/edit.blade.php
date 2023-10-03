@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Barang</h1>
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
                <form method="POST" action="{{ route('barang.update', $barang->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="id_jenis_barang">Id Jenis Barang</label>
                        <select name="id_jenis_barang" class="form-control">
                            <option value="">--Pilih jenis barang-- </option>
                            @foreach($jenisBarang as $jenis)
                            <option value="{{$jenis->id}}" {{ $barang->id_jenis_barang == $jenis->id ? 'selected' : '' }}>{{$jenis->nama_barang}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" value="{{ $barang->kode_barang }}" id="kode_barang" name="kode_barang" placeholder="Kode Barang">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" value="{{ $barang->nama_barang }}" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                    </div>
                    <div class="form-group">
                        <label for="harga_barang">Harga</label>
                        <input type="number" class="form-control" value="{{ $barang->harga }}" id="harga_barang" name="harga_barang" placeholder="Harga">
                    </div>
                    <div class="form-group">
                        <label for="satuan_barang">Satuan Barang</label>
                        <input type="text" class="form-control" value="{{ $barang->satuan }}" id="satuan_barang" name="satuan_barang" placeholder="Satuan Barang">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_barang">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_barang" name="deskripsi_barang" placeholder="Deskripsi">{{ $barang->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar_barang">Gambar</label>
                        <input type="file" class="form-control" id="gambar_barang" name="gambar_barang">
                        <img src="{{ asset($barang->gambar) }}" alt="Gambar Barang" width="100">
                    </div>
                    <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input type="number" class="form-control" value="{{ $barang->stok_barang }}" id="stok_barang" name="stok_barang" placeholder="Stok Barang">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('barang.edit', ['id' => $barang->id]) }}" class="btn btn-primary">Edit</a>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection