@extends('backend.app')
@section('title','barang')
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
            <li class="breadcrumb-item active">Pengajuan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <!-- BUTTON TAMBAH JENIS BARANG -->
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_pengajuan') }}" class="btn btn-sm btn-block btn-success">Tambah Pengajuan</a>
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

                <i class="icon fas fa-check"></i> Sukses!!
              </h5>

              {{ (Session('message')) }}
            </div>
            @endif

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">User</th>
                  <th scope="col">Tanggal Pengajuan</th>
                  <th scope="col">Grand Total</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>


                @forelse($pengajuan as $pengajuan_tr)
                <tr>
                  <!-- <th scope="row">{{ $loop->iteration}}</th> -->
                  <td>{{ $pengajuan ->firstItem() + $loop->index }}</td>
                  <td>{{ $pengajuan_tr->created_by }}</td>
                  <td>{{ $pengajuan_tr->tanggal_pengajuan }}</td>
                  <td>{{ $pengajuan_tr->grand_total }}</td>
                  <td>
                    <!-- <a href="{{ route('show_vendor',$pengajuan_tr->id) }}" class="btn btn-sm btn-info">Show</a> -->
                    <a href="{{ route('edit_pengajuan',$pengajuan_tr->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ route('delete_pengajuan',$pengajuan_tr->id) }}" onclick="return confirm('Apakah Kamu Ingin Menghapus ini?')" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                </tr>
                @empty

                @endforelse
              </tbody>
            </table>
             @if($pengajuan->isEmpty())
             <p class="text-center">Tidak ada transaksi pengajuan</p>
             @endif

             <div class="float-right">
            {{$pengajuan->links() }}
          </div>
          </div>
        </div>
      </section>
</div>

@endsection