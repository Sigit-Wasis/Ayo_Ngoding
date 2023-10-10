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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class="card-footer clearfix">
        <a href="{{ route ('tambah_pengajuan') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Transaksi</a>
    </div>
    <section class="content">
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
                        $rowNumber = ($trPengajuan->currentPage() - 1) * $trPengajuan->perPage() + 1;
                        @endphp

                        @forelse($trPengajuan as $pengajuan)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$pengajuan->jenis_barang}}</td>
                            <td>{{$pengajuan->kode_barang}}</td>
                            <td>{{$pengajuan->nama_barang}}</td>
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

                @if($trPengajuan->isEmpty())
                <p class="text-center">Tidak Ada Transaksi pengajuan</p>
                @endif

                <div class="float-right">
                    {{ $trPengajuan->links() }}
                </div>

            </div>
        </div>
    </section>
</div>

@endsection