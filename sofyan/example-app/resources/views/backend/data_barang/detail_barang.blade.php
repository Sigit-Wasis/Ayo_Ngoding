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
                        <li class="breadcrumb-item active">detail barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="card">
        <div class="card-header">
            Detail Barang
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>

                        @if(!empty($detailBarang->image))
                        <img src="{{ asset('assets/dist/img/' . $detailBarang->image) }}" alt="{{ $detailBarang->nama_barang }}" class="img-thumbnail" style="width: 150px; ">
                        @else
                        <div class="text-center py-4">No Image</div>
                        @endif

                    </tr>
                    <tr>
                        <th scope="row">Nama Barang</th>
                        <td>{{ $detailBarang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Jenis Barang</th>
                        <td>{{ $detailBarang->jenis_barang }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Kode Barang</th>
                        <td>{{ $detailBarang->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Harga</th>
                        <td>{{ $detailBarang->harga }}</td>
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
                        <th scope="row">Stok</th>
                        <td>{{ $detailBarang->stok }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Created At</th>
                        <td>{{ $detailBarang->created_at }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Created By</th>
                        <td>{{ $detailBarang->created_by }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Updated At</th>
                        <td>{{ $detailBarang->updated_at }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Updated By</th>
                        <td>{{ $detailBarang->updated_by }}</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ route('edit_barang', ['id' => $detailBarang->id]) }}" class="btn btn-primary mt-3">Edit Barang</a>
                            <a href="{{ route('data_barang') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Barang</a>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


</div>
@endsection