@extends('backend.app')

@section('title', 'Detail Transaksi Pengajuan')

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
                        <li class="breadcrumb-item"><a href="{{ route('pengajuan.index') }}">Transaksi Pengajuan</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <a href="{{ route('terima_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-success">Terima</a>
        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#keteranganModal">Tolak</button>
        <!-- Modal for Keterangan Penolakan -->
        <div class="modal fade" id="keteranganModal" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="keteranganModalLabel">Keterangan Penolakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tolak_pengajuan', $pengajuan->id) }}" method="post">
                            @csrf
                            <textarea name="catatan" id="catatan" class="form-control" rows="5" placeholder="Alasan Penolakan" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Tolak Sekarang Juga</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Jadi Ditolak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <a href="{{ route('terima_pengajuan_vendor', $pengajuan->id) }}" class="btn btn-sm btn-success">Terima Vendor</a>
        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#keteranganModalvendor">Tolak Vendor</button>

        <!-- Modal for Keterangan Penolakan vendor -->
        <div class="modal fade" id="keteranganModalvendor" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="keteranganModalLabel">Keterangan Penolakan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tolak_pengajuan_vendor', $pengajuan->id) }}" method="post">
                            @csrf
                            <textarea name="catatan" id="catatan" class="form-control" rows="5" placeholder="Alasan Penolakan" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Tolak Sekarang Juga</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Jadi Ditolak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        @if(Session::has('message'))
        <div class="alert alert-success mt-3 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5>
              <i class="icon fas fa-check"></i> Sukses!!
            </h5>
            {{ (Session('message')) }}
        </div>
        @endif
        
        @if(Session::has('error'))
            <div class="alert alert-danger mt-3 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5>
                    <i class="icon fas fa-times"></i> Error!
                </h5>
                {{ Session::get('error') }}
            </div>
            @endif


            <div class="row">
                <div class="col-md-6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Tanggal Pengajuan</th>
                                    <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Grand Total</th>
                                    <td>{{ "Rp " . number_format($pengajuan->grand_total, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Pengajuan AP</th>
                                    <td>
                                        @if( $pengajuan->status_pengajuan_ap == 0 )
                                        <span class="badge badge-primary">Dibuat</span>
                                        @elseif($pengajuan->status_pengajuan_ap == 1)
                                        <span class="badge badge-success">Disetujui</span>
                                        @else
                                        <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan Ditolak AP</th>
                                    <td>{{ $pengajuan->keterangan_ditolak_ap }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status Pengajuan Vendor</th>
                                    <td>
                                        @if( $pengajuan->status_pengajuan_vendor == 0 )
                                        <span class="badge badge-primary">Dibuat</span>
                                        @elseif($pengajuan->status_pengajuan_vendor == 1)
                                        <span class="badge badge-success">Disetujui</span>
                                        @else
                                        <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                   
                                    

                                    <th scope="row">Keterangan Ditolak Vendor</th>
                                    <td>{{ $pengajuan->keterangan_ditolak_vendor }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dibuat Pada</th>
                                    <td>{{ $pengajuan->created_at }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Dibuat Oleh</th>
                                    <td>{{ $pengajuan->created_by }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Harga Barang</th>
                        <th>Total Barang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailPengajuan as $detail)
                    <tr>
                        <td>{{$detail->nama_barang}}</td>
                        <td>{{$detail->jumlah}} </td>
                        <td>{{ "Rp " . number_format($detail->harga, 2, ',', '.'). "/" . $detail->satuan}} </td>
                        <td>{{ "Rp " . number_format($detail->total_barang, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Total Kesuluruhan</th>
                        <td>{{ "Rp " . number_format($pengajuan->grand_total, 2, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
            <section class="content">
                <a href="{{ route('pengajuan.index') }}" class="btn btn-info">Kembali</a>
                <div class="row">
                    <div class="col-md-6">
                    </div>
                </div>
            </section>
</div>
@endsection