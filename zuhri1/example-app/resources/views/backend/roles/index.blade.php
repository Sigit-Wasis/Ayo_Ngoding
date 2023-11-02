@extends('backend.app')

@section ('title','My User')

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
                        <li class="breadcrumb-item active">users</li>
                    </ol>
                </div>
            </div>
        </div>

    </section>

    <section class="content">
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
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <!-- BUTTON TAMBAH Role -->
                            <div class="col-md-2 mb-2">
                                <a href="{{ route('roles.create') }}" class="btn btn-sm btn-block btn-success">Tambah Role</a>
                            </div>
                            <!-- END BUTTON TAMBAH User -->

                            @if(Session::has('message'))

                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5>
                                    <i class="icon fas fa-check"></i> Sukses
                                </h5>

                                {{ Session('message')}}

                            </div>

                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Role</th>
                                        <th scope="col">Dibuat pada</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>

                                    @foreach($roles as $role)
                                    <tr>
                                        <!--<th scope="row">{{$loop->iteration }}</th>-->
                                        <th>{{$roles->firstItem() +$loop->index }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->created_at }}</td>
                                        <td>

                                            <div class="row">
                                                <a href="{{route('roles.show',$role->id)}}" class="btn btn-sm btn-info">Show</a>
                                                <a href=" {{route('roles.edit',$role->id)}}" class="btn btn-sm btn-primary">edit</a>
                                                <form method="POST" action="{{route('roles.destroy',$role->id) }}">
                                                    {{csrf_field() }}
                                                    {{method_field ('DELETE') }}
                                                    <button onclick="return confirm('Are You sure?')" type="submit" class="btn btn-sa btn-danger">DELETE</button>
                                                </form>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>

                            {{ $roles->links() }}
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <!-- BUTTON TAMBAH Role -->
                            <div class="col-md-2 mb-2">
                                <a href="{{ route('add.permission') }}" class="btn btn-sm btn-block btn-success">Tambah Permission</a>
                            </div>
                            <!-- END BUTTON TAMBAH User -->

                            @if(Session::has('message'))

                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5>
                                    <i class="icon fas fa-check"></i> Sukses
                                </h5>

                                {{ Session('message')}}

                            </div>

                            @endif

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama permission</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>

                                    @foreach($permissions as $permission)
                                    <tr>
                                        <!--<th scope="row">{{$loop->iteration }}</th>-->
                                        <th>{{$permissions->firstItem() +$loop->index }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>

                                            <div class="row">
                                                <a href=" {{route('permission.edit',$permission->id)}}" class="btn btn-sm btn-primary">edit</a>
                                                <form method="GET" action="{{route('permission.destroy',$permission->id) }}">
                                                    {{csrf_field() }}
                                                    {{method_field ('DELETE') }}
                                                    <button onclick="return confirm('Are You sure?')" type="submit" class="btn btn-sa btn-danger">DELETE</button>
                                                </form>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>


                            <div class="pull-right">
                                {{ $permissions->links() }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </section>

</div>

@endsection