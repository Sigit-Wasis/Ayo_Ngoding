@extends('backend.app')
@section('title', 'vendor')

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
            <li class="breadcrumb-item active">Vendor</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!-- BUTTON TAMBAH JENIS BARANG PENGAJUAN -->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_Vendor') }}" class="btn btn-sm btn-block btn-success">Tambah Vendor</a>
    </div>
    <!-- END BUTTON TAMBAH BARANG PENGAJUAN -->

    <div class="card">
      <div class="card-body">

        @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5>
            <i class="icon fas fa-check"></i> Sukses!
          </h5>
          {{ Session('message') }}
        </div>
        @endif
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">nama</th>
              <th scope="col">alamat</th>
              <th scope="col">telphone</th>
              <th scope="col">email</th>
              <th scope="col">kepemilikan</th>
              <th scope="col">tahun_berdiri</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($vendors as $data_vendors)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data_vendors->nama }}</td>
              <td>{{ $data_vendors->alamat }}</td>
              <td>{{ $data_vendors->telphone }}</td>
              <td>{{ $data_vendors->email }}</td>
              <td>{{ $data_vendors->kepemilikan }}</td>
              <td>{{ $data_vendors->tahun_berdiri }}</td>
              <td>{{ $data_vendors->created_at ?? \Carbon\Carbon::now() }}</td>
              <td>
       
              <a href="{{ route('show_data_Vendor', $data_vendors->id) }}" class="btn btn-sm btn-primary">Show</a>
                <a href="{{ route('edit_data_Vendor', $data_vendors->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('delete_data_Vendor', $data_vendors->id) }}" onclick="return confirm('Are You sure?')" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center">
                Tidak Ada Data Barang Vendor
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>

        {{ $vendors->links() }}

      </div>
    </div>
  </section>
</div>
@endsection