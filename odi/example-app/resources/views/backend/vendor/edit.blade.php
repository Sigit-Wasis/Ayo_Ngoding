@extends('backend.app')
@section('title','Vendor')
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

    <!--kontek tambah jenis barang -->

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
                    <label for="name">Nama Perusahaan</label>
                    <input type="text" class="form-control" value="{{$editvendor->nama_perusahaan}}" id=" name"
                        name="nama_perusahaan" placeholder="Nama Perusahaan">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="{{$editvendor->email}}" id="email" name="email"
                        placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="nomortelpon">Nomor Telpon</label>
                    <input type="text" class="form-control" value="{{$editvendor->nomor_telpon}}" id="nomortelpon"
                        name="nomor_telpon" placeholder="Nomor Telpon">
                </div>
                <div class="form-group">
                    <label for="kepemilikan">Kepemilikan</label>
                    <input type="text" class="form-control" value="{{$editvendor->kepemilikan}}" id="kepemilikan"
                        name="kepemilikan" placeholder="Kepemilikan">
                </div>
                <div class="form-group">
                    <label for="tahun_dibuat">Tahun Dibuat</label>
                    <input type="text" class="form-control" value="{{$editvendor->tahun_berdiri}}" id="tahun_dibuat"
                        name="tahun_berdiri" placeholder="Tahun Dibuat">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('vendor') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>

@endsection