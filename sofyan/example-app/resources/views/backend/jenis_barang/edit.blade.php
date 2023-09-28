@extends('backend.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Jenis Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jenis-barang') }}">Jenis Barang</a></li>
                        <li class="breadcrumb-item active">Edit Jenis Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{ Session('message')}}
                </div>
                @endif

                <form action="{{ route('update_jenis_barang', $editJenisBarang->id) }}" method="post">
                    @csrf
                    @method('put') <!-- Metode PUT untuk pembaruan -->

                    <div class="form-group">
                        <label for="nama_jenis_barang">Nama Jenis Barang:</label>
                        <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" value="{{ $editJenisBarang->nama }}" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Jenis Barang:</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $editJenisBarang->deskripsi }}</textarea>
                    </div>

                    <!-- Tambahkan input lain sesuai dengan kebutuhan -->

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection