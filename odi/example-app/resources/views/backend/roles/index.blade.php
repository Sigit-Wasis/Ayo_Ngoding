@extends('backend.app')
@section('title','Role')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Roles</h1>
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
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Profile</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div class="card-body">
                                <div class="col-md-2 mb-2">
                                    <a href="{{ route('roles.create') }}" class="btn btn-block btn-primary">Tambah Role</a>
                                </div>     

                                @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <h5>
                                        <i class="icon fas fa-check"></i> Sukses!
                                    </h5>
                                    {{Session('message') }}
                                </div>
                                @endif

                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Role</th>
                                            <th scope="col">Di Buat Pada</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                        <tr>
                                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                                            <td>{{ $roles->firstItem() + $loop->index }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->created_at }}</td>
                                            <td>
                                                <div class="row">
                                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">Detail</a>
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary ml-2">Edit</a>
                                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                        {{ csrf_field() }}
                                                        {{method_field('DELETE') }}
                                                        <button onclick="return confirm ('Apa kamu yakin?')" type="submit"
                                                            class="btn ml-2 btn-sm btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $roles->links() }}
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                        
                                        <div class="card-body">
                                            <div class="col-md-3 mb-2">
                                                <a href="{{ route('permission.add') }}" class="btn btn-block btn-primary">Tambah permissions</a>
                                            </div>     
                                        
                                        @if(Session::has('message'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                            <h5>
                                                <i class="icon fas fa-check"></i> Sukses!
                                            </h5>
                                            {{Session('message') }}
                                        </div>
                                        @endif

                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nama Permission</th>
                                                    <!-- <th scope="col">Di Buat Pada</th> -->
                                                    <th scope="col">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($permissions as $permission)
                                                <tr>
                                                    <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                                                    <td>{{ $permissions->firstItem() + $loop->index }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                    <!-- <td>{{ $role->created_at }}</td> -->
                                                    <td>
                                                        <div class="row">
                                                            <!-- <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">Detail</a> -->
                                                            <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-primary ml-2">Edit</a>
                                                            <form method="GET" action="{{ route('permission.destroy', $permission->id) }}">
                                                                {{ csrf_field() }}
                                                                {{method_field('DELETE') }}
                                                                <button onclick="return confirm ('Apa kamu yakin?')" type="submit"
                                                                    class="btn ml-2 btn-sm btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $roles->links() }}
                                    </div>
                                </div>
                            </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection