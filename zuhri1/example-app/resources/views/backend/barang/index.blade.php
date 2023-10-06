@extends('backend.app')

@section ('title','My Barang')

@section('content')
<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Barang</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!-- BUTTON TAMBAH Data BARANG -->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_DataBarang') }}" class="btn btn-sm btn-block btn-primary">Tambah Data Barang</a>
    </div>
    <!-- END BUTTON TAMBAH Data BARANG -->

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

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">jenis_barang</th>
                <th scope="col">kode_barang</th>
                <th scope="col">nama_barang</th>
               
                <th scope="col">deskripsi</th>
               
                <th scope="col">Dibuat Pada</th>
                <th scope="col">Diupdate Pada</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>


              @forelse($DataBarang as $Barang)
              <tr>
                <!--<th scope="row">{{$loop->iteration }}</th>-->
                <th>{{$DataBarang->firstItem() +$loop->index }}</td>
                <td>{{ $Barang->nama_jenis_barang }}</td>
                <td>{{ $Barang->kode_barang }}</td>
                <td>{{ $Barang->nama_barang }}</td>
                
                <td>{{ $Barang->deskripsi }}</td>
                
                <td>{{ $Barang->created_at ?? \Carbon\Carbon::now()}}</td>
                <td>{{ $Barang->updated_at ?? \Carbon\Carbon::now()}}</td>
               
                <td>
                  
                  <a href="{{route('show_DataBarang',$Barang->id)}}" oncklick="return confirm('you sure?')" class="btn btn-sm btn-info">Show</a>
                  <a href="{{route('edit_DataBarang',$Barang->id)}}" oncklick="return confirm('you sure?')" class="btn btn-sm btn-primary">Edit</a>
                  <a href="{{route('delete_DataBarang',$Barang->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="13" class="text-center">
                  Tidak Ada Data Barang
                </td>
              </tr>
              @endforelse

            </tbody>
          </table>
          {{ $DataBarang->links() }}

        </div>

      </div>


  </section>

</div>

@endsection