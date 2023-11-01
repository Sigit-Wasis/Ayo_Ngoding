@extends('backend.app')
@section('title', 'laporan')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">laporan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="card-footer clearfix">
        
        <a href="{{ route ('laporan2') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> laporan 2</a>
        
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
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Di Buat Oleh</th>
                            <th scope="col">Di Buat Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                        @php
                        $rowNumber = ($laporan->currentPage() - 1) * $laporan->perPage() + 1;
                        @endphp

                        @forelse($laporan as $lapor)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$lapor->tanggal_pengajuan}}</td>
                            <td>{{$lapor->created_by}}</td>
                            <td>{{$lapor->created_at}}</td>

                            <td>

                                <a href="{{ route ('cetak_laporan',$lapor->id)}}" class="btn btn-info"><i class="fas fa-print"></i> Cetak</a>


                            </td>
                        </tr>
                        @empty
                        <!-- Tidak ada laporan -->
                        @endforelse
                    </tbody>
                </table>

                @if($laporan->isEmpty())
                <p class="text-center">Tidak Ada laporan</p>
                @endif

                <div class="float-right">
                    {{ $laporan->links() }}
                </div>

            </div>
        </div>
    </section>
</div>

@endsection