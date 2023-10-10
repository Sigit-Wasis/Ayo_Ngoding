@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Vendor</a></li>
                        <li class="breadcrumb-item active">Tambah Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH DATA VENDOR -->
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
                <h3 class="card-title">Tambah Data Vendor</h3>
            </div>

            <form method="POST" action="{{ route('store_vendor') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_vendor">Nama Perusahaan</label>
                        <input type="text" class="form-control" value="{{ old('nama_vendor') }}" id="nama_vendor" name="nama_vendor" placeholder="Masukkan nama vendor">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" value="{{ old('alamat') }}" id="alamat" name="alamat" placeholder="Masukkan alamat vendor">
                    </div>

                    <div class="form-group">
                        <label for="telphone">Telephone</label>
                        <input type="text" class="form-control" value="{{ old('telphone') }}" id="telphone" name="telphone" placeholder="Masukkan nomor telepon vendor">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" placeholder="Masukkan alamat email vendor">
                    </div>

                    <div class="form-group">
                        <label for="kepemilikan">Kepemilikan</label>
                        <input type="text" class="form-control" value="{{ old('kepemilikan') }}" id="kepemilikan" name="kepemilikan" placeholder="Masukkan kepemilikan vendor">
                    </div>

                    <div class="form-group">
                        <label for="tahun_berdiri">Tahun Berdiri</label>
                        <input type="text" class="form-control" value="{{ old('tahun_berdiri') }}" id="tahun_berdiri" name="tahun_berdiri" placeholder="Masukkan tahun berdiri vendor">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data Vendor</button>
                    <a href="{{ route('vendors') }}" class="btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection