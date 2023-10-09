@extends('backend.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Barang</li>
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
        <form method="POST" action="{{ route('pengajuan_barang') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="id">id_user</label>
                    <input type="text" class="form-control" id="id_user" name="id_user" placeholder="">
                </div>
                <div class="form-group">
                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                    <input text="text" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="grand_total">Grand Total</label>
                    <input text="text" class="form-control" id="grand_total" name="grand_total" placeholder="">
                </div>
                <div class="form-group">
                    <label for="aksi">aksi</label>
                    <input text="text" class="form-control" id="aksi" name="aksi" placeholder="">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('pengajuan_barang')}}" class="btn btn-info">kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection