@extends('backend.app')
@section('title', 'Roles')
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
            <a href="{{route('roles.create')}}" class="btn btn-sm btn-block btn-success"><i class="fas fa-plus"></i> Tambah Roles</a>
        </div>

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
                            <th scope="col">Nama Role</th>
                            <th scope="col">Dibuat Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Calculate the row number --}}
                        @php
                        $rowNumber = ($roles->currentPage() - 1) * $roles->perPage() + 1;
                        @endphp

                        @foreach($roles as $role)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->created_at}}</td>
                            <td>

                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info">show</a>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ route('roles.destroy',  $role->id) }}" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="float-right">
                    {{ $roles->links() }}
                </div>

            </div>
        </div>

    </section>
</div>

@endsection