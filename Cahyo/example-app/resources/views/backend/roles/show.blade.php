@extends('backend.app')

@section('title', 'Detail Barang')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Role</a></li>
                        <li class="breadcrumb-item active">Detail Role</li>
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
                            <th scope="col">Nama Role</th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <th scope="col">Permission</th>
                            <td>
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                    <li> 
                                        <span> {{ $v->name }} </span>
                                    </li>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    </thead>
                </table>
                <a href="{{ route('roles.index') }}" class="btn btn-info">Kembali</a>
            </div>
        </div>
    </section>
</div>

@endsection