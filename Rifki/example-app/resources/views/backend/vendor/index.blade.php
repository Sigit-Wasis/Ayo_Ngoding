@extends('backend.app')

@section('title', 'Daftar Vendor')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Vendor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('vendor.index') }}">Vendor</a></li>
                        <li class="breadcrumb-item active">Daftar Vendor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Daftar Vendor -->
    <section class="content">
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Vendor</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Kepemilikan</th>
                            <th>Tahun Berdiri</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $vendor->nama }}</td>
                            <td>{{ $vendor->alamat }}</td>
                            <td>{{ $vendor->telphone }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->kepemilikan }}</td>
                            <td>{{ $vendor->tahun_berdiri }}</td>
                            <td>
                                <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus vendor ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('vendor.create') }}" class="btn btn-success">Tambah Vendor</a>
            </div>
        </div>
    </section>
</div>
@endsection
