@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Peangajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Detail Peangajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Nama Role </th>
                            <th>{{ $role->name }}</th>
                        </tr>
                        <tr>
                            <th scope="col">Permission </th>
                            <th>
                                @if(!empty($rolePermissions))
                                <ul>
                                @foreach($rolePermissions as $v)
                                <li>
                                <span>{{ $v->name }}</span>
                                </li>
                                @endforeach
                                </ul>
                                @endif
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <a href="{{ route('roles.index')}}" class="btn btn-info">kembali</a>
            </div>
        </div>
    </section>
</div>
@endsection