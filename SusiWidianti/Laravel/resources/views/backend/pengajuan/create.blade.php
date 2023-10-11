@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Transaksi Pengajuan </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Transaksi Pengajuan</li>
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

        <form method="POST" action="{{ route('pengajuan') }}" enctype="multipart/form-data"> 
            @csrf
            <div class="card-body">
            <div class="form-group">
                    <label for="id_jenis_barang">Nama Vendor</label>
                    <select name="id_jenis_barang" class ="form-control">
                        <option value="">--pilih Vendor --</option>
                        @foreach($Vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->nama}}</option>
                        @endforeach
            </select>
            </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Barang</label>
                    <select class="form-control" id="nama_barang" name="nama_barang"> 
                    <option value=""   disabled selected>Pilih Barang</option>           
                </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" fdprocessedid="gjaft">Simpan Data Barang</button>
                <a href="{{ route('pengajuan') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

<script src="http://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function){
        $('#vendor').change(function() {
            
            
        })

    }

@endsection