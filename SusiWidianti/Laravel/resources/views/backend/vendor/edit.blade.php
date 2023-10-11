@extends('backend.app')

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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Vendor</li>
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

        <form method="POST" action="{{ route('update_data_Vendor', $editVendor->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" value="{{$editVendor->nama}}" id="nama" name="nama" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" value="{{$editVendor->alamat}}" id="alamat" name="alamat" placeholder="Alamat">
                </div>
                <div class="form-group">
                    <label for="telphone">Telphone</label>
                    <input type="text" class="form-control" value="{{$editVendor->telphone}}" id="telphone" name="telphone" placeholder="Telphone">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control"value="{{$editVendor->email}}" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="kepemilikan">Kepemilikan</label>
                    <input type="text" class="form-control" value="{{$editVendor->kepemilikan}}" id="kepemilikan" name="kepemilikan" placeholder="Kepemilikan">
                </div>
                <div class="form-group">
                    <label for="tahun_berdiri">Tahun Berdiri</label>
                    <input type="text" class="form-control" value="{{$editVendor->tahun_berdiri}}"id="tahun_berdiri" name="tahun_berdiri" placeholder="Tahun Berdiri">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Jenis Barang</button>
                <a href="{{ route('vendor') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection
