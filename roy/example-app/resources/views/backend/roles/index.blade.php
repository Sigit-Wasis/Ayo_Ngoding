@extends('backend.app')

@section('title','role')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-2 mb-2">
            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-block btn-success">Tambah Role</a>
</div>


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
                            <th scope="col">Nama role</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        </tr>
                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                            <td>{{ $roles->firstItem() + $loop->index }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->created_at }}</td>
                            <td>
                                <a href=" {{ route('roles.show', $role->id) }}" class="btn btn-sm btn-primary">Show</a>
                                <a href=" {{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href=" {{ route('roles.destroy', $role->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                            </tr>
                    @endforeach
                    </tbody>
                    </table>

                    {{ $roles->links() }}
            </div>

    </div>
</section>
</div>


@endsection