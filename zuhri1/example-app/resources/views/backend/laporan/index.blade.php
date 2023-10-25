@extends('backend.app')

@section ('title','My Laporan')

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

    @if(Session::has('message'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5>
            <i class="icon fas fa-check"></i> Sukses
        </h5>
        {{ Session('message')}}
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">no</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Dibuat Oleh</th>
                <th scope="col">Dibuat Pada</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
              @foreach ($laporans as $laporan)
              <tr>
                <!--<th scope="row">{{$loop->iteration }}</th>-->
                <td>{{$laporans->firstItem() +$loop->index }}</td>
                <td>{{ $laporan->tanggal_pengajuan }}</td>
                <td>{{ $laporan->created_by }}</td>
                <td>{{ $laporan->created_at }}</td>
                <td>

                  <a href="{{route('cetak_laporan',$laporan->id)}}" class="btn btn-sm btn-info">cetak</a>
                 
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