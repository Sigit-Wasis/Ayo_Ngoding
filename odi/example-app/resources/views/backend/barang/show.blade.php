@extends('backend.app')
@section('title','Barang')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Nama Jenis Barang</th>
                            <th>{{ $detailBarang->nama_jenis_barang }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Kode Barang</th>
                            <th>{{ $detailBarang->kode_barang }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Nama Barang</th>
                            <th>{{ $detailBarang->nama_barang }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Harga</th>
                            <th>{{ "Rp ".number_format($detailBarang->harga,0,',','.') }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Satuan</th>
                            <th>{{ $detailBarang->satuan }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Deskripsi</th>
                            <th>{{ $detailBarang->deskripsi }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th>
                                <img src="{{ url($detailBarang->gambar) }}" width="20" alt="">
                            </th>
                        </tr>
                        <tr>
                            <th scope="col">Stok</th>
                            <th>{{ $detailBarang->stok }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Di Buat Pada</th>
                            <th>{{ $detailBarang->created_at ?? \Carbon\Carbon::now() }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Di Update Pada</th>
                            <th>{{ $detailBarang->updated_at ?? \Carbon\Carbon::now() }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Di Buat Oleh</th>
                            <th>{{ $detailBarang->created_by }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Nama Vendor</th>
                            <th>{{ $detailBarang->nama_perusahaan}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">

                <a href="{{ route('barang') }}" class="btn btn-info">Kembali</a>
            </div>
        </div>
    </section>
</div>

@endsection