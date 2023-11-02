@extends('backend.app')
@section('title','Data Role')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <!-- ... (your existing code) ... -->
    </section>

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
                    <section class="content">

                        <div class="card">
                            <div class="card-body">

                                <!--BUTTON TAMBAH User-->
                                <div class="col-md-2 mb-2">
                                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-block btn-success"> Tambah Role</a>
                                </div>
                                <!-- END BUTTON TAMBAH JENIS BARANG-->

                                @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5>
                                        <i class="icon fas fa-check"></i> Sukses!
                                    </h5>
                                    {{ (Session('message')) }}
                                </div>
                                @endif

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Role</th>
                                            <th scope="col">Dibuat Pada</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                        <tr>

                                            <td>{{ $roles->firstItem() + $loop->index }}</td>
                                            <td>{{ $role->name}}</td>
                                            <td>{{ $role->created_at}} </td>
                                            <td>
                                                <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-primary">show</a>
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary ">edit</a>
                                                <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button onclick="return confirm('Are You Sure?')" type="submit" class="btn  btn-sm btn-danger">Delete</button>
                                                </form>
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
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <section class="content">

                        <!--BUTTON TAMBAH User-->
                        <div class="col-md-2 mb-2">
                            <a href="{{ route('add.permission') }}" class="btn btn-sm btn-block btn-success"> Tambah Permission</a>
                        </div>

                        <div class="card">
                            <div class="card-body">

                                @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5>
                                        <i class="icon fas fa-check"></i> Sukses!
                                    </h5>
                                    {{ (Session('message')) }}
                                </div>
                                @endif

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Permission</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                        <tr>
                                            <td>{{ $permissions->firstItem() + $loop->index }}</td>
                                            <td>{{ $permission->name}}</td>
                                            <td>
                                                <div class="row">
                                                    <a href="{{ route('edit.permission', $permission->id) }}" class="btn btn-sm btn-primary ml-2">edit</a>
                                                    <form method="GET" action="{{ route('destroy.permission', $permission->id) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button onclick="return confirm('Are You Sure?')" type="submit" class="btn ml-2 btn-sm btn-danger">Delete</button>
                                                    </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $permissions->links() }}

                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>

</div>

</div>
@endsection