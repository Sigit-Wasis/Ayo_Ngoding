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
                <h3>ATK SAYA PUNYA</h3>
                <p style="font-size: 13px;">Jln. Sukamenanti RT/RW 005/002, Sukakamu, Kec. Kurangbahagia, Kabupaten
                    Harapan, Kurang Pasti<br>
                    <i style="font-size: 13px;"> Email: atkcahaya@gmail.com Website: http://atkcahaya.com</i>
                </p>
            </td>
        </tr>
    </table>
    <hr />

    <P style="font-size: 12px;">
        <strong> Pengajuan : </strong> {{ $data[0]->tanggal_pengajuan }}</br>
        <strong> Nama Perusahaan : </strong> {{ $data[0]->nama }}</br>
        <strong> Dibuat Oleh : </strong> {{ $data[0]->dibuat_oleh }}
    </p>

    <table class="table table-bordered">
        <tr style="font-size: 12px; background-color: #e5e5e5;">
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>satuan</th>
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
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $laporan->jumlah }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ $laporan->satuan }}</td>
            <td style="padding-top: 2px; padding-bottom: 5px;">{{ "Rp " .
                number_format($laporan->total_per_barang,2,',','.') }}</td>
        </tr>
        @endforeach
        <tr style="font-size: 10px;">
                <td style="padding-top: 2px; padding-bottom: 5px;" colspan="5">Grand Total</td>
                <td style="padding-top: 2px; padding-bottom: 5px; font-weight: bold;">
                {{ "Rp " . number_format($laporan->grand_total,2,',','.') }}
            </td>
    </tr>
    </table>
</body>

</html>