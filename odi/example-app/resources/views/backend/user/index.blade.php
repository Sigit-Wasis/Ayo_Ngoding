@extends('backend.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_user') }}" class="btn btn-block btn-primary">Tambah Data</a>
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

                <table class="table table-responsive no-wap">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>

                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Nomor Telpon</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>

                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->nomor_telpon }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                <a href="{{ route('edit_user', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('delete_user', $user->id) }}"
                                    onclick="return confirm('Apa kamu yakin')" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </section>
</div>


@endsection