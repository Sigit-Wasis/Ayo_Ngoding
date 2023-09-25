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
                                <li class="breadcrumb-item active">Jenis Barang</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

                <section class="content">
                    <!-- BUTTON TAMBAH JENIS BARANG -->
                    <div class="col-md-2 mb-2">
                    <a href="{{route('tambah_jenis_barang')}}" class="btn btn-sm btn-block btn-success">Tambah Jenis Barang</a>
                         </div>
                <div class="card">    
            <div class="card-body">

                        @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                <i class="icon fas fa-check"></i> Sukses!
            </h5>
                {{Session('message')}}
                    </div>
                    @endif

                        <table class="table">
                    <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Dibuat Pada</th>
                    <th scope="col">Dibuat oleh</th>
                    <th scope="col">Aksi</th>
                    </tr>

                </thead>
                <tbody>


                        @foreach($jenisbarang as $jenis)
                    <tr>
                    <th scope="row">{{ $loop->iteration}}</th>
                    <td>{{ $jenis->nama_barang }}</td>
                    <td>{{ $jenis->deskripsi }}</td>
                    <td>{{ $jenis->created_at ?? \Carbon\Carbon::now()}}</td>
                    <td>{{ $jenis->created_by }}</td>
                    <td>
                    <a href="" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{route('delete_jenis_barang', $jenis->id)}}" onclick="return confirm('Are you sure')" class="btn btn-sm btn-danger"> Delete</a>
                </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>      
                 </div>
             </div>
    </section>
</div>

@endsection
