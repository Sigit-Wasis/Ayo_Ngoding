@extends('backend.app')
@section('title','Pengajuan')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_pengajuan') }}" class="btn btn-block btn-primary">Tambah Data</a>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{Session('message') }}
                </div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col"> Grand Total</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Pengajuans as $pengajuan)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $Pengajuans->firstItem() + $loop->index }}</td>
                            <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                            <td>{{ "Rp " . number_format($pengajuan->grand_total,0,',','.'); }}</td>
                            <td>{{ $pengajuan->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>{{ $pengajuan->created_by }}</td>
                            <td>
                                <a href="{{ route('show_pengajuan', $pengajuan->id) }}"
                                    class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ route('edit_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('delete_pengajuan', $pengajuan->id) }}"
                                    onclick="return confirm('Apa kamu yakin')" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center">
                                Tidak Ada Barang
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $Pengajuans->render() }}
            </div>
        </div>
    </section>
</div>


@endsection