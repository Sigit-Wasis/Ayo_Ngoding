@extends('backend.app')
@section('title', 'Data User')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User</h1>
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
            <a href="{{ route('tambah_user') }}" class="btn btn-sm btn-block btn-success">Tambah User</a>
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

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $user->name }}</td>
                                <!-- <td>{{Auth::user()->roles->pluck('name') [0] ?? ''}}</td> -->
                                <td>
                                @foreach ($user->roles as $role)
                                <span class="badge badge-primary"> {{ $role->name}} </span>
                                @endforeach
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('edit_user', $user->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('delete_user', ['id' => $user->id]) }}" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Delete</a>

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

