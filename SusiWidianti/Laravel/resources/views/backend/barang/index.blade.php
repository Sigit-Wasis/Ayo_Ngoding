@extends('backend.app')
@section('title','data barang')


@section('title', 'Data Barang')

@section('style')
<link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
  .select2-container--default.select2-container--focus .select2-selection--multiple,
  .select2-container--default.select2-container--focus .select2-selection--single {
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
            <li class="breadcrumb-item active"> Data Barang</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!--BUTTON TAMBAH JENIS BARANG-->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_barang') }}" class="btn btn-sm btn-block btn-success"> Tambah Data Barang</a>
    </div>
    <!-- END BUTTON TAMBAH JENIS BARANG-->

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('import.barang') }}" method="POST" enctype="multipart/form-data">
     
      @csrf
        <div class="modal-body">
          <div class="col-md-12">
            <input type="file" name="file_barang" class="form-control" requered>
          </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ayo Import</button>
      </div>
      </form>  
    </div>
  </div>
</div>

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

        <form action="{{ route('data_barang') }}" method="get">
        <div class="row">
            <div class="col-md-3">
              <label for="jenis_barang">Jenis Barang</label>
              <select class="form-control select2" style="width: 100%;" name="jenis_barang">
                <option value="">--pilih--</option>
                @foreach($Barangjenis as $jenis)
                <option value="{{ $jenis->id}}"> {{$jenis->nama_jenis_barang }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label for="jenis_barang">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang">
            </div>
            <div class="col-md-3">
              <label for="jenis_barang">Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary" style="margin-top: 30px;">
                <i class="fa fa-search"></i> Cari Barang
              </button>
            </div>
          </form>
        </div>



        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">id jenis barang</th>
              <th scope="col">kode barang</th>
              <th scope="col">nama barang</th>
              <th scope="col">harga</th>
              <th scope="col">satuan</th>
              <th scope="col">deskripsi</th>
              <th scope="col">gambar</th>
              <th scope="col">stok</th>
              <th scope="col">dibuat pada</th>
              <th scope="col">dibuat oleh</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($DataBarang as $barang)
            <tr>
              <!--<th scope="row">{{ $loop->iteration }}</th>-->
              <td>{{$DataBarang->firstItem() + $loop->index }}</td>
              <td>{{ $barang->nama_jenis_barang}}</td>
              <td>{{ $barang->kode_barang}}</td>
              <td>{{ $barang->nama_barang}}</td>
              <td>{{ $barang->harga}}</td>
              <td>{{ $barang->satuan}}</td>
              <td>{{ $barang->deskripsi}}</td>
              <td>{{ $barang->gambar}}</td>
              <td>{{ $barang->Stok}}</td>
              <td>{{ $barang->created_at ?? \Carbon\Carbon::now() }}</td>
              <td>{{ $barang->created_by}} </td>
              <td>

                <a href="{{ route('show_barang',$barang->id)}}" class="btn btn-sm btn-info">Show</a>
                <a href="{{ route('edit_barang',$barang->id)}}" class="btn btn-sm btn-primary">edit</a>
                <a href="{{ route('delete_barang', $barang->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center">
                Tidak Ada Data Barang
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>

        {{$DataBarang->links()}}


      </div>
    </div>
  </section>
</div>
@endsection

@section('script')
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
  $('.select2').select2();
</script>
@endsection