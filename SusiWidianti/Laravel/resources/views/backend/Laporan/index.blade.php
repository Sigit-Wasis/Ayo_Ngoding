@extends('backend.app')
@section('title', 'Transaksi Pengajuan')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-footer clearfix">
        <a href="{{ route ('Laporan') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Laporan</a>
    </div>
    <section class="content">
        <div class="col-md-2 mb-3">
            <a href="{{ route ('other_laporan') }} " class="btn btn-primary">
                <i class="fas fa-print"></i>Other Laporan
            </a>
        </div>
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
                            <th scope="col">#</th>
                            <th scope="col">tanggal_pengajuan</th>
                            <th scope="col">Di Buat Oleh</th>
                            <th scope="col">Di Buat Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                     

                        @forelse($laporans as $laporan)
                        <tr>
                        <td>{{$laporans->firstItem() + $loop->index }}</td>
                        <td>{{$laporan->tanggal_pengajuan}}</td>
                         <td>{{$laporan->created_by}}</td>
                         <td>{{$laporan->created_at?? \Carbon\Carbon::now() }}</td>
                        <td>

                                <a href="{{ route('cetak_laporan', $laporan->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-print">Cetak</i>
                                </a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pull-right">
                </div>

            </div>
        </div>
    </section>
</div>

@endsection