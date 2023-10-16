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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pengajuan Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--KONTEN TAMBAH Data BARANG -->
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
        <form method="POST" action="{{ route('pengajuan_barang') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" id="tanggal_pengajuan" class="form-control" value="<?php echo date('Y-m-d') ?>" name="tanggal_pengajuan">
                </div>
                <div class="form-group">
                    <label for="id_vendor">Nama vendor</label>
                    <select name="id_vendor" class="form-control" onchange="selectBarangByVendor(this.value)">
                        <option value="">-- pilih vendor--</option>
                        @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->nama_perusahaan}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="450">Nama Barang</th>
                                <th>Harga Stok</th>
                                <th>Stok Barang</th>
                                <th width="80">
                                    <button class="btn btn-sm btn-success" id="dynamic-barang">Tambah</button>
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="id_barang[0]" class="form-control" id="id_barang" onchange="selecteHargaDanStokBarang(this.value)">
                                        <option value="" selected>-- pilih --</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="harga[0]" class="form-control" id="harga" readonly>
                                </td>
                                <td>
                                    <input type="text" name="stok[0]" class="form-control" id="stok" readonly>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <select name="nama_barang" id="nama_barang" onchange="selecteHargaDanStokBarang(this.value)" class="form-control" readonly>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_barang">Harga Barang</label>
                            <input type="text" class="form-control" readonly id="harga_barang" name="harga_barang">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok_barang">Stok Barang</label>
                            <input type="text" class="form-control" readonly id="stok_barang" name="stok_barang">
                        </div> -->
            </div>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary">Ajukan</button>
    <a href="{{ route('pengajuan_barang')}}" class="btn btn-info">kembali</a>
</div>
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
                    htmlBarang += '<option selected disabled> --pilih --</option>';
                    for (let i = 0; i < textStatus.length; i++) {
                        htmlBarang += '<option value="' + textStatus[i].id + '">' + textStatus[i].nama_barang + '</option>';
                    }
                    $('#id_barang').attr('readonly', false);
                    $('#id_barang').html(htmlBarang);

                } else {
                    $('#id_barang').html('<option selected disabled> -- data tidak ditemukan -- </option>');
                }
            }

        });
    }

    function selecteHargaDanStokBarang(id_barang) {
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


    var i = 0;
    $('#dynamic-barang').click(function() {
        ++i;

        //get data barang
        $.ajax({
            url: "{{ route('pengajuan-barang') }}",
            type: 'GET',
            success: function(data) {
                var htmlSelect = '';
                $.each(data, function(key, val) {
                    htmlSelect += '<option value="' + val.id + '">' + val.nama_barang + '</option>';
                });
                $('#id_produk' + i + '').append(htmlSelect);
            }
        });

     var htmlForm ='';
     
     htmlForm +='<tr>';
     htmlForm +='<td>';
     htmlForm +='<select name="id_barang[0]" class="form-control" id="id_barang" onchange="selecteHargaDanStokBarang(this.value)">';
     htmlForm +='<option value="" selected>-- pilih --</option>';
     htmlForm +='</select>';
     htmlForm +='</td>';
     htmlForm +='</tr>';

     $('#dynamicAddForm').append(htmlForm)
});
</script>
@endsection
