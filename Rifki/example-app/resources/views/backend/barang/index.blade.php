@section('title', 'Data Barang')
@extends('backend.app')

@section('style')
<link rel="stylesheet" href="{{url('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<style>
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        height: 37px !important;
    }

    .select2-container--default .select2-selection--single {
        height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 35px !important;
    }
</style>

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <!-- BUTTON TAMBAH Data BARANG -->
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_barang') }}" class="btn btn-sm btn-block btn-success">Tambah Data Barang</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                    {{ Session('message') }}
                </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-3">
                        <form action="{{ route('barang.index')}}" method="get">
                            <label for="jenis_barang">Jenis Barang</label>
                            <select class="form-control select2" style="width: 100%;" name="jenis_barang">
                                <option value="">--Pilih--</option>
                                @foreach($jenisBarang as $jenis)
                                <option value="{{ $jenis->id}}">{{$jenis->nama_barang}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-3">
                        <label for="jenis_barang">Nama Barang</label>
                        <input type="text" class="form-control" name="jenis_barang">
                    </div>
                    <div class="col-md-3">
                        <label for="jenis_barang">Kode Barang</label>
                        <input type="text" class="form-control" name="jenis_barang">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" style="margin-top: 30px;">
                            <i class="fa fa-seacrh"></i>Cari Barang
                        </button>
                    </div>
                    </form>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Gambar</th>
                            <th scope="col">Stok Barang</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barangs as $barang)
                        <tr>
                            <td>{{ $barang->id }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->harga }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td>{{ $barang->deskripsi }}</td>
                            <td><img src="{{ $barang->gambar }}" alt="{{ $barang->nama_barang }}" width="50"></td>
                            <td>{{ $barang->stok_barang }}</td>
                            <td>
                                <a href="{{ route('Show_barang', $barang->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ route('delete_barang', $barang->id) }}" onclick="return confirm('Are you sure')" class="btn btn-sm btn-danger">Delete</a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">
                                Tidak Ada Data Barang
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $barangs->links() }}

            </div>
        </div>
    </section>
</div>
@endsection


@section('script')
<script src="{{url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2()
</script>
@endsection