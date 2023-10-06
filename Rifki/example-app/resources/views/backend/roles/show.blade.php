@extends('backend.app')

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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <tbody>
                        <tr>
                            <th scope="row">Nama Role</th>
                            <td>{{ $role->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Permission</th>
                            <td>
                                @if(!empty($rolePermissions))
                                <ul>
                                    @foreach($rolePermissions as $v)
                                    <li>{{ $v->name }}</li>
                                    @endforeach
                                </ul>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{ route('roles.index') }}" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </section>
</div>

@endsection
