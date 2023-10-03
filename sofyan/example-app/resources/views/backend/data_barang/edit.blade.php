@extends('backend.app')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('data_barang') }}">Data Barang</a></li>
                        <li class="breadcrumb-item active">Edit Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('update_barang', $editBarang->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="jenis_barang">Jenis Barang</label>
                        <select class="form-control" id="jenis_barang" name="jenis_barang">
                            <option value="" disabled>Pilih Jenis Barang</option>
                            @foreach ($jenisBarang as $jenis)
                            <option value="{{ $jenis->id }}" {{ $editBarang->Id_jenis_barang == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" class="form-control" value="{{ old('nama_barang', $editBarang->nama_barang) }}" id="nama_barang" name="nama_barang" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ $editBarang->kode_barang }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" value="{{ old('harga', $editBarang->harga) }}" id="harga" name="harga" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan', $editBarang->satuan) }}" id="satuan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" value="{{ old('deskripsi', $editBarang->deskripsi) }}" id="deskripsi" name="deskripsi" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="stok">Jumlah Stok</label>
                        <input type="number" class="form-control" value="{{ old('stok', $editBarang->stok) }}" id="stok" name="stok" placeholder="Masukkan jumlah stok" min="0" step="1" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>

                    <div class="form-group">
                        @if(!empty($editBarang->image))
                        <img id="image-preview" src="{{ asset('assets/dist/img/' . $editBarang->image) }}" alt="{{ $editBarang->nama_barang }}" class="img-thumbnail" style="width: 150px;">
                        @else
                        <div class="text-center py-4">No Image</div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-info">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    // Ambil elemen input file
    var inputImage = document.getElementById('image');

    // Ambil elemen img pratinjau
    var imagePreview = document.getElementById('image-preview');

    // Tambahkan event listener untuk perubahan pada input file
    inputImage.addEventListener('change', function() {
        // Pastikan ada file yang dipilih
        if (inputImage.files && inputImage.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set src gambar pratinjau dengan data URL gambar yang dipilih
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Tampilkan gambar pratinjau
            }

            // Baca file gambar sebagai data URL
            reader.readAsDataURL(inputImage.files[0]);
        } else {
            // Kosongkan gambar pratinjau jika tidak ada file yang dipilih
            imagePreview.src = '#';
            imagePreview.style.display = 'none'; // Sembunyikan gambar pratinjau
        }
    });
</script>


@endsection