<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan ATK</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <table width="100%">
        <tr>
         
            <td width="100" align="center">
                <h3>ATK Group</h3>
                <p style="font-size: 13px;">Jln. M.Kholil RT/RW 001/001, Sukanegeri Jaya, Kec. Talang Padang, Kabupaten
                    Tanggamus, Lampung </br>

                    <i style="font-size: 13px;"> Email: BrotherGroup@gmail.com - Website: http://BrotherGroup.com</i>
                </p>
            </td>
        </tr>
    </table>
    <hr />
    <p>
        <strong> Pengajuan : </strong> {{ $data[0]->tanggal_pengajuan }}</br>
        <strong> Nama Perusahaan : </strong> {{ $data[0]->nama_perusahaan }}</br>
        <strong> Dibuat Oleh : </strong> {{ $data[0]->dibuat_oleh }}
    </p>
    <table class="table table-bordered">
        <tr style="font-size: 12px; background-color: #e5e5e5;">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Barang</th>
            <th>Total</th>
            <!-- <th>Total Bayar</th> -->
        </tr>
        <?php
            $no = 1;
        ?>
        @foreach ($data as $Data)
        <tr style="font-size: 10px;">
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $no++ }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $Data->nama_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $Data->nama_jenis_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $Data->jumlah }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ "Rp " .
                number_format($Data->harga,0,',','.') }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ "Rp " .
                number_format($Data->total_per_barang,0,',','.') }}</td>
        </tr>
        @endforeach
        <tr style="font-size: 10px;">
            <th style="padding-top: 2px; padding-bottom: 5px;" colspan="5"> Total Keseluruhan </th>
            <td style="padding-top: 2px; padding-bottom: 5px; font-weight: bold;">
            {{ "Rp " .number_format($Data->grand_total,0,',','.') }}</td>
        </tr>
    </table>
</body>

</html>
