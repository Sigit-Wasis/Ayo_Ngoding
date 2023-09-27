@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Tambah User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH JENIS USER -->
    <section class="content">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('store_user') }}">
        @csrf
<div class="card-body">
<div class="form-group">
<label for="name">name</label>
<input type="text" class="form-control" id="name" name="name" placeholder="">
</div>
<div class="form-group">
<label for="user name">user name</label>
<input type="text" class="form-control" id="user name" name="user name" placeholder="">
</div>
<div class="form-group">
<label for="email">email</label>
<input type="text" class="form-control" id="email" name="email" placeholder="">
</div>

<div class="card-footer">
<button type="submit" class="btn btn-primary">Simpan User</button>
<a href="{{ route('user') }}" class="btn btn-info">Kembali</a>

</div>
</form>

</section>
</div>

@endsection