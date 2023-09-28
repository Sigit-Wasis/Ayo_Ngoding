@extends('backend.app')

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
            <li class="breadcrumb-item active">users</li>
              </ol>
                </div>
                  </div>
                    </div>

</section>

       <section class="content">
 <!-- BUTTON TAMBAH User -->
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_user') }}" class="btn btn-sm btn-block btn-primary">Tambah User</a>
    </div>

<!-- END BUTTON TAMBAH User -->

            <div class="card">
            <div class="card-body">
            <div class="card-body">

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
      <th scope="col">name</th>
      <th scope="col">username</th>
      <th scope="col">email</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
<?php $i =1; ?>

    @foreach($users as $user)
    <tr>
      <!--<th scope="row">{{$loop->iteration }}</th>-->
      <th>{{$users->firstItem() +$loop->index }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->username }}</td>
      <td>{{ $user->email}}</td>
    <td>

    <a href="{{route('edit_jenis_barang',$user->id)}}"oncklick="return confirm('you sure?')" class="btn btn-sm btn-danger">Edit</a>
    <a href=" {{route('delete_jenis_barang',$user->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
</td>
</tr>

    @endforeach

  </tbody>
</table>

{{ $users->render() }}

  </div>

    </div>


    </section>

      </div>

@endsection
