@extends('backend.app')
@section('title','Pengajuan')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Transaksi Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Transaksi Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        @can('approve-ap')
        <a href="{{ route('terima_pengajuan', $Pengajuans->id) }}" class="btn btn-sm btn-success">Terima</a>
        @endcan
        @can('tolak-ap')
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalLong">
            Tolak
        </button>
        @endcan
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin!!!!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('tolak_pengajuan', $Pengajuans->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <lebel for="catatan">Catatan Penolakan</label>
                                    <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10"
                                        required></textarea>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @can('approve-vendor')
        <a href="{{ route('terima_pengajuan_vendor', $Pengajuans->id) }}" class="btn btn-sm btn-success">Terima Vendor</a>
        @endcan
        @can('approve-vendor')
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalLongVendor">
            Tolak Vendor
        </button>
        @endcan
        <div class="modal fade" id="exampleModalLongVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongVendor">Apakah Anda Yakin!!!!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('tolak_pengajuan_vendor', $Pengajuans->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <lebel for="catatan">Catatan Penolakan</label>
                                    <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10"
                                        required></textarea>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        @if(Session::has('message'))
        <div class="alert alert-success mt-3 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <h5>
                <i class="icon fas fa-check"></i> Sukses!
            </h5>
            {{Session('message') }}
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th>{{ $Pengajuans->tanggal_pengajuan }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Grand Total</th>
                            <th>{{ "Rp " . number_format($Pengajuans->grand_total,0,',','.'); }}</th>
                        </tr>
                        <tr>
                        <tr>
                            <th scope="col">Di Buat Oleh</th>
                            <th>{{ $Pengajuans->created_by }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Di Buat Pada</th>
                            <th>{{ $Pengajuans->created_at ?? \Carbon\Carbon::now() }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <th scope="col">Status Pengajuan AP</th>
                        <th>
                            @if($Pengajuans->status_pengajuan_ap == 0)
                            <span class="badge badge-primary">Dibuat</span>
                            @elseif($Pengajuans->status_pengajuan_ap == 1)
                            <span class="badge badge-success">Disetujui</span>
                            @else
                            <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </th>
                        </th>
                        <tr>
                            <th scope="col">Keterangan Pengajuan AP</th>
                            <th>{{ $Pengajuans->keterangan_ditolak_ap }}</th>
                        </tr>
                        <th scope="col">Status Pengajuan Vendor</th>
                        <th>
                            @if($Pengajuans->status_pengajuan_vendor == 0)
                            <span class="badge badge-primary">Dibuat</span>
                            @elseif($Pengajuans->status_pengajuan_vendor == 1)
                            <span class="badge badge-success">Disetujui</span>
                            @else
                            <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </th>
                        </tr>
                        <tr>
                            <th scope="col">Keterangan Pengajuan Vendor</th>
                            <th>{{ $Pengajuans->keterangan_ditolak_vendor }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama Vendor</th>
                    <th scope="col">Nama Barang</th>
                    <!-- <th scope="col">Gambar Barang </th> -->
                    <th scope="col">Jumlah Barang </th>
                    <th scope="col">Harga Barang </th>
                    <th scope="col">Total Perbarang </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($detailBarang as $detail)
                <tr>
                    <td>{{ $detail->nama_perusahaan}}</td>
                    <td>{{ $detail->nama_barang}}</td>
                    <!-- <td>{{ $detail->gambar}}</td> -->
                    <td>{{ $detail->jumlah }} / {{$detail->satuan}}</td>
                    <td>{{ "Rp " . number_format($detail->harga,0,',','.'); }}</td>
                    <td>{{ "Rp " . number_format($detail->total_per_barang,0,',','.'); }}</td>
                </tr>
                </tr>
                @endforeach
                <tr>
                    <th colspan="4"> Total Keseluruhan </th>
                    <th> {{ "Rp " . number_format($Pengajuans->grand_total,0,',','.'); }}</th>
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <a href="{{ route('pengajuan') }}" class="btn btn-info">Kembali</a>
        </div>
    </section>
</div>

@endsection