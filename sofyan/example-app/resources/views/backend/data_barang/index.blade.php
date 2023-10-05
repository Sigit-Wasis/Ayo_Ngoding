@extends('backend.app')
@section('title', 'Data Barang')
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
                        <li class="breadcrumb-item active">data barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-footer clearfix">
        <a href="{{ route ('tambah-barang') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Tambah Barang</a>
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
                            <th scope="col">Jenis Barang</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                        @php
                        $rowNumber = ($dataBarang->currentPage() - 1) * $dataBarang->perPage() + 1;
                        @endphp

                        @forelse($dataBarang as $data)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$data->jenis_barang}}</td>
                            <td>{{$data->kode_barang}}</td>
                            <td>{{$data->nama_barang}}</td>
                            <td>
                                <a href="{{ route('detail_barang', $data->id) }}" class="btn btn-sm btn-info">Show</a>
                                <a href="{{ route('edit_barang', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{route('delete_barang',$data->id)}}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <!-- Tidak ada data barang -->
                        @endforelse
                    </tbody>
                </table>

                @if($dataBarang->isEmpty())
                <p class="text-center">Tidak Ada Data Barang</p>
                @endif

                <div class="float-right">
                    {{ $dataBarang->links() }}
                </div>

            </div>
        </div>
    </section>
</div>

@endsection