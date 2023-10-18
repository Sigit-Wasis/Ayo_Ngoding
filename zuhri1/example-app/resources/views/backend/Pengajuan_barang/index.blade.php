@extends('backend.app')

@section ('title','pengajuan_barang')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pengajuan Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pengajuan Barang</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!-- BUTTON TAMBAH JENIS BARANG -->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_pengajuan_barang') }}" class="btn btn-sm btn-block btn-primary">Tambah Pengajuan Barang</a>
    </div>
    <!-- END BUTTON TAMBAH JENIS BARANG -->

    <div class="card">
      <div class="card-body">
        <div class="card-body">

          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h5>
              <i class="icon fas fa-check"></i> Sukses
            </h5>
            {{ Session('message')}}
          </div>
          @endif

          <table class="table">
            <thead>
              <tr>
                <th scope="col">no</th>
                <th scope="col">tanggal_pengajuan</th>
                <th scope="col">grand_total</th>
                <th scope="col">Dibuat pada</th>
                <th scope="col">Dibuat oleh</th>
                <th scope="col">aksi</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($pengajuan_barang as $pengajuan)
              <tr>
                <!--<th scope="row">{{$loop->iteration }}</th>-->
                <td>{{$pengajuan_barang->firstItem() +$loop->index }}</td>
                <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                <td>{{"Rp".number_format($pengajuan->grand_total,2,',','.'); }}</td>
                <td>{{ $pengajuan->created_by }}</td>
                <td>{{ $pengajuan->created_at ??\Carbon\Carbon::now() }}</td>
                <td>

                  <a href="{{route('show_pengajuan',$pengajuan->id)}}" class="btn btn-sm btn-danger">Show</a>
                  <a href="{{route('edit_pengajuan',$pengajuan->id)}}" class="btn btn-sm btn-danger">Edit</a>
                  <a href=" {{route('pengajuan_delete',$pengajuan->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          {{ $pengajuan_barang->render() }}

        </div>

      </div>


  </section>

</div>

@endsection