@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Transaksi Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @can('approve-ap')
        <a href="{{ route('terima_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-success">Terima Pengajuan</a>
        @endcan
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
            Tolak Pengajuan
        </button>
        @can('approve-vendor')
        <a href="{{ route('terima_vendor', $pengajuan->id) }}" class="btn btn-sm btn-success">Terima Vendor</a>
        @endcan
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalVendor">
            Tolak Vendor
        </button>
        
        <!-- Modal Tolak Ap-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keterangan Pengajuan di Tolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tolak_pengajuan', $pengajuan->id)}}" method="POST">
            @csrf 
            <div class="form-group">
                <label for="catatan">Catatan Penolakan</label>
                <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10" required></textarea>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jangan di Tolak</button>
        <button type="submit" class="btn btn-danger">Anda di TOLAK</button>
      </div>
      </form>
  </div>
</div>
</div>

 <!-- Modal Tolak Vendor-->
<div class="modal fade" id="exampleModalVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalVendor" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Keterangan di Tolak Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('tolak_vendor', $pengajuan->id)}}" method="POST">
            @csrf 
            <div class="form-group">
                <label for="catatan">Catatan Penolakan Vendor</label>
                <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10" required></textarea>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jangan di Tolak</button>
        <button type="submit" class="btn btn-danger">Anda di TOLAK</button>
      </div>
      </form>
  </div>
</div>
</div>

@if(Session::has('error'))
            <div class="alert alert-danger mt-3 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5>
                    <i class="icon fas fa-times"></i> Error!
                </h5>
                {{ Session::get('error') }}
            </div>
            @endif

        @if(Session::has('message'))
            <div class="alert alert-success mt-3 alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h5>

                <i class="icon fas fa-check"></i> Sukses!!
              </h5>

              {{ (Session('message')) }}
            </div>
            @endif


        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Tanggal Pengajuan</th>
                            <td>{{ $pengajuan->tanggal_pengajuan }} </td>
                        </tr>
                        <tr>
                            <th> Grand Total</th>
                            <td>{{ "Rp " . number_format($pengajuan->grand_total,2,',','.'); }} </td>
                        </tr>
                        <tr>
                            <th> Status Pengajuan AP</th>
                            <td>
                                @if($pengajuan->status_pengajuan_ap == 0)
                                <span class="badge badge-primary">Dibuat</span>
                                @elseif($pengajuan->status_pengajuan_ap == 1)
                                <span class="badge badge-success">Disetujui</span>
                                @else
                                <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th> Keterangan di Tolak AP</th>
                            <td>{{ $pengajuan->keterangan_ditolak_ap }} </td>
                        </tr>
                       

                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Status Pengajuan Vendor</th>
                            <td>
                                @if($pengajuan->status_pengajuan_vendor == 0)
                                <span class="badge badge-primary">Dibuat</span>
                                @elseif($pengajuan->status_pengajuan_vendor == 1)
                                <span class="badge badge-success">Disetujui</span>
                                @else
                                <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th> Keterangan di Tolak Vendor</th>
                            <td>{{ $pengajuan->keterangan_ditolak_vendor }} </td>
                        </tr>
                        <tr>
                            <th> Di Buat Pada</th>
                            <td>{{ $pengajuan->created_at }} </td>
                        </tr>
                        <tr>
                            <th> Di Buat Oleh</th>
                            <td>{{ $pengajuan->created_by }} </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-body"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Perusahaan Vendor</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Total Per Barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detailPengajuan as $detail)
                                <tr>
                                    <td>{{ $detail->nama }}</td>
                                    <td>{{ $detail->nama_barang }}</td>
                                    <td>{{ $detail->jumlah }} / {{ $detail->satuan }}</td>
                                    <td>{{ "Rp " . number_format($detail->harga,2,',','.'); }}</td>
                                    <td>{{ "Rp " . number_format($detail->total_per_barang,2,',','.'); }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4">Total Keseluruhan</th>
                                    <th>  {{ "Rp " . number_format($detail->total_per_barang,2,',','.'); }}</th>
                                </tr>
                            </tbody>
                        </table>
                        </div> 
            </section>

            <div class="card-footer"> 
                    <a href="{{ route('pengajuan.index') }}" class="btn btn-info">Kembali</a> 
                </div> 
        </div>

        @endsection