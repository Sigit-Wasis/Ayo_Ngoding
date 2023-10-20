@extends('backend.app')
@section('title', 'Laporan')
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
    <div class="col-md-2 mb-2">
      <a href="{{ route('laporan') }}" class="btn btn-sm btn-block btn-success">Tambah Laporan</a>
    </div>

    <section class="content">
      <div class="card">
        <div class="card-body">
          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h5><i class="icon fas fa-check"></i> Sukses!!</h5>
            {{ Session('message') }}
          </div>
          @endif

          <table class="table">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Dibuat Pada</th>
                <th scope="col">Dibuat oleh</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @forelse($laporans as $laporan)
              <tr>
                <td>{{ $laporans->firstItem() + $loop->index }}</td>
                <td>{{ $laporan->tanggal_pengajuan }}</td>
                <td>{{ $laporan->created_by }}</td>
                <td>{{ $laporan->created_at }}</td>
                 <td>
                  <a href="{{ route('cetak_laporan', $laporan->id) }}" class="btn btn-primary">
                    <i class="'fas fa-print">Cetak</i>
                
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">
                  Tidak Ada Data Barang
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          {{ $laporans->links() }}
        </div>
      </div>
    </section>
  </section>
</div>

@endsection
