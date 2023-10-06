@extends('backend.app')

@section('title', 'Detail Barang')

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
                        <li class="breadcrumb-item"><a href="#">Data Barang</a></li>
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
                                <td><img src="{{ url($detailBarang->gambar) }}" width="200" height="200" alt=""></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Barang</th>
                                <td>{{ $detailBarang->nama_jenis_barang }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Barang</th>
                                <td>{{ $detailBarang->kode_barang }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Barang</th>
                                <td>{{ $detailBarang->nama_barang }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Harga</th>
                                <td>{{ "Rp".number_format($detailBarang->harga,2,',','.') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Satuan</th>
                                <td>{{ $detailBarang->satuan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi</th>
                                <td>{{ $detailBarang->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Stok Barang</th>
                                <td>{{ $detailBarang->stok_barang }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('barang') }}" class="btn btn-info">Kembali</a>
            </div>
        </div> 
    </section>
</div>

@endsection
