@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <!-- BUTTON TAMBAH Data BARANG -->
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_barang') }}" class="btn btn-sm btn-block btn-success">Tambah Data Barang</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                    {{ Session('message') }}
                </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Stok Barang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $barang->id }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->harga }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>{{ $barang->deskripsi }}</td>
                            <td><img src="{{ $barang->gambar }}" alt="{{ $barang->nama_barang }}" width="50"></td>
                            <td>{{ $barang->stok_barang }}</td>
                            <td>
                                <a href="{{ route('Show_barang', $barang->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('delete_barang', $barang->id) }}" onclick="return confirm('Are you sure')" class="btn btn-sm btn-danger">Delete</a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Tidak Ada Data Barang
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $barangs->links() }}

            </div>
        </div>
    </section>
</div>

@endsection