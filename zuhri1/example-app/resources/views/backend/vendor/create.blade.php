@extends('backend.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--KONTEN TAMBAH Data BARANG -->
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
        <form method="POST" action="{{ route('store_vendor') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="id">nama_perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input text="text" class="form-control" id="email" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">nomor_telepon</label>
                    <input text="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="">
                </div>
                <div class="form-group">
                    <label for="kepemilikan">kepemilikan</label>
                    <input text="text" class="form-control" id="kepemilikan" name="kepemilikan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="tahun_berdiri">tahun_berdiri</label>
                    <input text="text" class="form-control" id="tahun_berdiri" name="tahun_berdiri" placeholder="">
                </div> 
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('tambah_vendor')}}" class="btn btn-info">kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection