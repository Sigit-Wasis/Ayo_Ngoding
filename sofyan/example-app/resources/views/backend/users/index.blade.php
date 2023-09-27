@extends('backend.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>USERS</h1>
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
    
    <div class="card-footer clearfix">
        <a href="{{route('tambah-user')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Tambah User</a>
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

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">name</th>
                            <th scope="col">Username</th>
                            <th scope="col">email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         {{-- Calculate the row number --}}
                        @php
                            $rowNumber = ($userS->currentPage() - 1) * $userS->perPage() + 1;
                        @endphp

                        @foreach($userS as $user)
                        <tr>
                            <td scope="row">{{ $rowNumber++ }}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                             
                               <a href="" class="btn btn-sm btn-primary">Edit</a>
                        
                               
                                <a href="" onclick="return confirm('are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="float-right">
                {{ $userS->links() }}
                </div>
                
            </div>
        </div>
        
    </section>
</div>

@endsection