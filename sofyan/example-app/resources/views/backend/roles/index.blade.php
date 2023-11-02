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


    <div class="card card-primary card-tabs ml-2 mr-2">
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
                <div class="tab-pane fade show" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>
                            <i class="icon fas fa-check"></i> Sukses!
                        </h5>
                        {{ Session('success')}}
                    </div>
                    @endif
                    <div class="card-footer clearfix">
                        <a href="{{route('roles.create')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>Tambah Roles</a>
                    </div>

                    <section class="content">
                        <div class="card">
                            <div class="card-body">


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

                                                <div class="btn-group">
                                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-sm btn-info mr-1" data-toggle="tooltip" title="Show">Show</a>
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" title="Edit">Edit</a>
                                                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">Delete</button>
                                                    </form>
                                                </div>

                                            </td>
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
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    @if(Session::has('permission_message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>
                            <i class="icon fas fa-check"></i> Sukses!
                        </h5>
                        {{ Session('permission_message')}}
                    </div>
                    @endif
                    <div class="card-footer clearfix">
                        <a href="{{route('tambah-permission')}}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>Tambah Permission</a>
                    </div>

                    <section class="content">
                        <div class="card">
                            <div class="card-body">

                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">Nama Permission</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- Calculate the row number --}}
                                        @php
                                        $rowNumber = ($permission->currentPage() - 1) * $permission->perPage() + 1;
                                        @endphp

                                        @foreach($permission as $permisi)
                                        <tr>
                                            <td scope="row">{{ $rowNumber++ }}</td>
                                            <td>{{$permisi->created_by }}</td>

                                            <td>

                                                <div class="btn-group">
                                                    <a href="{{ route('edit_permission', $permisi->id) }}" class="btn btn-sm btn-primary mr-1" data-toggle="tooltip" title="Edit">Edit</a>
                                                    <form method="GET" action="{{ route('delete_permission', $permisi->id) }}" onsubmit="return confirm('Are you sure you want to delete this permission?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">Delete</button>
                                                    </form>
                                                </div>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="float-right">
                                    {{ $permission->links() }}
                                </div>

                            </div>
                        </div>

                    </section>

                </div>

            </div>
        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk mengatur tampilan tab saat tab di-klik
        $('#custom-tabs-one-tab a').on('click', function(e) {
            e.preventDefault(); // Mencegah default action

            // Menghilangkan kelas 'active' dari semua tab
            $('#custom-tabs-one-tab a').removeClass('active');

            // Menambahkan kelas 'active' hanya pada tab yang diklik
            $(this).addClass('active');

            // Menampilkan tab yang sesuai dengan tab yang diklik
            var target = $(this).attr('href');
            $('#custom-tabs-one-tabContent > div').removeClass('show active');
            $(target).addClass('show active');

            // Menyimpan tab yang terakhir kali dipilih ke localStorage
            localStorage.setItem('lastSelectedTab', target);
        });

        // Mengambil tab yang terakhir kali dipilih dari localStorage dan mengaktifkannya
        var lastSelectedTab = localStorage.getItem('lastSelectedTab');
        if (lastSelectedTab) {
            $('#custom-tabs-one-tab a[href="' + lastSelectedTab + '"]').tab('show');
            console.log(lastSelectedTab)
            $('' + lastSelectedTab + '-tab').click();
        }
        // var hash = window.location.hash;
        // if (hash === '' || hash === '#custom-tabs-one-home') {
        //     // Jika hash kosong atau sesuai dengan tab "Role", maka aktifkan tab "Role"
        //     $('#custom-tabs-one-tab a[href="#custom-tabs-one-home"]').tab('show');

        // } else if (hash === '#custom-tabs-one-profile') {
        //     // Jika hash sesuai dengan tab "Permission", maka aktifkan tab "Permission"
        //     $('#custom-tabs-one-tab a[href="#custom-tabs-one-profile"]').tab('show');
        //     $('#custom-tabs-one-profile-tab').click();
        // }
    });
</script>

@endsection