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

        <div class="container">
            <h1>Edit Jenis Barang</h1>

            <!-- Tambahkan form untuk mengirim data edit jika diperlukan -->
            <form method="POST" action="{{ route('jenis_barang.update', $editJenisBarang->id) }}">
                @csrf
                @method('PUT')

                <!-- Tambahkan input fields untuk mengedit data jenis barang -->
                <div class="form-group">
                    <label for="nama_jenis_barang">Nama Jenis Barang:</label>
                    <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" value="{{ $editJenisBarang->nama_barang }}">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi Barang:</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $editJenisBarang->deskripsi }}</textarea>
                </div>

                <!-- Tombol "Edit" -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jenis_barang') }}" class="btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
