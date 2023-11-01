@extends('backend.app')
@section('title','Barang')

@section('style')
<link rel="stylesheet" href="{{ url('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

<style> 
  .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single { 
    height: 38.2.5px !important; 
  } 
 
  .select2-container--default .select2-selection--single { 
    height: 38.3px !important; 
  } 
 
  .select2-container--default .select2-selection--single .select2-selection__arrow { 
    height: 35px !important; 
  } 
</style>

@endsection

@section('content')


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Barang</h1>
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
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_barang') }}" class="btn btn-block btn-primary">Tambah Data</a>
        
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" style="margin-top: 10px;">
            Import
            </button>
        
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('import.barang') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-body">
                        <input type="file" name="file_barang" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-check"></i> Sukses!
                    </h5>
                    {{Session('message') }}
                </div>
                @endif
    
        <form action="{{ route('barang') }}" method="get">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="jenis_barang">Jenis Barang</label>
                    <select class="form-control select2" style="width: 100%;" name="jenis_barang`">
                        <option value="">-- Pilih --</option> 
                            @foreach($jenisBarang as $jenis) 
                                <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_barang }}</option> 
                            @endforeach
                    </select>
                </div>
                <div class="col-md-9">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang">
                </div>
                <div class="col-md-3">
                    <label for="kode_barang">Kode Barang</label>
                    <input type="text" class="form-control" name="kode_barang">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px;">
                    <i class="fa fa-search"> </i>  Cari Barang
                    </button>
                </div>
            </div>
        </form>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Jenis Barang</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($Barang as $barang)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $Barang->firstItem() + $loop->index }}</td>
                            <td>{{ $barang->nama_jenis_barang }}</td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->created_by }}</td>
                            <td>
                                <a href="{{ route('show_barang', $barang->id) }}"
                                    class="btn btn-sm btn-primary">Detail</a>
                                <a href="{{ route('edit_barang', $barang->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ route('delete_barang', $barang->id) }}"
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
                {{ $Barang->links() }}
            </div>
        </div>
    </section>
</div>

@endsection

@section('script')
<script src="{{ url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $('.select2').select2()
</script>
@endsection