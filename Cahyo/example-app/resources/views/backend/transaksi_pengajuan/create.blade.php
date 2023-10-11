@extends('backend.app')

@section('title', 'Tambah Transaksi Pengajuan')

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

        <form method="POST" action="{{ route('store_pengajuan') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="Tanggal">Tanggal Pengajuan</label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="Tanggal" name="tanggal_pengajuan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="id_vendor">Nama Vendor</label>
                    <select name="id_vendor" class="form-control" onchange="selectBarangByVendor(this.value)">
                        <option value="" disabled selected>Pilih Vendor</option>
                        @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <select class="form-control" id="nama_barang" onchange="selectHargaDanStokBarang(this.value)" name="nama_barang_id" readonly>
                        <!-- From Ajax -->
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga">Harga Barang</label>
                            <input type="text" class="form-control" id="harga" name="harga" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok_barang">Stok Barang</label>
                            <input type="text" class="form-control" id="stok_barang" name="stok_barang" readonly>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Ajukan</button>
                    <a href="{{ route('transaksi_pengajuan') }}" class="btn btn-info">Kembali</a>
                </div>
        </form>
</div>
</section>
</div>

@endsection

@section('script')
<script>
    function selectBarangByVendor(id_vendor) {
        $.ajax({
            type: 'GET',
            url: window.location.origin + '/pengajuan/barang',
            dataType: 'json',
            data: {
                "id_vendor": id_vendor
            },
            success: function(textStatus) {
                if (textStatus.length > 0) {
                    var htmlBarang = '';
                    htmlBarang += '<option selected disabled> -- pilih -- </option>';
                    for (let i = 0; i < textStatus.length; i++) {
                        htmlBarang += '<option value="' + textStatus[i].id + '">' + textStatus[i].nama_barang + '</option>';
                    }
                    $('#nama_barang').attr('readonly', false);
                    $('#nama_barang').html(htmlBarang);
                } else {
                    $('#nama_barang').html('<option selected disabled> -- data tidak ditemukan-- </option>');
                }
            }
        })
    }
    function selectHargaDanStokBarang(id_barang) {
        $.ajax({
            type: 'GET',
            url: window.location.origin + '/barang/harga/stok',
            dataType: 'json',
            data: {
                "id_barang": id_barang
            },
            success: function(textStatus) {
              $('#stok_barang').val(textStatus.stok_barang);
              $('#harga').val(textStatus.harga);
            }
        })
    }
</script>

@endsection