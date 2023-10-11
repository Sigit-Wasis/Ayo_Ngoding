@extends('backend.app')
@section('title', 'Edit Vendor')
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
                        <li class="breadcrumb-item"><a href="{{ route('vendors') }}">Vendors</a></li>
                        <li class="breadcrumb-item active">Edit Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('update_vendor', $editVendor->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="nama_vendor">Nama Vendor</label>
                        <input type="text" class="form-control" value="{{ old('nama_vendor', $editVendor->nama) }}" id="nama_vendor" name="nama_vendor" placeholder="Nama Vendor">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" value="{{ old('alamat', $editVendor->alamat) }}" id="alamat" name="alamat" placeholder="Alamat">
                    </div>

                    <div class="form-group">
                        <label for="telphone">Telphone</label>
                        <input type="text" class="form-control" value="{{ old('telphone', $editVendor->telphone) }}" id="telphone" name="telphone" placeholder="Telphone">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="{{ old('email', $editVendor->email) }}" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="kepemilikan">Kepemilikan</label>
                        <input type="text" class="form-control" value="{{ old('kepemilikan', $editVendor->kepemilikan) }}" id="kepemilikan" name="kepemilikan" placeholder="Kepemilikan">
                    </div>

                    <div class="form-group">
                        <label for="tahun_berdiri">Tahun Berdiri</label>
                        <input type="text" class="form-control" value="{{ old('tahun_berdiri', $editVendor->tahun_berdiri) }}" id="tahun_berdiri" name="tahun_berdiri" placeholder="Tahun Berdiri">
                    </div>

                    <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection