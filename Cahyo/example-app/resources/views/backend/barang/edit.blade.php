@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Jenis Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Jenis Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN EDIT JENIS BARANG -->
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

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('update_barang', $editBarang->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="id_jenis_barang">Jenis Barang</label>
                        <select name="id_jenis_barang" class="form-control">
                            <option value="">--pilih jenis barang --</option>
                            @foreach ($jenisBarang as $jenis)
                            <option value="{{ $jenis->id }}" {{ $editBarang->id_jenis_barang == $jenis->id ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis_barang }}
                                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" value="{{ $editBarang->kode_barang }}" id="kode_barang" name="kode_barang" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $editBarang->nama_barang }}">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" value="{{ $editBarang->harga }}">
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $editBarang->satuan }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $editBarang->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input type="text" class="form-control" id="stok_barang" name="stok_barang" value="{{ $editBarang->stok_barang }}">
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <div class="form-group">
                        <img id="gambar-preview" src="{{ url($editBarang->gambar) }}" alt="Preview Gambar" width="150">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('barang') }}" class="btn btn-info">Kembali</a>
                    </div>
            </div>
            <script>
                function previewImage(event) {
                    var reader = new FileReader(); // Membuat objek FileReader
                    reader.onload = function() { // Saat proses membaca selesai
                        var imgElement = document.getElementById('gambar-preview'); // Dapatkan elemen gambar
                        imgElement.src = reader.result; // Atur sumber gambar sebagai hasil baca
                    };
                    reader.readAsDataURL(event.target.files[0]); // Baca file gambar yang dipilih
                }
            </script>
            </form>
    </section>
</div>

@endsection