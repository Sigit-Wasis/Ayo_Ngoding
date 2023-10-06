@extends('backend.app')
@section('title','users')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <!-- ... (your existing code) ... -->
    </section>

    <section class="content">
        <!--BUTTON TAMBAH User-->
        <div class="col-md-2 mb-2">
            <a href="{{ route('tambah_users') }}" class="btn btn-sm btn-block btn-success"> Tambah User</a>
        </div>
        <!-- END BUTTON TAMBAH JENIS BARANG-->

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
                            <th scope="col">username</th>
                            <th>Role</th>
                            <th scope="col">nama_lengkap</th>
                            <th scope="col">email</th>
                            <th scope="col">alamat</th>
                            <th scope="col">nomor_telepon</th>
                            <th scope="col">Update Pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @foreach($user->roles as $role)
                            <span class="badge badge-primary"> {{$role->name}}</span>
                                @endforeach
                            </td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->alamat }}</td>
                            <td>{{ $user->nomor_telepon }}</td>
                            <td>{{ $user->created_at ?? \Carbon\Carbon::now()}}</td>
                            <td>
                                <a href="{{ route('edit_users', $user->id) }}" class="btn btn-sm btn-primary">edit</a>
                                <a href="{{ route('delete_users', $user->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}

            </div>
        </div>
    </section>
</div>
@endsection