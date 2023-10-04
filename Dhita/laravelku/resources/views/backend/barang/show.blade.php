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
                <table class="table table-striped">
                    <thead>
                    <tr> 
                            <th scope="col">Gambar</th> 
                            <th> 
                            <img src="{{ url ($detailBarang->gambar) }}" width="200" alt=""> 
                            </th> 
                        </tr>
                        <!-- <tr>
                            @if(!empty($detailBarang->image))
                            <img src="{{ assets('assets/dist/img/'.$detailBarang->image) }}" alt="{{$detailBarang->nama_barang}}" class="img-thumnail"style="width: 150px; ">
                            @else
                            <div class="text-center-py-4">No Image</div>
                            @endif
                        </tr> -->
                        <tr>
                            <th scope="row">ID Jenis Barang</th>
                            <th>{{$detailBarang->id_jenis_barang}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Kode Barang</th>
                            <th>{{$detailBarang->kode_barang}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Nama Barang</th>
                            <th>{{$detailBarang->nama_barang}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Harga</th>
                            <th>{{$detailBarang->harga}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Satuan</th>
                            <th>{{$detailBarang->satuan}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Deskripsi</th>
                            <th>{{$detailBarang->deskripsi}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Stok Barang</th>
                            <th>{{$detailBarang->stok_barang}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Di Buat Pada</th>
                            <th>{{$detailBarang->created_at}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Di Buat Oleh</th>
                            <th>{{$detailBarang->created_by}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div> 
    </section>
</div>

@endsection