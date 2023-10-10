@extends('backend.app')

@section ('title','vendor')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>vendor</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">vendor</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!-- BUTTON TAMBAH JENIS BARANG -->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_vendor') }}" class="btn btn-sm btn-block btn-primary">Tambah vendor</a>
    </div>
    <!-- END BUTTON TAMBAH JENIS BARANG -->

    <div class="card">
      <div class="card-body">
        <div class="card-body">

          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                <th scope="col">nama_perusahaan</th>
                <th scope="col">email</th>
                <th scope="col">nomor_telepon</th>
                <th scope="col">kepemilikan</th>
                <th scope="col">tahun_berdiri</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($vendors as $vendor)
              <tr>
                <!--<th scope="row">{{$loop->iteration }}</th>-->
                <td>{{$vendors->firstItem() +$loop->index }}</td>
                <td>{{ $vendor->nama_perusahaan }}</td>
                <td>{{ $vendor->email }}</td>
                <td>{{ $vendor->nomot_telepon }}</td>
                <td>{{ $vendor->kepemilikan }}</td>
                <td>{{ $vendor->tahun_berdiri }}</td>
                
                <td>

                  <a href="{{route('edit_vendor',$vendor->id)}}"  class="btn btn-sm btn-danger">Edit</a>
                  <a href=" {{route('delete_vendor',$vendor->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach

            </tbody>
          </table>
          {{ $vendors->render() }}

        </div>

      </div>


  </section>

</div>

@endsection