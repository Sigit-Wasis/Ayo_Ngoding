@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">roles</a></li>
                        <li class="breadcrumb-item active">detail Roles</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th scope="row">Nama Roles</th>
                        <td>{{ $role->name}}</td>
                    </tr>

                    <tr>
                        <th scope="row">permission</th>
                        <td>
                            @if (!empty($rolePermissions))
                                @foreach ($rolePermissions as $v)
                                <li>
                                    <span> {{ $v->name}}</span>
                                </li>
                                @endforeach
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <a href="{{ route('roles.index') }}" class="btn btn-info mt-3">Kembali ke Roles</a>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>


</div>
@endsection