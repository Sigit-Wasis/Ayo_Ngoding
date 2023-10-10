@extends('backend.app')

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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Gambar</th>
                                <td><img src="{{ url($detailbarang->gambar) }}" width="400" height="250" alt=""></td>            </tr>
                            <tr>
                                <th scope="row">Nama Barang</th>
                                <th>{{ $detailbarang->nama_barang }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Kode Barang</th>
                                <th>{{ $detailbarang->kode_barang }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Nama Barang</th>
                                <th>{{ $detailbarang->nama_barang }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Harga</th>
                                <th>{{"Rp".number_format( $detailbarang->harga,2,',','.') }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Satuan</th>
                                <th>{{ $detailbarang->satuan }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi</th>
                                <th>{{ $detailbarang->deskripsi }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Stok Barang</th>
                                <th>{{ $detailbarang->stok_barang }}</th>
                            </tr>
                            <tr>
                                <th scope="row">Nama Vendor</th>
                                <th>{{ $detailbarang->nama_perusahaan }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('barang.index') }}" class="btn btn-info">Kembali</a>
            </div>
        </div> 
    </section>
</div>

@endsection