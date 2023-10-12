@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Pengajuan Barang</a></li>
                        <li class="breadcrumb-item active">Transaksi Pengajuan Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTEN TAMBAH DATA BARANG -->
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

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Transaksi Pengajuan Barang</h3>
            </div>

            <form method="POST" action="{{ route('store_pengajuan') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <img id="image-preview" src="" alt="Gambar Barang" class="img-thumbnail" style="width: 150px; display: none;">
                            </div>

                            <!-- Kolom Kiri -->
                            <div class="form-group">
                                <label for="Tanggal">Tanggal</label>
                                <input type="date" class="form-control" value="{{ old('Tanggal') }}" id="Tanggal" name="tanggal_pengajuan" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="vendor">Nama Vendor</label>
                                <select class="form-control" id="vendor" name="vendor_id">
                                    <option value="" disabled selected>Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="form-control" value="{{ old('jumlah') }}" id="jumlah" name="jumlah" placeholder="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Kolom Kanan -->
                            <div class="form-group">
                                <label for="barang">Nama Barang</label>
                                <select class="form-control" id="barang" name="barang_id">
                                    <option value="" disabled selected>Pilih Barang</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" class="form-control" id="harga" name="harga" readonly>
                            </div>

                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" class="form-control" id="stok" name="stok" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Akhir Kolom Kiri dan Kanan -->

                    <!-- Tambahkan elemen input lainnya sesuai kebutuhan -->
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan Data Barang</button>
                    <a href="{{ route('data_barang') }}" class="btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Memuat jQuery dari sumber eksternal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var selectedVendor = '';
        var harga = '';
        var stok = '';
        var image = ''; // Tambahkan variabel untuk URL gambar

        $('#vendor').change(function() {
            selectedVendor = $(this).val();
            var barangSelect = $('#barang');

            barangSelect.empty();
            barangSelect.append($('<option>', {
                value: '',
                text: 'Pilih Barang'
            }));

            if (selectedVendor) {
                var barangPerVendor = @json($barangPerVendor);

                $.each(barangPerVendor[selectedVendor], function(key, value) {
                    barangSelect.append($('<option>', {
                        value: value.id,
                        text: value.nama_barang
                    }));
                });
            }
        });

        $('#barang').change(function() {
            var selectedBarang = $(this).val();
            if (selectedBarang && selectedVendor) {
                var barangTerpilih = @json($dataHargaSatuan);
                if (selectedBarang in barangTerpilih[selectedVendor]) {
                    harga = barangTerpilih[selectedVendor][selectedBarang].harga;
                    stok = barangTerpilih[selectedVendor][selectedBarang].stok;
                    image = barangTerpilih[selectedVendor][selectedBarang].image; // Mengambil URL gambar

                    // Tampilkan gambar
                    if (image) {
                        $('#image-preview').attr('src', window.location.origin + '/assets/dist/img/' + image);
                        $('#image-preview').show();
                    } else {
                        $('#image-preview').attr('src', '');
                        $('#image-preview').hide();
                    }

                    console.log('Nilai stok:', stok);
                    $('#harga').val(harga);
                    $('#stok').val(stok);
                } else {
                    console.error('Barang yang dipilih tidak ditemukan.');
                }
            } else {
                $('#harga').val('');
                $('#stok').val('');
                $('#image-preview').attr('src', ''); // Menghapus URL gambar saat tidak ada barang yang dipilih
                $('#image-preview').hide();
            }
        });
    });
</script>

@endsection