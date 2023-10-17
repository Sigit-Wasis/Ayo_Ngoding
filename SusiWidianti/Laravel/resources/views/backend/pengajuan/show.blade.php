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
        <a href="{{ route('terima_pengajuan',$pengajuan->id) }}" class="btn btn-sm btn-success">Terima</a>
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
            Tolak
        </button>

        <a href="{{ route('terima_vendor',$pengajuan->id) }}" class="btn btn-sm btn-success">Terima Vendor</a>
        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModalVendor">
            Tolak Vendor
        </button>
        

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Catatan Ditolak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tolak_pengajuan', $pengajuan->id) }}" method="POST">
                            <div class="form-group">
                                @csrf
                                <label for="catatan">Catatan Penolakan</label>
                                <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10" required></textarea>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jangan Dong</button>
                        <button type="submit" class="btn btn-danger">Tolak Aja!!</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal vendor -->
        <div class="modal fade" id="exampleModalVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalVendorTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalVendorLongTitle">Catatan Ditolak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tolak_vendor', $pengajuan->id) }}" method="POST">
                            <div class="form-group">
                                @csrf
                                <label for="catatan">Catatan Penolakan</label>
                                <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10" required></textarea>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Are You Sure??</button>
                        <button type="submit" class="btn btn-danger">Tolak Aja!!</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        @if(Session::has('message'))
        <div class="alert alert-success mt-3 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5>
                <i class="icon fas fa-check"></i> Sukses!
            </h5>
            {{ Session('message')}}
        </div>
        @endif


        <div class="row mt-3">
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">tanggal_pengajuan</th>
                            <th>{{$pengajuan->tanggal_pengajuan}}</th>
                        </tr>
                        <tr>
                            <th scope="col">Grand Total</th>
                            <th>{{"Rp ".number_format($pengajuan->grand_total,2,',','.');}}</th>
                        </tr>
                        <tr>
                            <th scope="col">Status Pengajuan Ap</th>
                            <th>
                                @if($pengajuan->status_pengajuan_ap == 0)
                                <span class="badge badge-primary">Dibuat</span>
                                @elseif($pengajuan->status_pengajuan_ap == 1)
                                <span class="badge badge-success">Disetujui</span>
                                @else
                                <span class="bagde badge-danger">Ditolak</span>
                                @endif
                            </th>
                            </th>
                            <tr>
                            <th scope="col">keterangan ditolak ap</th>
                            <th>{{$pengajuan->keterangan_ditolak_ap}}</th>
                        </tr>
                        </tr>
                       
                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                    <th scope="col">Status Pengajuan Vendor</th>
                            <th>
                                @if($pengajuan->status_pengajuan_vendor == 0)
                                <span class="badge badge-primary">Dibuat</span>
                                @elseif($pengajuan->status_pengajuan_vendor == 1)
                                <span class="badge badge-success">Disetujui</span>
                                @else
                                <span class="bagde badge-danger">Ditolak</span>
                                @endif
                            </th>
                            <tr>
                           
                           <tr>
                           <th scope="col">Status ditolak vendor</th>
                           <th>{{ $pengajuan->status_ditolak_vendor}}</th>
                       </tr>
                       
                        <tr>
                            <th scope="col">Di buat oleh</th>
                            <th>{{ $pengajuan->created_by}}</th>

                        </tr>
                        <tr>
                            <th scope="col">Di buat pada</th>
                            <th>{{ $pengajuan->created_at}}</th>

                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <table class="table table-bordered table_striped">
            <thead>
                <tr>
                    <th>Nama Vendor</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Barang</th>
                    <th>Total Per Barang</th>

                </tr>
            </thead>
            <tbody>
                @foreach($detailPengajuan as $detail)
                <tr>
                    <td>{{ $detail->nama}}</td>
                    <td>{{ $detail->nama_barang}}</td>
                    <td>{{$detail->jumlah}} / {{$detail->satuan}}</td>
                    <td>{{"Rp ".number_format($detail->harga,2,',','.');}}</td>
                    <td>{{"Rp ".number_format($detail->total_per_barang,2,',','.');}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colpan="4">Total keseluruhan</th>
                    <th>{{"Rp ".number_format($pengajuan->grand_total,2,',','.');}}</td>
                </tr>
                </tr>
            </tbody>
        </table>
        <div class="card-footer">
            <a href="{{ route('pengajuan') }}" class="btn btn-info">Kembali</a>
        </div>


    </section>
</div>

@endsection