@extends('backend.app')
@section('title','pengajuan')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
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
            <a href="{{ route('tambah_pengajuan') }}" class="btn btn-sm btn-block btn-success">Tambah Pengajuan</a>
</div>
<!--END BUTTON JENIS BARANG -->

        <div class="card">
            <div class="card-body">
             @if(Session::has('message'))   
            <div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
<h5>
    <i class="icon fas fa-check"></i> Sukses!
    <h5>
        {{ Session('message')}}
</div>
@endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">N0</th>
                            <th scope="col">Tanggal Pengajuan</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Pengajuan as $pengajuan)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $Pengajuan->firstItem() + $loop->index }}</td>
                            <td>{{ $pengajuan->tanggal_pengajuan }}</td>
                            <td>{{ "Rp ". number_format($pengajuan->grand_total,2,',','.'); }}</td>
                            <td>{{ $pengajuan->created_by }}</td>
                            <td>{{ $pengajuan->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>
                                <a href=" {{ route('show_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-primary">show</a>
                                <a href=" {{ route('edit_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href=" {{ route('delete_pengajuan', $pengajuan->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Hapus</a>
                            <td>

                            </tr>
                        <tr>
                    @endforeach
                    </tbody>
                    </table>

                    {{ $Pengajuan->links() }}
            </div>

    </div>
</section>
</div>


@endsection