@extends('backend.app')

@section ('title','My Barang')

@section('style')
<link rel="stylesheet" href="{{ url('asset/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
  .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
    height: 37px !important;
  }

  .select2-container--default .select2-selection--single {
    height: 38px !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 35px !important;
  }
</style>
@endsection

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

          <form action="{{ route('DataBarang') }}" method="get">
          <div class="row mb-3">
            <div class="col-md-3">
              <label for="jenis_barang">Jenis Barang</label>
              <select class="form-control select2" style="width: 100%;" name="jenis_barang">
                <option value="">--pilih --</option>
                @foreach($jenisBarang as $jenis)
                <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_barang }}</option>
                @endforeach

              </select>
            </div>
            <div class="col-md-4">
              <label for="nama_barang">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang">
            </div>
            <div class="col-md-3">
              <label for="kode_barang">Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang">
            </div>
            <div class="row mb-2">
              <button type="submit" class="btn btn-primary" style="margin-top:  30px;">
                <i class="fa fa search"></i>Cari barang
              </button>
            </div>
          </div>

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

@section('script')
<script src="{{ url('asset/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $('.select2').select2()
</script>
@endsection