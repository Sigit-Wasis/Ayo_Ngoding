@extends('backend.app')
@section('title','jenis_barang')

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
    <!--BUTTON TAMBAH JENIS BARANG-->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_jenis_barang') }}" class="btn btn-sm btn-block btn-success"> Tambah Jenis Barang</a>
    </div>
    <!-- END BUTTON TAMBAH JENIS BARANG-->

    <div class="card">
      <div class="card-body">

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5>
            <i class="icon fas fa-check"></i> Sukses!
          </h5>
          {{ (Session('message')) }}
        </div>
        @endif
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">nama jenis barang</th>
              <th scope="col">deskripsi</th>
              <th scope="col">dibuat pada</th>
              <th scope="col">dibuat oleh</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jenisBarang as $jenis)
            <tr>
              <!--<th scope="row">{{ $loop->iteration }}</th>-->
              <td>{{$jenisBarang->firstItem() + $loop->index }}</td>
              <td>{{ $jenis->nama_jenis_barang}}</td>
              <td>{{ $jenis->deskripsi_barang}}</td>
              <td>{{ $jenis->created_at ?? \Carbon\Carbon::now() }}</td>
              <td>{{ $jenis->created_by}} </td>
              <td>

                <a href="{{ route('edit_jenis_barang',$jenis->id)}}" class="btn btn-sm btn-primary">edit</a>
                <a href="{{ route('delete_jenis_barang', $jenis->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{$jenisBarang->links()}}


      </div>
    </div>
  </section>
</div>
@endsection