<!DOCTYPE html>
<html>

<head>
    <title> ExsportLaporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <table width="100%">
        <tr>

            <td width="100" align="center">
                <h3>ATK</h3>
                <p style="font-size: 13px;">Jln. Duren RT/RW 005/003, Margorejo, Kec. Semendawai Suku III, Kabupaten
                    Oku Timur, Sumatera Selatan
                    <i style="font-size: 13px;">Email: aminazuhri@gmail.com Website: http://jehaclinic.com</i>
                </p>
            </td>
        </tr>
    </table>
    <hr />

<p>
    <strong> Pengajuan:</strong> {{ $data[0]->tanggal_pengajuan }} </br>
    <strong> Nama Perusahaan:</strong> {{ $data[0]->nama_perusahaan }} </br>
    <strong> Dibuat Oleh:</strong> {{ $data[0]->dibuat_oleh}}

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
            <th colspan="4">Total keseluruhan</th>
            <th>{{"Rp" . number_format($data->grand_total, 2,',','.')}}</th>

        </tr>
    </table>
</body>

</html>