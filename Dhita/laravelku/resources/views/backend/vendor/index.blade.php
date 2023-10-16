@extends('backend.app')
@section('title','vendor')
@section('content')

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Vendor</h1>
            </div>
            <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendor</li>
                    </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
  <!-- BUTTON TAMBAH JENIS BARANG -->
        <div class="col-md-2 mb-2">
          <a href="{{ route('tambah_vendor') }}" class="btn btn-sm btn-block btn-success">Tambah Vendor</a>
    </div>
    <!-- END BUTTON TAMBAH JENIS BARANG -->

  <thead>

    <section class="content">

        <div class="card">
            <div class="card-body">

              @if(Session::has('messages'))
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h5>

              <i class="icon fas fa-check"></i> Sukses!!</h5>
              
             {{ (Session('message')) }}
      </div>
          @endif

            <table class="table">
            <thead>
          <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Alamat</th>
      <th scope="col">Telphone</th>
      <th scope="col">Email</th>
      <th scope="col">Kepemilikan</th>
      <th scope="col">Tahun Berdiri</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>


    @forelse($vendor as $vendors)
    <tr>
      <!-- <th scope="row">{{ $loop->iteration}}</th> -->
      <td>{{ $vendor ->firstItem() + $loop->index }}</td>
      <td>{{ $vendors->nama }}</td>
      <td>{{ $vendors->alamat }}</td>
      <td>{{ $vendors->telphone }}</td>
      <td>{{ $vendors->email }}</td>
      <td>{{ $vendors->kepemilikan }}</td>
      <td>{{ $vendors->tahun_berdiri }}</td>
    <td>
    <!-- <a href="{{ route('show_vendor',$vendors->id) }}" class="btn btn-sm btn-info">Show</a> -->
    <a href="{{ route('edit_vendor',$vendors->id) }}" class="btn btn-sm btn-primary">Edit</a>
    <a href="{{ route('delete_vendor',$vendors->id) }}" onclick="return confirm('Apakah Kamu Ingin Menghapus ini?')" class="btn btn-sm btn-danger">Hapus</a>
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
        {{$vendor->links() }}
            </div>
        </div>
    </section>
</div>

@endsection