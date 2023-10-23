<!DOCTYPE html>
<html>

<head>
    <title>Export Laporan Penjualan Obat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <table width="100%">
        <tr>

            <td width="100" align="center">
                <h3>KLINIK KECANTIKAN JEHA MEDIKA</h3>
                <p style="font-size: 13px;">Jln. Sukamantri RT/RW 005/002, Sukaraya, Kec. Karangbahagia, Kabupaten
                    Bekasi, Jawa Barat <br>
                    <i style="font-size: 13px;">Email: jehamedika@gmail.com Website: http://jehaclinic.com</i>
                </p>
            </td>
        </tr>
    </table>
    <hr />
    <p style="font-size: 12px;">
        <strong> Tanggal Pengajuan : </strong>{{ $data[0]->tanggal_pengajuan}} </br>
        <strong> Nama Perusahaan : </strong>{{ $data[0]->nama_perusahaan}} </br>
        <strong> Di Buat Oleh : </strong>{{ $data[0]->dibuatoleh}} </br>
    </p>
    <table class=" table table-bordered">
        <tr style="font-size: 12px; background-color: #e5e5e5;">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Total Bayar</th>
        </tr>
        <?php
        $no = 1;
        ?>
        @foreach ($data as $lapor)
        <tr style="font-size: 10px;">
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $no++ }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $lapor->nama_barang }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $lapor->nama_jenis}}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $lapor->jumlah }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ "Rp " .
                number_format($lapor->total_per_barang,2,',','.') }}</td>
        </tr>
        @endforeach
        <tr style="font-size: 10px;">
            <th colspan="4">Total Keseluruhan</th>
            <th>{{ "Rp " . number_format($lapor->grand_total, 2, ',', '.') }}</th>
        </tr>
        </table>
</body>

</html>