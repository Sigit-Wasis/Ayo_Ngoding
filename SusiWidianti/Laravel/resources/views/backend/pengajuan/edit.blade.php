@extends('backend.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Transaksi Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Transaksi Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

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

        <form method="POST" action="{{ route('update_data_pengajuan', $editPengajuan->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" id="tanggal_pengajuan" class="form-control" value="<?php echo date('Y-m-d') ?>" name="tanggal_pengajuan">
                </div>
                <div class="form-group">
                    <label for="id_vendor">Nama Vendor</label>
                    <select name="id_vendor" class="form-control" id="id_vendor" onchange="selectBarangByVendor(this.value)" id="id_vendor">
                        <option value="">-- pilih vendor --</option>
                        @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ $vendor->id == $editPengajuan->id_vendor ? 'selected' : ''}}>{{ $vendor->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <table class="table table-bordered" id="dynamicAddForm">
                        <thead>
                            <tr>
                                <th width="450">Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Harga Barang</th>
                                <th>Stok Barang</th>
                                <th width="80">
                                    <button type="button" class="btn btn-sm btn-success" id="dynamic-barang">Tambah</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailBarang as $key => $barang)
                            <input type="hidden" name="id_detail_barang[{{$key}}]" value="{{ $barang->id_detail_pengajuan }}">
                            <tr>
                                <td>
                                    <select name="id_barang[{{ $key }}]" class="form-control" onchange="selectHargaDanStokBarang(this.value)" id="id_barang">
                                        @foreach($barangs as $brg)
                                        <option value="{{ $brg->id }}" {{ $brg->id == $barang->id_barang ? 'selected' : ''}}>{{$brg->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="jumlah_barang[{{$key}}]" class="form-control" id="jumlah_barang" value="{{$barang->jumlah}}" required>
                                </td>
                                <td>
                                    <input type="text" name="harga_barang[{{$key}}]" class="form-control" id="harga_barang" value="{{$barang->harga}}" readonly>
                                </td>
                                <td>
                                    <input type="text" name="stok_barang[{{$key}}]" class="form-control" id="stok_barang" value="{{$barang->Stok}}" readonly>
                                </td>

                                <td width="130x">
                                    <a href="{{route('delete_barang_pengajuan', [$barang->id_detail_pengajuan, $editPengajuan->id]) }}"
                                    onclick="return confirm('Are You Sure?')" class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


                <div class="card-footer">
                    <button type="submit" id="ajukan" class="btn btn-primary">Ajukan</button>
                    <a href="{{ route('jenis_barang') }}" class="btn btn-info">Kembali</a>
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
            url: window.location.origin + '/data_pengajuan/barang',
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
                    $('#id_barang').attr('readonly', false);
                    $('#id_barang').html(htmlBarang);
                } else {
                    $('#id_barang').html('<option selected disabled> -- data tidak ditemukan -- </option>');
                }
            }
        });
    }

    function selectHargaDanStokBarang(id_barang, katBarang) {
        $.ajax({
            type: 'GET',
            url: window.location.origin + '/harga/stok/barang',
            dataType: 'json',
            data: {
                "id_barang": id_barang
            },
            success: function(textStatus) {
                if (katBarang > 0 && katBarang != undefined) {
                    $('#stok_barang' + katBarang + '').val(textStatus.Stok);
                    $('#harga_barang' + katBarang + '').val(textStatus.harga);
                } else {
                    $('#stok_barang').val(textStatus.Stok);
                    $('#harga_barang').val(textStatus.harga);
                }

                $('#ajukan').prop("disabled", false);
                $('#dynamic-barang').prop("disabled", false);
            }
        });
    }



    var i = 0;
    $('#dynamic-barang').click(function() {
        ++i;

        // get data barang 
        $.ajax({
            url: "{{ route('pengajuan_barang') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                "id_vendor": $('#id_vendor').val(),
            },
            success: function(data) {
                console.log(data)
                var htmlSelect = '';
                $.each(data, function(key, val) {
                    htmlSelect += '<option value="' + val.id + '">' + val.nama_barang + '</option>';
                });

                $('#id_barang' + i + '').append(htmlSelect);
            }
        });

        var htmlForm = '';

        htmlForm += '<tr>';
        htmlForm += '<td>';
        htmlForm += '<select name="id_barang[' + i + ']" id="id_barang' + i + '" class="form-control" onchange="selectHargaDanStokBarang(this.value, ' + i + ')">';
        htmlForm += '<option value="" selected>-- pilih --</option>';
        htmlForm += '</select>';
        htmlForm += '</td>';

        htmlForm += '<td>';
        htmlForm += '<input type="number" name="jumlah_barang[' + i + ']" class="form-control" id="jumlah_barang' + i + '" required>';
        htmlForm += '</td>';

        htmlForm += '<td>';
        htmlForm += '<input type="text" name="harga_barang[' + i + ']" class="form-control" id="harga_barang' + i + '" readonly>';
        htmlForm += '</td>';

        htmlForm += '<td>';
        htmlForm += '<input type="text" name="stok_barang[' + i + ']" class="form-control" id="stok_barang' + i + '" readonly>';
        htmlForm += '</td>';

        htmlForm += '<td>';
        htmlForm += '<button class="btn btn-sm btn-danger remove-input-field">Hapus</button>';
        htmlForm += '</td>';
        htmlForm += '</tr>';

        $('#dynamicAddForm').append(htmlForm)
    });

    $(document).on('click', '.remove-input-field', function() {
        $(this).parents('tr').remove();
    });
</script>
@endsection