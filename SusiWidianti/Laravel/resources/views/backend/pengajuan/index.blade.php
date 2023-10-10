@extends('backend.app')
@section('title', 'Data Barang')

@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Barang Pengajuan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Barang Pengajuan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!-- BUTTON TAMBAH JENIS BARANG PENGAJUAN -->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_data_pengajuan') }}" class="btn btn-sm btn-block btn-success">Tambah Barang Pengajuan</a>
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
              <th scope="col">tanggal_pengajuan</th>
              <th scope="col">grand_total</th>
              <th scope="col">created_at</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>

            @forelse($trBarang as $data_barang)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data_barang->tanggal }}</td>
              <td>{{ $data_barang->grand_total }}</td>
              <td>{{ $data_barang->craeted_at ?? \Carbon\Carbon::now() }}</td>
              <td>
                <a href="{{ route('show_data_pengajuan', $data_barang->id) }}" class="btn btn-sm btn-info">Show</a>
                <a href="{{ route('edit_data_pengajuan', $data_barang->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <a href="{{ route('delete_data_pengajuan', $data_barang->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center">
                Tidak Ada Data Barang Pengajuan
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>

        {{ $trBarang->links() }}

      </div>
    </div>
  </section>
</div>
@endsection
