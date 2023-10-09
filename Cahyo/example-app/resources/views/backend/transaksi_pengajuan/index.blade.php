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
                        <li class="breadcrumb-item"><a href="#">Transaksi Pengajuan</a></li>
                        <li class="breadcrumb-item active">Transaksi Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_jenis_barang')}}" class="btn btn-sm btn-block btn-success">Tambah Transaksi Pengajuan </a>
        </div>

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
                            <th>Tanggal Pengajuan</th>
                            <th>Grand Total</th>
                            <th>Status Pengajuan AP</th>
                            <th>Keterangan Ditolak AP</th>
                            <th>Status Pengajuan Vendor</th>
                            <th>Keterangan Ditolak Vendor</th>
                            <th>Dibuat Oleh</th>
                            <th>Diperbarui Oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi_pengajuan as $index => $transaksi)
                        <tr>
                            <td>{{ $transaksi_pengajuan->tanggal_pengajuan }}</td>
                            <td>{{ $transaksi_pengajuan->grand_total }}</td>
                            <td>{{ $transaksi_pengajuan->status_pengajuan_ap }}</td>
                            <td>{{ $transaksi_pengajuan->keterangan_ditolak_ap }}</td>
                            <td>{{ $transaksi_pengajuan->status_pengajuan_vendor }}</td>
                            <td>{{ $transaksi_pengajuan->keterangan_ditolak_vendor }}</td>
                            <td>{{ $transaksi_pengajuan->created_by }}</td>
                            <td>{{ $transaksi_pengajuan->updated_by }}</td>
                        </tr>
                        <a href="{{ route('jenis_barang.edit', ['id' => $jenis->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                        <a href="{{ route('delete_jenis_barang', $jenis->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $transaksi_pengajuan->links() }}
            </div>
        </div>
    </section>
</div>

@endsection