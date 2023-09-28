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
                        <li class="breadcrumb-item"><a href="#">Jenis Barang</a></li>
                        <li class="breadcrumb-item active">Tambah Jenis Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH JENIS BARANG -->
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
                <h3 class="card-title">Tambah Jenis Barang</h3>
            </div>

            <form method="POST" action="{{route('store_jenis_barang')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama">Nama Jenis Barang</label>
                        <input type="text" class="form-control" id="nama" name="nama_jenis_barang" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Jenis Barang</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Jenis Barang</button>
                        <a href="{{route('jenis-barang')}}" class="btn btn-info">kembali</a>
                    </div>
            </form>
        </div>
    </section>
</div>
@endsection