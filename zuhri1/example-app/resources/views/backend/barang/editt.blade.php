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
                        <li class="breadcrumb-item active">Data_barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--KONTEN TAMBAH DATA BARANG -->
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
        <form method="POST" action="{{ route('update_DataBarang', $editBarang->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="jenis_barang">Nama Jenis Barang</label>
                    <select name="id_jenis_barang"class="form-control">
                        <option value="">-- pilih jenis barang--</option>
                        @foreach($jenisBarang as $jenis)
                        <option value="{{ $jenis->id }}"{{ $jenis->id == $editBarang->id_jenis_barang ? 'selected':''}}>{{ $jenis->nama_jenis_barang}}</option>
                        @endforeach
                    </select>
                 </div>
                <div class="form-group">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control" value= "{{ $rand_8_char }}"name="kode_barang" readonly="">
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" value= "{{ $editBarang->nama_barang }}"id="nama_barang" name="nama_barang" placeholder="">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control"value= "{{ $editBarang->harga }}" id="harga" name="harga" placeholder="">
                </div>
                <div class="form-group">
                    <label for="satuan">Satuan</label>
                    <input type="text" class="form-control"value= "{{ $editBarang->satuan  }}" id="satuan" name="satuan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" class="form-control"value= "{{ $editBarang->deskripsi }}" id="deskripsi" name="deskripsi" placeholder="">
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control"value= "{{ $editBarang->gambar  }}" id="gambar" name="gambar" placeholder="">
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" class="form-control" value= "{{ $editBarang->stok }}"id="stok" name="stok" placeholder="">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Data Barang</button>
                <a href="{{ route('store_DataBarang')}}" class="btn btn-info">kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection