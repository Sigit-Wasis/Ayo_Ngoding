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
                        <li class="breadcrumb-item"><a href="#">Vendor</a></li>
                        <li class="breadcrumb-item active">Edit Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
            <form method="POST" action="{{ route('vendor.update', $editVendor->id) }}">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Vendor</label>
                    <input type="text" class="form-control"  id="nama" name="nama" value="{{ $editVendor->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $editVendor->alamat }}" required>
                </div>

                <div class="form-group">
                    <label for="telphone">Telphone</label>
                    <input type="text" class="form-control" id="telphone" name="telphone" value="{{ $editVendor->telphone }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $editVendor->email }}" required>
                </div>

                <div class="form-group">
                    <label for="kepemilikan">Kepemilikan</label>
                    <input type="text" class="form-control" id="kepemilikan" name="kepemilikan" value="{{ $editVendor->kepemilikan }}" required>
                </div>

                <div class="form-group">
                    <label for="tahun_berdiri">Tahun Berdiri</label>
                    <input type="text" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="{{ $editVendor->tahun_berdiri }}" required>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update Vendor</button>
                    <a href="{{ route('vendor.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
