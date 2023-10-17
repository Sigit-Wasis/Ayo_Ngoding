@extends('backend.app')
@section('title', 'Vendors')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendors</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendors</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-footer clearfix">
        @can('vendors-create')
        <a href="{{ route ('tambah_vendor') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Tamabah Vendor</a>
        @endcan
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
                            <th scope="col">Nama perusahaan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telpon</th>
                            <th scope="col">Kepemilikan</th>
                            <th scope="col">Tahun Berdiri</th>
                            <th scope="col">Created At</th> <!-- Tambah kolom "Created At" -->
                            <th scope="col">Created By</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                        @php
                        $rowNumber = ($vendors->currentPage() - 1) * $vendors->perPage() + 1;
                        @endphp

                        @forelse($vendors as $vendor)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$vendor->nama}}</td>
                            <td>{{$vendor->alamat}}</td>
                            <td>{{$vendor->email}}</td>
                            <td>{{$vendor->telphone}}</td>
                            <td>{{$vendor->kepemilikan}}</td>
                            <td>{{$vendor->tahun_berdiri}}</td>
                            <td>{{$vendor->created_at}}</td> <!-- Menampilkan nilai kolom "Created At" -->
                            <td>{{$vendor->created_by}}</td>
                            <td>
                                @can('vendors-edit')
                                <a href="{{ route('edit_vendor', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                @endcan
                                @can('vendors-delete')
                                <a href="{{route('delete_vendor',$vendor->id)}}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <!-- Tidak ada vendor -->
                        @endforelse
                    </tbody>
                </table>

                @if($vendors->isEmpty())
                <p class="text-center">Tidak Ada vendor</p>
                @endif

                <div class="float-right">
                    {{ $vendors->links() }}
                </div>

            </div>
        </div>
    </section>
</div>

@endsection