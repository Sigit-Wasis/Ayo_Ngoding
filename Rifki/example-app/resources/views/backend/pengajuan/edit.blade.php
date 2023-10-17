@extends('backend.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Transaksi Pengajuan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Transaksi Pengajuan</li>
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

        <form method="POST" action="{{ route('update_pengajuan', $transaksiPengajuan->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group">
                    <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                    <input type="date" id="tanggal_pengajuan" class="form-control" name="tanggal_pengajuan" value="{{ $transaksiPengajuan->tanggal_pengajuan }}">
                </div>
                <div class="form-group">
                    <label for="id_vendor">Nama Vendor</label>
                    <select name="id_vendor" class="form-control" id="id_vendor" onchange="selectBarangByVendor(this.value)">
                        <option value="">-- pilih vendor --</option>
                        @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}" @if ($vendor->id == $transaksiPengajuan->id_vendor) selected @endif>{{ $vendor->nama }}</option>
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
                                    <button type="button" class="btn btn-sm btn-success" disabled id="dynamic-barang">Tambah</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiPengajuan->detailPengajuan as $key => $detail)
                            <tr>
                                <td>
                                    <select name="id_barang[{{ $key }}]" class="form-control" onchange="selectHargaDanStokBarang(this.value, {{ $key }})">
                                        <option value="" selected>-- pilih --</option>
                                        @foreach($barangs as $barang)
                                        <option value="{{ $barang->id }}" @if ($barang->id == $detail->id_barang) selected @endif>{{ $barang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="jumlah_barang[{{ $key }}]" class="form-control" id="jumlah_barang{{ $key }}" value="{{ $detail->jumlah }}" required>
                                </td>
                                <td>
                                    <input type="text" name="harga_barang[{{ $key }}]" class="form-control" id="harga_barang{{ $key }}" value="{{ $detail->harga_barang }}" readonly>
                                </td>
                                <td>
                                    <input type="text" name="stok_barang[{{ $key }}]" class="form-control" id="stok_barang{{ $key }}" value="{{ $detail->stok_barang }}" readonly>
                                </td>
                                <td>
                                    @if ($key === 0)
                                    <button type="button" class="btn btn-sm btn-success" id="dynamic-barang">Tambah</button>
                                    @else
                                    <button type="button" class="btn btn-sm btn-danger remove-input-field">Hapus</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <button type="submit" disabled id="ajukan" class="btn btn-primary">Ajukan</button>
                    <a href="{{ route('jenis_barang') }}" class="btn btn-info">Kembali</a>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@section('script')
<script>
    // ... (Kode JavaScript Anda tetap sama)
</script>
@endsection
