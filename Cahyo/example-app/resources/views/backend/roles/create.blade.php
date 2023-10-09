@extends('backend.app')

@section('title', 'Tambah Role')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Role</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Role</a></li>
                        <li class="breadcrumb-item active">Tambah Role</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH JENIS BARANG -->
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

        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nama Role</label>
                    <input type="text" class="form-control" value="{{ old('name')}}" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="permission">Permission</label>
                    <div class="selectgroup selectgroup-pills">
                        @foreach($permission as $value)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $value->id }}">
                            <label>
                                {{ $value->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer">
            <div class="form-group">
                <label>Pilih Semua Izin</label>
                <div class="form-check">
                    <input type="checkbox" id="select-all-permissions">
                    <label for="select-all-permissions">Pilih Semua</label>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('roles.index') }}" class="btn btn-info">Kembali</a>
            </div>        
        </div>
    </form>
<script>
    // Event listener untuk tombol "Pilih Semua Izin"
    document.getElementById('select-all-permissions').addEventListener('change', function() {
        let permissions = document.querySelectorAll('input[name="permission[]"]');
        for (let i = 0; i < permissions.length; i++) {
            permissions[i].checked = this.checked;
        }
    });
</script>

</div>
</section>
</div>

@endsection