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
                        <li class="breadcrumb-item active">jenis_barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--KONTEN TAMBAH JENIS BARANG -->
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
        <form method="POST" action="{{ route('store_jenis_barang') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_jenis_baranga">Nama Jenis Barang</label>
                    <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" placeholder="">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Jenis Barang</label>
                    <input text="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Jenis Barang</button>
                <a href="{{ route('jenis_barang')}}" class="btn btn-info">kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection