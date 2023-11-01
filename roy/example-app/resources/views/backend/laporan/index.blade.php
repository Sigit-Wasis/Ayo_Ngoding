@extends('backend.app')
@section('title','laporan')
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

    <section class="content">
        <div class="col-md-2 mb-3">
            <a href="{{ route('other_laporan') }}" class="btn btn-primary">
                <i class="fa fa-print"></i> Other Laporan
            </a>
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
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                        <tr>
                            <td>{{ $laporans->firstItem() + $loop->index }}</td>
                            <td>{{ $laporan->tanggal_pengajuan }}</td>
                            <td>{{ $laporan->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>{{ $laporan->created_by }}</td>
                            <td>
                                <a href=" {{ route('cetak_laporan', $laporan->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-print">Cetak</i>
                            </td>
                            
                            </tr>
                            @empty
                        <tr>
                            <td colspan="13" class="text-center">
                                Tidak Ada Laporan
                            </td>
                    @endforelse
                    </tbody>
                    </table>

                    {{ $laporans->render() }}
            </div>

    </div>
</section>
</div>


@endsection