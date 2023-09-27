@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <!-- ... (your existing code) ... -->
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <!-- ... (your existing code) ... -->
                </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">username</th>
                            <th scope="col">nama_lengkap</th>
                            <th scope="col">email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('edit_jenis_barang', $user->id) }}" class="btn btn-sm btn-primary">edit</a>
                                <a href="{{ route('delete_jenis_barang', $user->id) }}" onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Delete</a>
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
