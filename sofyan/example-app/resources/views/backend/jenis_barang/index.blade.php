@extends('backend.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jenis Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">jenis barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-footer clearfix">
        <a href="{{route('tambah-jenis-barang')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Tambah Barang</a>
    </div>
    <section class="content">
        <div class="card">
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{ Session('message')}}
                </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">Nama Jenis Barang</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Di Buat Pada</th>
                            <th scope="col">Di Buat Oleh</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                        @php
                        $rowNumber = ($jenisBarang->currentPage() - 1) * $jenisBarang->perPage() + 1;
                        @endphp

                        @foreach($jenisBarang as $jenis)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$jenis->nama}}</td>
                            <td>{{$jenis->deskripsi}}</td>
                            <td>{{$jenis->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>{{$jenis->created_by}}</td>
                            <td>
                                <a href="{{ route('edit_jenis_barang', $jenis->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <a href="{{route('delete_jenis_barang',$jenis->id)}}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="float-right">
                    {{ $jenisBarang->links() }}
                </div>

            </div>
        </div>

    </section>
</div>

@endsection