@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tr_pengajuan') }}">Transaksi</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card">
        <div class="card-header">
            Detail Transaksi
        </div>
        <div class="card-body">
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#keteranganModal">
                Terima
            </button>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#keteranganModal">
                Tolak
            </button>

            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Status Pengajuan</th>
                        <td>
                            @if ($transaction->status_pengajuan_ap == 0)
                            <a href="{{ route('approve_transaction', ['id' => $transaction->id]) }}" class="btn btn-success">Approve</a>
                            <a href="{{ route('reject_transaction', ['id' => $transaction->id]) }}" class="btn btn-danger">Reject</a>
                            @else
                            Disetujui
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Nomor Transaksi</th>
                        <td>
                            {{ $transaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tanggal Pengajuan</th>
                        <td>
                            {{ $transaction->tanggal_pengajuan }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Perusahaan</th>
                        <td>
                            {{ $transaction->vendor_nama }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Nama Barang</th>
                        <td>
                            {{ $transaction->nama_barang }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Jumlah</th>
                        <td>
                            {{ $transaction->jumlah }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Harga per Satuan</th>
                        <td>
                            {{ "Rp " . number_format($transaction->harga, 2, ',', '.') . " / " . $transaction->satuan }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Total</th>
                        <td>
                            {{ "Rp " . number_format($transaction->total_per_barang, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Keterangan Pengajuan</th>
                        <td>
                            @if ($transaction->keterangan_ditolak_ap)
                            <button data-toggle="modal" data-target="#keteranganModal" class="btn btn-danger">Lihat Keterangan Penolakan</button>
                            @else
                            Tidak Ada Keterangan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Dibuat oleh</th>
                        <td>
                            {{ $transaction->created_by }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Dibuat pada</th>
                        <td>
                            {{ $transaction->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Diperbarui oleh</th>
                        <td>
                            {{ $transaction->updated_by }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Diperbarui pada</th>
                        <td>
                            {{ $transaction->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <td><a href="{{ route('tr_pengajuan') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Transaksi</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



</div>
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
            <form method="post" action="{{ route('tr_pengajuan', ['id' => $transaction->id]) }}">
                @csrf
                <div class="modal-body">
                    <textarea name="rejection_reason" class="form-control" rows="5" placeholder="Alasan Penolakan"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection