@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nama Jenis Barang</th>
                            <th>{{ $detailbarang->nama_jenis_barang }}</th>
                        </tr>
                        </tr>
                            <th scope="col">Kode Barang</th>
                            <th>{{ $detailbarang->kode_barang }}</th>
                        </tr>
                        </tr> 
                            <th scope="col">Nama Barang</th>
                            <th>{{ $detailbarang->nama_barang }}</th>
                        </tr>
                        </tr>  
                            <th scope="col">Harga</th>
                            <th>{{ "Rp".number_format($detailbarang->harga,2,',','.') }}</th>
                        </tr>
                        </tr>
                            <th scope="col">Satuan</th>
                            <th>{{ $detailbarang->satuan }}</th>
                        </tr>
                        </tr> 
                            <th scope="col">Deskripsi</th>
                            <th>{{ $detailbarang->deskripsi }}</th>
                        </tr>
                        </tr>    
                    </thead>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Gambar</th>
                            <th>
                                <img src="{{ url($detailbarang->gambar) }}" width="80" alt="">
                        </tr>
                        </tr>
                            <th scope="col">Stok Barang</th>
                            <th>{{ $detailbarang->stok_barang }}</th>
                        </tr>
                        </tr>
                            <th scope="col">Di Buat Pada</th>
                            <th>{{ $detailbarang->created_at ?? \Carbon\Carbon:: now() }}</th>
                        </tr>
                        </tr>
                            <th scope="col">Di Update Pada</th>
                            <th>{{ $detailbarang->updated_at ?? \Carbon\Carbon:: now() }}</th>
                        </tr>
                        </tr>  
                        <th scope="col">Di Buat Oleh</th>
                            <th>{{ $detailbarang->created_by  }}</th>
                        </tr>
                        </tr>   
                    </thead>
                </table>         
            </div>
            <a href="{{ route('barang') }}" class="btn btn-info">Kembali</a> 
        </div> 
    </section>
</div>

@endsection