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
                        <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
                        <li class="breadcrumb-item active">Tambah Data Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH DATA BARANG -->
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

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Tambah Data Barang</h3>
            </div>

            <form method="POST" action="{{route('barangAdd')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="jenis_barang">Jenis Barang</label>
                        <select class="form-control" id="jenis_barang" name="jenis_barang">
                            <option value="" disabled selected>Pilih Jenis Barang</option>
                            @foreach ($jenisBarang as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendor_id">Nama Perusahaan</label>
                        <select class="form-control" id="vendor_id" name="vendor_id">
                            <option value="" disabled selected>Pilih Nama Perusahaan</option>
                            @foreach($vendorName as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">

                        <label for="namabarang">Nama Barang</label>
                        <input type="text" class="form-control" value="{{ old('nama_barang') }}" id="nama_barang" name="nama_barang" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="kode">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $kodeBarang }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="harga">harga</label>
                        <input type="number" class="form-control" value="{{ old('harga') }}" id="harga" name="harga" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="satuan">satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan') }}" id="satuan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">deskripsi</label>
                        <input type="text" class="form-control" value="{{ old('deskripsi') }}" id="deskripsi" name="deskripsi" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="stok">Jumlah Stok</label>
                        <input type="number" class="form-control" value="{{ old('stok') }}" id="stok" name="stok" placeholder="Masukkan jumlah stok" min="0" step="1" required>
                    </div>


                    <div class="form-group">
                        <label for="deskripsi">image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                </div>



                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data Barang</button>
                    <a href="{{route('data_barang')}}" class="btn btn-info">kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection