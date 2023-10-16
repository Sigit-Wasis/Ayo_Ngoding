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
        <a href="{{ route ('tambah_data_pengajuan') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Transaksi</a>
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
                            <th scope="col">tanggal_pengajuan</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Di Buat Oleh</th>
                            <th scope="col">Di Buat Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                     

                        @forelse($trBarang as $pengajuan)
                        <tr>
                        <td>{{$trBarang->firstItem() + $loop->index }}</td>
                        <td>{{$pengajuan->tanggal_pengajuan}}</td>
                        <td>{{"Rp ".number_format($pengajuan->grand_total,2,',','.');}}</td>
                         <td>{{$pengajuan->created_by}}</td>
                         <td>{{$pengajuan->created_at?? \Carbon\Carbon::now() }}</td>
                        
                            <td>{{$pengajuan->grand_total}}</td>
                            <td>
                                <a href="{{ route('show_data_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-info">Show</a>
                                <a href="{{ route('edit_data_pengajuan', $pengajuan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{route('delete_data_pengajuan',$pengajuan->id)}}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @empty
                        <!-- Tidak ada Transaksi pengajuan -->
                        @endforelse
                    </tbody>
                </table>

                @if($trBarang->isEmpty())
                <p class="text-center">Tidak Ada Transaksi pengajuan</p>
                @endif

                <div class="float-right">
                    {{ $trBarang->links() }}
                </div>

            </div>
        </div>
    </section>
</div>

@endsection