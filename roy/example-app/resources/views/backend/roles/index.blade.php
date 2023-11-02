@extends('backend.app')

@section('title','role')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role & Permission</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role & Permission</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        

        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Role</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Permission</a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card-body">
                                <div class="col-md-2 mb-2">
            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-block btn-success">Tambah Role</a>
        </div>
                                
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
                                                <div class="row">
                                                <a href=" {{ route('roles.show', $role->id) }}" class="btn btn-sm btn-primary">Show</a>
                                                <a href=" {{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-danger">Delete</button>
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
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="card-body">
                            <div class="col-md-2 mb-2">
                                    <a href="{{ route('add.permission') }}" class="btn btn-sm btn-block btn-success">Tambah Permission</a>
                                    
                                </div>
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
                                                <th scope="col">Nama Permission</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissions as $permission)
                                            </tr>
                                            <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                                            <td>{{ $permissions->firstItem() + $loop->index }}</td>
                                            <td>{{ $permission->name }}</td>
                                           
                                            <td>
                                                <div class="row">
                                              
                                                <a href=" {{ route('permission.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form method="POST" action="{{ route('permission.destroy', $permission->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                                </div>
                                            </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $permissions->links() }}
                                </div>
                            </div>
            
                        </div>
                    </div>

                    <div class="card">

                    </div>
    </section>
</div>


@endsection