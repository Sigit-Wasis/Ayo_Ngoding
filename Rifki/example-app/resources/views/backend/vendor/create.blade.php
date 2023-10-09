@extends('backend.app')

@section('title', 'Tambah Vendor')

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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('vendor.create') }}">Vendor</a></li>
                        <li class="breadcrumb-item active">Tambah Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Tambah Vendor -->
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

        <form method="POST" action="{{ route('vendor.store') }}">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Vendor" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Vendor" value="{{ old('alamat') }}" required>
                </div>

                <div class="form-group">
                    <label for="telphone">Telepon</label>
                    <input type="text" class="form-control" id="telphone" name="telphone" placeholder="Telepon Vendor" value="{{ old('telphone') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Vendor" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="kepemilikan">Kepemilikan</label>
                    <input type="text" class="form-control" id="kepemilikan" name="kepemilikan" placeholder="Kepemilikan Vendor" value="{{ old('kepemilikan') }}" required>
                </div>

                <div class="form-group">
                    <label for="tahun_berdiri">Tahun Berdiri</label>
                    <input type="text" class="form-control" id="tahun_berdiri" name="tahun_berdiri" placeholder="Tahun Berdiri" value="{{ old('tahun_berdiri') }}" required>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan Vendor</button>
                <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </section>
</div>
@endsection
