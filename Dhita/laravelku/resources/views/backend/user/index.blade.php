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
          <a href="{{ route('tambah_user') }}" class="btn btn-sm btn-block btn-success">Tambah User</a>
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
      <th scope="col">Nama Lengkap</th>
      <th scope="col">Alamat</th>
      <th scope="col">No Telephone</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Update pada</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>


    @foreach($users as $user)
    <tr>
      <!-- <th scope="row">{{ $loop->iteration}}</th> -->
      <td>{{ $users->firstItem() + $loop->index }}</td>
      <td>{{ $user->nama_lengkap }}</td>
      <td>{{ $user->alamat }}</td>
      <td>{{ $user->no_telephone }}</td>
      <td>{{ $user->username }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->created_at ?? \Carbon\Carbon::now() }}</td>
    

    <td>
    <!-- <a href=" "class="btn btn-sm btn-primary">Edit</a> -->
    <a href="{{ route('edit_user',$user->id) }}" class="btn btn-sm btn-primary">Edit</a>
    <a href="{{ route('delete_user',$user->id) }}" onclick="return confirm('Apakah Kamu Ingin Menghapus ini?')" class="btn btn-sm btn-danger">Hapus</a>
    </td>

    </tr>


    @endforeach
  </tbody>
</table>
        {{$users->links() }}
            </div>
        </div>
    </section>
</div>

@endsection