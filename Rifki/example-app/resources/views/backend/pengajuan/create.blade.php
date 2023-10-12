@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Pengajuan<h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Pengajuan</li>
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


        <form method="POST" action="{{ route('store_pengajuan') }}">
            @csrf
            <div class="card-body">
            <div class="form-group">
                    <label for="name">Tanggal Pengajuan</label>
                    <input type="date" id="tanggal_pengajuan"  class="form-control" value="<?php echo date('Y-m-d')?>" name="tanggal_pengajuan">
                </div>
                <div class="form-group">
                    <label for="id_vendor">Nama Vendor</label>
                    <select name="id_vendor" class="form-control" onchange="selectBarangByVendor(this.value)">
                        <option value="">--pilih Vendor --</option>
                        @foreach($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{ $vendor->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nama Barang</label>
                    <select name="nama_barang" id="nama_barang" onchange="selectHargaDanStokBarang(this.value)" class="form-control" readonly>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Harga Barang</label>
                            <input type="text" readonly id="harga_barang" class="form-control" name="harga_barang">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Stok Barang</label>
                            <input type="text" readonly id="stok_barang" class="form-control" name="stok_barang">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                        <a href="{{ route('user') }}" class="btn btn-info">Kembali</a>
                    </div>
        </form>
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
                    htmlBarang += '<option selected disable> --pilih--</option>';
                    for (let i = 0; i < textStatus.length; i++) {
                        htmlBarang += '<option value="' + textStatus[i].id + '">' + textStatus[i].nama_barang + '</option>';
                    }
                    $('#nama_barang').html(htmlBarang);
                } else {
                    $('#nama_barang').html('<option selected disabled> -- data tidak ditemukan -- </option>');
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
                $('#harga_barang').val(textStatus.harga);
            }
        })
    }
</script>
@endsection