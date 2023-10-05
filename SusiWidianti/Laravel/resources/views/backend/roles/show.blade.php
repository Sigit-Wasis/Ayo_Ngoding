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
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name Role</th>
                            <th>{{ $role->name}}</th>
                        </tr>
                        <tr>
                            <th scope="col">Permission</th>
                            <th>
                                @if(!empty($rolePermissions))
                                <ul>
                                    @foreach($rolePermissions as $v)
                                    <li>
                                        <span>{{$v->name }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

@endsection