@extends('backend.app')
@section('title','Barang')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barang</h1>
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
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_barang') }}" class="btn btn-block btn-primary">Tambah Data</a>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{Session('message') }}
                </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Jenis Barang</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Barang as $barang)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $Barang->firstItem() + $loop->index }}</td>
                            <td>{{ $barang->nama_jenis_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->created_by }}</td>
                            <td>
                                <a href="{{ route('show_barang', $barang->id) }}"
                                    class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ route('edit_barang', $barang->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('delete_barang', $barang->id) }}"
                                    onclick="return confirm('Apa kamu yakin')" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center">
                                Tidak Ada Barang
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $Barang->links() }}
            </div>
        </div>
    </section>
</div>


@endsection