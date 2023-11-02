    @extends('backend.app')
    @section('title', 'Data Barang')
    @section('style')
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
    <link rel="stylesheet" href="{{ url('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    @endsection

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
                            <li class="breadcrumb-item active">data barang</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <div class="card-footer clearfix">

            @can('data_barang-create')
            <a href="{{ route ('tambah-barang') }}" class="btn btn-primary float-left"><i class="fas fa-plus"></i> Tambah Barang</a>
            @endcan
            <button style="margin-left: 5px" class="btn btn-info float-info" data-toggle="modal" data-target="#inportBarang" class="fas fa-plus"><i class="fas fa-upload"></i> Import Barang </button>
        </div>

        <!-- Modal for Keterangan Import Excel -->
        <div class="modal fade" id="inportBarang" tabindex="-1" role="dialog" aria-labelledby="keteranganModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="keteranganModalLabel">Inport Data Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="post" action="{{ route('spreadsheet') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="col-md-12">
                                <input type="file" class="form-control" name="inportBarang" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal Import</button>
                            <button type="submit" class="btn btn-info">Import</button>
                        </div>

                    </form>



                </div>
            </div>
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


                    @if(Session::has('error'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>
                            <i class="icon fas fa-check"></i> Error!
                        </h5>
                        {{ Session('error')}}
                    </div>
                    @endif



                    <form action="{{route('data_barang')}}" mthode="get">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="jenis_barang">Jenis Barang</label>
                                <select class="form-control select2" style="width: 100%;" name="jenis_barang">
                                    <option value="">-- pilih --</option>
                                    @foreach($searchBarang as $jenis)
                                    <option value="{{$jenis->id}}">{{$jenis->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label type="text" for="nama_barang">Nama Barang</label>
                                <input class="form-control" name="nama_barang">
                            </div>
                            <div class="col-md-3">
                                <label type="text" for="kode_barang">Kode Barang</label>
                                <input class="form-control" name="kode_barang">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">
                                    <i class="fa fa-search"></i> Cari Barang
                                </button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">NO</th>
                                <th scope="col">Jenis Barang</th>
                                <th scope="col">Kode Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Calculate the row number --}}
                            @php
                            $rowNumber = ($dataBarang->currentPage() - 1) * $dataBarang->perPage() + 1;
                            @endphp

                            @forelse($dataBarang as $data)
                            <tr>
                                <td scope="row">{{ $rowNumber++ }}</td>
                                <td>{{$data->jenis}}</td>
                                <td>{{$data->kode_barang}}</td>
                                <td>{{$data->nama_barang}}</td>
                                <td>
                                    @can('data_barang-detail')
                                    <a href="{{ route('detail_barang', $data->id) }}" class="btn btn-sm btn-info">Show</a>
                                    @endcan
                                    @can('data_barang-edit')
                                    <a href="{{ route('edit_barang', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @endcan
                                    @can('data_barang-delete')
                                    <a href="{{route('delete_barang',$data->id)}}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <!-- Tidak ada data barang -->
                            @endforelse
                        </tbody>
                    </table>

                    @if($dataBarang->isEmpty())
                    <p class="text-center">Tidak Ada Data Barang</p>
                    @endif

                    <div class="float-right">
                        {{ $dataBarang->links() }}
                    </div>

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