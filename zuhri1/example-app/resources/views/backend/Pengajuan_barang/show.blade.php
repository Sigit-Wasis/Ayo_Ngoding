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
        
        <a href="{{ route('terima_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-success">Terima</a>
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal">
            Tolak
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Catatan Ditolak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action=" {{ route('tolak_pengajuan', $pengajuan->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="catatan">Catatan Penolakan</label>
                                <textarea name="catatan" class="form-control"id="catatan" cols="30" rows="10"required></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak jadi Ditolak</button>
                        <button type="submit" class="btn btn-danger">Tolak Sekarang Juga !</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- modal vendor -->
        <a href="{{ route('terima_vendor', $pengajuan->id) }}" class="btn btn-sm btn-success">Terima Vendor</a>
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalvendor">Tolak Vendor</button>
        
        <div class="modal fade" id="exampleModalvendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action=" {{ route('tolak_vendor', $pengajuan->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="catatan">Catatan Penolakan</label>
                                <textarea name="catatan" class="form-control"id="catatan" cols="30" rows="10"required></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak jadi Ditolak</button>
                        <button type="submit" class="btn btn-danger">Tolak Sekarang Juga !</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @if(Session::has('message'))
        <div class="alert alert-success mt-3 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h5>
                <i class="icon fas fa-check"></i> Sukses
            </h5>
            {{ Session('message')}}
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal Pengajuan </th>
                            <th>{{ $pengajuan->tanggal_pengajuan }}</th>
                        </tr>
                        <tr>
                            <th>Grand Total </th>
                            <th>{{ "Rp".number_format($pengajuan->grand_total,2,',','.'); }}</th>
                        </tr>
                        <th>Status Pengajuan </th>
                        <th>
                            @if ($pengajuan->status_pengajuan_ap == 0)
                            <span class="badge badge-primary">Dibuat</span>
                            @elseif($pengajuan->status_pengajuan_ap ==1)
                            <span class="badge badge-success">Disetujui</span>
                            @else
                            <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </th>
                        </tr>
                        <tr>
                            <th>Dibuat oleh

                            <th>{{ $pengajuan->created_by }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Keterangan Pengajuan </th>
                            <th>{{ $pengajuan->keterangan_ditolak_ap }}</th>
                        </tr>
                        <tr>
                            <th>status_pengajuan_vendor </th>
                            <th>
                                @if ($pengajuan->status_pengajuan_vendor == 0)
                                <span class="badge badge-primary">Dibuat</span>
                                @elseif($pengajuan->status_pengajuan_vendor ==1)
                                <span class="badge badge-success">Disetujui</span>
                                @else
                                <span class="badge badge-danger">Ditolak</span>
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th>Keterangan pengajuan vendor </th>
                            <th>{{ $pengajuan->keterangan_ditolak_vendor }}</th>
                        </tr>
                        <th scope="col">created_at</th>
                        <th>{{ $pengajuan->created_at ?? \Carbon\carbon::now() }}</th>
                        </tr>


                    </thead>
                </table>
            </div>

        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nama vendor</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Barang</th>
                    <th>Total Per Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail_pengajuan as $detail)
                <tr>
                    <td>{{ $detail->nama_perusahaan }}</td>
                    <td>{{ $detail->nama_barang }}</td>
                    <td>{{ $detail->jumlah }} / {{ $detail->satuan }}</td>
                    <td>{{ "Rp".number_format($detail->harga,2,',','.'); }}</td>
                    <td>{{ "Rp".number_format($detail->total_per_barang,2,',','.'); }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4">Total Keseluruhan</th>
                    <th>{{ "Rp" . number_format($detail->total_per_barang,2,',','.'); }}</th>
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <a href="{{ route('pengajuan')}}" class="btn btn-info">kembali</a>
        </div>
    </section>
</div>

@endsection