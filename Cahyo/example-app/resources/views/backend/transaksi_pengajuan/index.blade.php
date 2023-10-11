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
            <a href="{{ route('tambah_pengajuan')}}" class="btn btn-sm btn-block btn-success">Tambah Transaksi Pengajuan</a>
        </div>

        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{ Session('message')}}
                </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">User</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Total Pengajuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                        @php
                        $rowNumber = ($transaksiPengajuan->currentPage() - 1) * $transaksiPengajuan->perPage() + 1;
                        @endphp

                        @forelse($transaksiPengajuan as $transaksi)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$transaksi->created_by}}</td>
                            <td>{{$transaksi->tanggal_pengajuan}}</td>
                            <td>{{$transaksi->total}}</td>
                            <td>
                                <a href="{{ route('detail_barang', $pengajuan->id) }}" class="btn btn-sm btn-info">Show</a>
                                <a href="{{ route('edit_barang', $pengajuan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{route('delete_barang',$pengajuan->id)}}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <!-- Tidak ada Transaksi pengajuan -->
                        @endforelse
                    </tbody>
                </table>

                @if($transaksiPengajuan->isEmpty())
                <p class="text-center">Tidak Ada Transaksi pengajuan</p>
                @endif

                <div class="float-right">
                    {{ $transaksiPengajuan->links() }}
                </div>

            </div>
        </div>
    </section>
</div>

@endsection