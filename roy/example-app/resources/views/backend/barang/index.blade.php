@extends('backend.app')
@section('title','Data Barang')
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
                        <li class="breadcrumb-item active">Data Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_barang') }}" class="btn btn-sm btn-block btn-success">Tambah Data Barang</a>
        </div>
        <!--END BUTTON JENIS BARANG -->

        <div class="card">
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                        <h5>
                            {{ Session('message')}}
                </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N0</th>
                            <th scope="col">Jenis Barang</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Dibuat Pada</th>                           
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $barangs->firstItem() + $loop->index }}</td>
                            <td>{{ $barang->nama_jenis_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>                       
                            <td>{{ $barang->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>{{ $barang->created_by }}</td>
                            <td>
                                <a href=" {{ route('show_barang', $barang->id) }}" class="btn btn-sm btn-info">Show </a>
                                <a href=" {{ route('edit_barang', $barang->id) }}" class="btn btn-sm btn-primary">Edit </a>
                                <a href=" {{ route('delete_barang', $barang->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Hapus</a>
                            <td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
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