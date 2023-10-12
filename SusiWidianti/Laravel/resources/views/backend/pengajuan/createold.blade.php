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

            <form method="POST" action="{{ route('store_data_pengajuan') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="Tanggal">Tanggal</label>
                        <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" id="tanggal_pengajuan" name="tanggal_pengajuan" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="vendor">Nama Vendor</label>
                        <select class="form-control" onchange="selectBarangByVendor(this.value)">
                            <option value="" disabled selected>Pilih Vendor</option>
                            @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="450">Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Stok Barang</th>
                                    <th width="80">
                                        <button class="btn btn-sm btn-success"  id="dynamic_barang">Tambah </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="id_barang[0]" class="form-control" onchange="selectHargaDanStokBarang(this.value)"  id="id_barang">
                                            <option value="" selected>--pilih--</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="harga_barang[0]" class="form-control" id="harga_barang" readonly>
                                    </td>
                                    <td>
                                        <input type="text" name="stok_barang[0]" class="form-control" id="stok_barang" readonly>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- <div class="form-group">
                        <label for="barang">Nama Barang</label>
                        <select  id="barang" name="nama_barang" onchange="selectHargaDanStokBarang(this.value)" class="form-control" readonly> 
                        </select>
                    </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                        <label for="barang">Harga Barang</label>
                        <input type="text"  class="form-control" readonly id="harga_barang" name="harga_barang">
                </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                        <label for="stok_barang">Stok Barang</label>
                        <input type="text"  class="form-control" readonly id="stok_barang" name="stok_barang">
                </div> -->
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"> Ajukan Barang</button>
                    <a href="{{ route('data_barang') }}" class="btn btn-info">Kembali</a>
                </div>
            </form>
        </div>
    </section>
</div>



@endsection

@section('script')
<script>
    function selectBarangByVendor(id_vendors) {
        $.ajax({
            type: 'GET',
            url: window.location.origin + '/data_pengajuan/barang',
            dataType: 'json',
            data: {
                "id_vendors": id_vendors
            },
            success: function(textStatus) {
                if (textStatus.length > 0) {
                    var htmlBarang = '';
                    htmlBarang += '<option selected disabled> --pilih-- </option>';
                    for (let i = 0; i < textStatus.length; i++) {
                        htmlBarang += '<option value="' + textStatus[i].id + '">' + textStatus[i].nama_barang + '</option>';
                    }
                    $('#id_barang').attr('readonly', false);
                    $('#id_barang').html(htmlBarang);
                } else {
                    $('#id_barang').html('<option selected disable> --data tidak ditemukan --</option>')

                }
            }

        });
    }

    function selectHargaDanStokBarang(id_barang) {
        $.ajax({
            type: 'GET',
            url: window.location.origin + '/harga/stok/barang',
            dataType: 'json',
            data: {
                "id_barang": id_barang
            },
            success: function(textStatus) {
                $('#stok_barang').val(textStatus.Stok);
                $('#harga_barang').val(textStatus.harga);
            }


        });
    }

    $('#dynamic_barang').click(function() {
        ++i;

        // get data barang
        $.ajax({
            url: "{{ route('pengajuan_barang') }}",
            type: 'GET',
            success: function(data) {
                var htmlSelect = '';
                $.each(data,function(key, val){ 
                    htmlSelect += '<option value="' + val.id + '">' + val.nama_barang + '</option>';

                });
                $('#id_produk' + i + '').append(htmlSelect);
            }

        });

        var htmlForm='';

        htmlForm += '<tr>';
        htmlForm += '</td>';
        htmlForm +='<select name="id_barang[0]" class="form-control" onchange="selectHargaDanStokBarang(this.value)"  id="id_barang">';
        htmlForm +='<option value="" selected>--pilih--</option>';
        htmlForm +='</select>';

        htmlForm += '</td>';
        htmlForm += '</tr>';

        $('#dynamicAddForm').append(htmlForm)
        
    });


</script>

@endsection