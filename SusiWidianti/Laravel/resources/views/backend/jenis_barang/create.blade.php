@extends('backend.app')

@section('content')

<div class="content-wrapper">
 <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Jenis Barang</h1>
                </div>
                 <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tambah Jenis Barang</li>
                 </ol>
            </div>
        </div>
    </div>
</section>

<!--KONTEN TAMBAH JENIS BARABG -->
<section class="content">
    <form method="POST" action="{{ route('store_jenis_barang') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Jenis Barang</label>
                <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" placeholder="">
            </div>
            <div class="form-group">
<label for="exampleInputPassword1">Deskripsi_barang</label>
<input type="text" class="form-control" id="deskripsi_barang" name="deskripsi_barang" placeholder="">
</div>
</div>

<div class="card-footer">
<button type="Simpan Jenis Barang" class="btn btn-primary" fdprocessedid="gjaft">Simpan Jenis Barang</button>
</div>
</form>

    </section>
</div>

@endsection