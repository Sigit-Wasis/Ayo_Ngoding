@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengajuan Barang</a></li>
                        <li class="breadcrumb-item active">Transaksi Pengajuan Barang</li>
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
                <h3 class="card-title">Transaksi Pengajuan Barang</h3>
            </div>

            <form method="POST" action="{{route('barangAdd')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="jenis_barang">Nama Vendor</label>
                        <select class="form-control" id="jenis_barang" name="jenis_barang">
                            <option value="" disabled selected>Pilih Vendor</option>
                            @foreach ($vendors as $jenis)
                            <option value="{{ $jenis->id }}">{{ $jenis->nama}}</option>
                            @endforeach
                        </select>
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