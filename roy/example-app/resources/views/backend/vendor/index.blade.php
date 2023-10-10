@extends('backend.app')
@section('title','vendor')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_vendor') }}" class="btn btn-sm btn-block btn-success">Tambah Vendor</a>
</div>
<!--END BUTTON JENIS BARANG -->

        <div class="card">
            <div class="card-body">
             @if(Session::has('message'))   
            <div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
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
                            <th scope="col">Nama Perusahaan</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nomor Telpon</th>
                            <th scope="col">Kepemilikan</th>
                            <th scope="col">Tahun Berdiri</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendor as $vendor)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $vendor->firstItem() + $loop->index }}</td>
                            <td>{{ $vendor->nama_perusahaan }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->nomor_telpon }}</td>
                            <td>{{ $vendor->kepemilikan }}</td>
                            <td>{{ $vendor->tahun_berdiri }}</td>
                            <td>{{ $vendor->created_at ?? \Carbon\Carbon::now() }}</td>
                            <td>{{ $vendor->created_by }}</td>
                            <td>
                                <a href=" {{ route('edit_vendor', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href=" {{ route('delete_vendor', $vendor->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Hapus</a>
                            <td>

                            </tr>
                        <tr>
                    @endforeach
                    </tbody>
                    </table>

                    {{ $vendor->links() }}
            </div>

    </div>
</section>
</div>


@endsection