@extends('backend.app')
@section('title','Pengajuan')
@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!--kontek tambah jenis barang -->

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
                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" class="form-control" id="tanggal_pengajuan" value="<?php echo date('Y-m-d')?>"
                        name="tanggal_pengajuan">
                </div>
                <div class="form-group">
                    <label for="id_vendor">Nama Vendor</label>
                    <select name="id_vendor" class="form-control" onchange="selectBarangByVendor(this.value)">
                        <option value="">*** pilih vendor ***
                        </option>
                        @foreach ($vendors as $vendor)
                        <option value=" {{ $vendor->id}}">{{ $vendor->nama_perusahaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <select name="nama_barang" class="form-control" onchange="selectHargaDanStokBarang(this.value)"
                        id="nama_barang" readonly></select>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="harga">Harga Barang</label>
                            <input type="text" class="form-control" readonly id="harga" name="harga">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="stok">Stok Barang</label>
                            <input type="text" class="form-control" readonly id="stok" name="stok">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ajukan</button>
                <a href="{{ route('pengajuan') }}" class="btn btn-info">Kembali</a>
            </div>
        </form>
    </section>
</div>
@endsection

@section('script') <script>
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
                htmlBarang += '<option selected disabled> -- pilih barang -- </option>';
                for (let i = 0; i < textStatus.length; i++) {
                    htmlBarang += '<option value="' + textStatus[i].id +
                        '">' + textStatus[i].nama_barang + '</option>'
                }
                $('#nama_barang').attr('readonly', false);
                $('#nama_barang').html(htmlBarang);
            } else {
                $('#nama_barang').html('<option selected disabled> -- data tidak ditemukan -- </option>');
            }
        }
    });
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
            $('#stok').val(textStatus.stok);
            $('#harga').val(textStatus.harga);
        }
    });
}
</script>
@endsection