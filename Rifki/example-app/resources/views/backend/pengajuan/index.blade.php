@extends('backend.app')
@section('title', 'Transaksi Pengajuan')
@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Transaksi Pengajuan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Transaksi Pengajuan</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="col-md-2 mb-2">
      <a href="{{ route('tambah_pengajuan') }}" class="btn btn-sm btn-block btn-success">Tambah Pengajuan</a>
    </div>

    <section class="content">
      <div class="card">
        <div class="card-body">
          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Sukses!!</h5>
            {{ Session('message') }}
          </div>
          @endif

          <table class="table">
            <thead>
              <tr>
                <th scope="col">NO</th>
                <th scope="col">Tanggal Pengajuan</th>
                <th scope="col">Grand Total</th>
                <th scope="col">Dibuat Pada</th>
                <th scope="col">Dibuat oleh</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transaksiPengajuan as $pengajuan_tr)
              <tr>
                <td>{{ $transaksiPengajuan->firstItem() + $loop->index }}</td>
                <td>{{ $pengajuan_tr->tanggal_pengajuan }}</td>
                <td>{{ "Rp " . number_format($pengajuan_tr->grand_total, 2, ',', '.') }}</td>
                <td>{{ $pengajuan_tr->created_at }}</td>
                <td>{{ $pengajuan_tr->created_by }}</td>
                <td>
                  <a href="{{ route('show_pengajuan', $pengajuan_tr->id) }}" class="btn btn-info">Show</a>
                  <a href="{{ route('edit_pengajuan', $pengajuan_tr->id) }}" class="btn btn-sm btn-primary">Edit</a>
                  <a href="{{ route('delete_pengajuan', $pengajuan_tr->id) }}" onclick="return confirm('Apakah Kamu Ingin Menghapus ini?')" class="btn btn-sm btn-danger">Hapus</a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">
                  Tidak Ada Data Barang
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          {{ $transaksiPengajuan->links() }}
        </div>
      </div>
    </section>
  </section>
</div>

@endsection
