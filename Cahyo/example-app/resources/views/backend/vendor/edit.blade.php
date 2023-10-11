@extends('backend.app')

@section('title', 'Edit Jenis Barang')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Vendor</a></li>
                        <li class="breadcrumb-item active">Edit Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN EDIT JENIS BARANG -->
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


        <form method="POST" action="{{ route('vendor.update', $editVendor->id) }}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" placeholder="Nama Vendor" value="{{ $editVendor->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Vendor" value="{{ $editVendor->alamat }}" required>
                </div>

                <div class="form-group">
                    <label for="telphone">Telepon</label>
                    <input type="text" class="form-control" id="telphone" name="telphone" placeholder="Telepon Vendor" value="{{ $editVendor->telphone }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Vendor" value="{{ $editVendor->email }}" required>
                </div>

                <div class="form-group">
                    <label for="kepemilikan">Kepemilikan</label>
                    <input type="text" class="form-control" id="kepemilikan" name="kepemilikan" placeholder="Kepemilikan Vendor" value="{{ $editVendor->kepemilikan }}" required>
                </div>

                <div class="form-group">
                    <label for="tahun_berdiri">Tahun Berdiri</label>
                    <input type="date" class="form-control" id="tahun_berdiri" name="tahun_berdiri" placeholder="Tahun Berdiri" value="{{ $editVendor->tahun_berdiri }}" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('vendor.index') }}" class="btn btn-info">Batal</a>
            </div>
        </form>
</div>
</section>
</div>

@endsection