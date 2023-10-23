<!DOCTYPE html>
<html>

<head>
    <title>Export Laporan Penjualan ATK</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <table width="100%">
        <tr>
         
            <td width="100" align="center">
                <h3>Laporan Pembelian ATK di PT Kita's</h3>
                <p style="font-size: 13px;">Jln. Ahmad Yani RT/RW 004/010, Sukamulya, Kec. Karangharapan, Kabupaten
                    Bandung, Jawa Barat <br>
                    <i style="font-size: 13px;">Email: dhitahumdana@gmail.com Website: http://dhitastore.com</i>
                </p>
            </td>
        </tr>
    </table>
    <hr />
    <p>
        <strong> Pengajuan       : </strong> {{$data[0]->tanggal_pengajuan}}</br>
        <strong> Nama Perusahaan : </strong> {{$data[0]->nama}}</br>
        <strong> Di buat Oleh     : </strong> {{$data[0]->dibuat_oleh}}</br>
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
        @foreach ($data as $laporan)
        <tr style="font-size: 10px;">
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $no++ }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $laporan->nama_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $laporan->nama_jenis_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $laporan->jumlah}}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ "Rp " .
                number_format($laporan->total_per_barang,2,',','.') }}</td>
        </tr>
        @endforeach
        <tr style="font-size: 10px;">
            <td style="padding-top: 2px; padding-bottom: 5px; font-weight: bold;" colspan="4">Grand Total</td>
            <td style="padding-top: 2px; padding-bottom: 5px; font-weight: bold;"> 
            {{ "Rp" . number_format($laporan->grand_total,2,',','.') }}
        </td>
        </tr>
    </table>
</body>

</html>