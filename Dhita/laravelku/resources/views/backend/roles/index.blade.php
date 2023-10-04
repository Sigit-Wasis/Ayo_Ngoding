@extends('backend.app')
@section('title','User')
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
  <!-- BUTTON TAMBAH JENIS BARANG -->
  <div class="col-md-2 mb-2">
          <a href="{{ route('roles.create') }}" class="btn btn-sm btn-block btn-success">Tambah User</a>
    </div>
    <!-- END BUTTON TAMBAH JENIS BARANG -->

  <thead>

    <section class="content">

        <div class="card">
            <div class="card-body">

              @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
             <h5>

              <i class="icon fas fa-check"></i> Sukses!!</h5>
              
             {{ (Session('message')) }}
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


    @foreach($roles as $role)
    <tr>
      <!-- <th scope="row">{{ $loop->iteration}}</th> -->
      <td>{{ $roles->firstItem() + $loop->index }}</td>
      <td>{{ $role->name}}</td>
      <td>{{ $role->created_at }}</td>
    <td>
    <!-- <a href=" "class="btn btn-sm btn-primary">Edit</a> -->
    <a href="{{ route('roles.show',$role->id) }}" class="btn btn-sm btn-info">Show</a>
    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-sm btn-primary">Edit</a>
    <a href="{{ route('roles.destroy',$role->id) }}" onclick="return confirm('Apakah Kamu Ingin Menghapus ini?')" class="btn btn-sm btn-danger">Hapus</a>
    </td>

    </tr>


    @endforeach
  </tbody>
</table>
        {{$roles->links() }}
            </div>
        </div>
    </section>
</div>

@endsection
