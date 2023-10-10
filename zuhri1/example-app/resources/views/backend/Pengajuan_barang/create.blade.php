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
        <form method="POST" action="{{ route('pengajuan_barang') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="vendors">user</label>
                    <select name="vendors" class="form-control">
                        <option value="">*** pilih vendor ***</option>
                        @foreach ($pengajuan as $vendor)
                        <option value="{{ $vendor }}">{{ $vendor }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang 2</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="">
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