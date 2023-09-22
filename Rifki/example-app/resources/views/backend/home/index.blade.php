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
                <div class="card">    
                <div class="card-body">
                        
                        <table class="table">
                    <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Jenis Barang</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Dibuat Pada</th>
                    <th scope="col">Dibuat oleh</th>
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
                    </tr>
                    @endforeach
                </tbody>
                </table>      
                 </div>
             </div>
    </section>
</div>

@endsection
