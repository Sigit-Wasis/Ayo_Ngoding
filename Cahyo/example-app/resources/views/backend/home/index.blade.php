@extends('backend.app')

@section('content')

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>JenisBarang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">JenisBarang</li>
                </ol>
            </div>
        </div>
    </div>
</section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Jenis Brang</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col">Dibuat Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jenisBarang as $jenis)    
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $jenis->nama_jenis_barang }}</td>
                            <td>{{ $jenis->deskripsi_barang }}</td>
                            <td>{{ $jenis->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>{{ $jenis->created_by }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection