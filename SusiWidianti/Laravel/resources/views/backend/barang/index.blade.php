@extends('backend.app')
@section('title','data barang')

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