@extends('backend.app')

@section('title', 'Tambah Jenis Barang')

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
                        <li class="breadcrumb-item"><a href="#">Jenis Barang</a></li>
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

        <form method="POST" action="{{ route('store.permission') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Permission</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="">
                </div>
           
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href= "{{ route('roles.index') }}" class=" btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection