@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Edit Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Vendor</li>
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

        <form method="POST" action="{{ route('update_vendor', $editvendor->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control" value="{{ $editvendor->nama_perusahaan }}" id="nama_perusahaan" name="nama_perusahaan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" value="{{ $editvendor->email }}" id="email" name="email" placeholder="">
                </div>
                <div class="form-group">
                    <label for="nomor_telpon">Nomor Telpon</label>
                    <input type="text" class="form-control" value="{{ $editvendor->nomor_telpon }}" id="nomor_telpon" name="nomor_telpon" placeholder="">
                </div>
                <div class="form-group">
                    <label for="kepemilikan">Kepemilikan</label>
                    <input type="text" class="form-control" value="{{ $editvendor->kepemilikan }}" id="kepemilikan" name="kepemilikan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="tahun_berdiri">Tahun Berdiri</label>
                    <input type="text" class="form-control" value="{{ $editvendor->tahun_berdiri }}" id="tahun_berdiri" name="tahun_berdiri" placeholder="">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Vendor</button>
                    <a href="{{ route('vendor') }}" class="btn btn-info">Kembali</a>

                </div>
        </form>

    </section>
</div>

@endsection