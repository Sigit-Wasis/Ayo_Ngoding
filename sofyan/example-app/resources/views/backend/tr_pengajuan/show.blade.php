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
                        <li class="breadcrumb-item"><a href="{{ route('pengajuan') }}">Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-body">
        <section class="content">

            <td>
                @can('approve_ap')
                <a href="{{ route('terima_pengajuan',$pengajuan->id) }}" class="btn btn-sm btn-success">Terima</a>
                @endcan
            </td>
            @can('tolak_ap')
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#keteranganModal">Tolak</button>
            @endcan
            <!-- Modal for Keterangan Penolakan pengajuan-->
            <div class="modal fade" id="keteranganModal" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="keteranganModalLabel">Keterangan Penolakan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('tolak_pengajuan', ['id' => $pengajuan->id]) }}">
                            @csrf
                            <div class="modal-body">
                                <textarea name="catatan" id="catatan" class="form-control" rows="5" placeholder="Alasan Penolakan" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <td>
                @can('approve_vendor')
                <a href="{{ route('terima_vendor',$pengajuan->id) }}" class="btn btn-sm btn-success">Terima Vendor</a>
                @endcan
            </td>
            @can('tolak_vendor')
            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#keteranganModalVendor">Tolak Vendor</button>
            @endcan
            <!-- Modal for Keterangan Penolakan vendor -->
            <div class="modal fade" id="keteranganModalVendor" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="keteranganModalLabel">Keterangan Penolakan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('tolak_vendor', ['id' => $pengajuan->id]) }}">
                            @csrf
                            <div class="modal-body">
                                <textarea name="catatanVendor" id="catatanVendor" class="form-control" rows="5" placeholder="Alasan Penolakan" required></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal Tolak</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(Session::has('message'))
            <div class=" alert alert-success mt-3 alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5>
                    <i class="icon fas fa-check"></i> Sukses!
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




            <div class="row mt-3">
                <div class="col-md-6">
                    <table class="table">
                        <tbody>

                            <tr>
                                <th scope="row">Dibuat pada</th>
                                <td>{{ $pengajuan->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Diperbarui oleh</th>
                                <td>{{ $pengajuan->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Diperbarui pada</th>
                                <td>{{ $pengajuan->updated_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Pengajuan</th>
                                <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total</th>
                                <td>{{ "Rp " . number_format($pengajuan->grand_total, 2, ',', '.') }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tbody>


                            <tr>
                                <th scope="row">Keterangan Pengajuan AP </th>
                                <td>
                                    @if (!empty($pengajuan->keterangan_ditolak_ap))
                                    <ul>
                                        @foreach(json_decode($pengajuan->keterangan_ditolak_ap) as $catatan)
                                        <li>{{ $catatan }}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    Tidak ada catatan penolakan.
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Keterangan Pengajuan Vendor</th>
                                <td>
                                    @if (!empty($pengajuan->keterangan_ditolak_vendor))
                                    <ul>
                                        @foreach(json_decode($pengajuan->keterangan_ditolak_vendor) as $catatans)
                                        <li>{{ $catatans }}</li>
                                        @endforeach
                                    </ul>
                                    @else
                                    Tidak ada catatan penolakan dari vendor.
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Status Pengajuan AP</th>
                                <td>
                                    @if ($pengajuan->status_pengajuan_ap == 0)
                                    <span class="badge badge-primary">Dibuat</span>
                                    @elseif ($pengajuan->status_pengajuan_ap == 1)
                                    <span class="badge badge-success">Disetujui</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status Pengajuan Vendor</th>
                                <td>
                                    @if ($pengajuan-> status_pengajuan_vendor == 0)
                                    <span class="badge badge-primary">Dibuat</span>
                                    @elseif ($pengajuan-> status_pengajuan_vendor == 1)
                                    <span class="badge badge-success">Disetujui</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Dibuat oleh</th>
                                <td>{{ $pengajuan->name }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Perusahaan</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Barang</th>
                            <th>Harga Barang</th>
                            <th>Total Per Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detailPengajuan as $detail)
                        <tr>
                            <td>
                                @if(!empty($detail->image))
                                <img src="{{ asset('assets/dist/img/' . $detail->image) }}" alt="{{ $detail->nama_barang }}" class="img-thumbnail" style="width: 70px;">
                                @else
                                <div class="text-center py-4">No Image</div>
                                @endif
                            </td>
                            <td>{{ $detail->nama }}</td>
                            <td>{{ $detail->nama_barang }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>{{ "Rp " . number_format($detail->harga, 2, ',', '.') . " / " . $detail->satuan }}</td>
                            <td>{{ "Rp " . number_format($detail->total_per_barang, 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <th colspan="5">Total Keseluruhan</th>
                            <th>{{ "Rp " . number_format($pengajuan->grand_total, 2, ',', '.') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <td><a href="{{ route('pengajuan') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Transaksi</a></td>
        </section>
    </div>
</div>

@endsection