@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Transaction Details</div>

                    <div class="card-body">
                        <strong>ID:</strong> {{ $transaksi_pengajuan->id }}<br>
                        <strong>Tanggal Pengajuan:</strong> {{ $transaksi_pengajuan->tanggal_pengajuan }}<br>
                        <strong>Grand Total:</strong> {{ $transaksi_pengajuan->grand_total }}<br>
                        <strong>Status Pengajuan AP:</strong> {{ $transaksi_pengajuan->status_pengajuan_ap }}<br>
                        <strong>Keterangan Ditolak AP:</strong> {{ $transaksi_pengajuan->keterangan_ditolak_ap }}<br>
                        <strong>Status Pengajuan Vendor:</strong> {{ $transaksi_pengajuan->status_pengajuan_vendor }}<br>
                        <strong>Keterangan Ditolak Vendor:</strong> {{ $transaksi_pengajuan->keterangan_ditolak_vendor }}<br>
                        <strong>Created At:</strong> {{ $transaksi_pengajuan->created_at }}<br>
                        <strong>Updated At:</strong> {{ $transaksi_pengajuan->updated_at }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
