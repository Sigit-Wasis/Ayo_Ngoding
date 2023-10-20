<!DOCTYPE html>
<html>

<head>
    <title>Export Laporan Penjualan Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <table width="100%">
        <tr>
                <td width="100" align="center">
                <h3>ATK KOMO JAYA</h3>
                <p style="font-size: 13px;">Jln. endro suratmin RT/RW 005/002, Sukarame, Kec. Sukarame, Kota 
                    Bandar Lampung, Lampung
                    <i style="font-size: 13px;">Email: komojaya@gmail.com Website: http://komojaya.com</i>
                </p>
            </td>
        </tr>
    </table>
    <hr />
    <p>
    </strong> Tanggal Pengajuan: </strong> {{ $data[0]->tanggal_pengajuan }}</p>
    </strong> Nama Perusahaan: </strong> {{ $data[0]->nama_perusahaan }}</p>
    </strong> Dibuat Oleh: </strong> {{ $data[0]->dibuat_oleh }}</p>
</p>
    <table class="table table-bordered">
        <tr style="font-size: 12px; background-color: #e5e5e5;">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Total</th>
            
        </tr>
        <?php
            $no = 1;
        ?>
        @foreach ($data as $data)
        <tr style="font-size: 10px;">
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $no++ }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $data->nama_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $data->nama_jenis_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $data->jumlah }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ "Rp " .
                number_format($data->total_per_barang,2,',','.') }}</td>
        </tr>
        @endforeach
        <tr style="font-size: 10px;">
        <td style="padding-top: 2px; padding-bottom: 5px;" colspan="5">Grand Total</td>
        <td style="padding-top: 2px; padding-bottom: 5px; "

    </tr>
    </table>
</body>

</html>