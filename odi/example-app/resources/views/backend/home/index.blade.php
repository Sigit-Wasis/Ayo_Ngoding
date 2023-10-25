@extends('backend.app')
@section('title','Home')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Beranda</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div id="container"></div>
    </section>
</div>
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    selectHargaDanStokBarang()

    function selectHargaDanStokBarang() {
        $.ajax({
            type: 'GET',
            url: window.location.origin + '/char',
            dataType: 'json',
            success: function(response) {
                var pengajuanData = response;

                // Membuat array bulan dalam format nama
                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                // Inisialisasi data pengajuan untuk semua bulan dalam setahun dengan nilai awal 0
                var data = Array.from({
                    length: 12
                }, () => 0);

                // Mengisi data transaksi yang sesuai
                for (var i = 0; i < pengajuanData.length; i++) {
                    data[pengajuanData[i].month - 1] = pengajuanData[i].count;
                }

                Highcharts.chart('container', {
                    chart: {
                        type: 'column' // Jenis grafik batang
                    },
                    title: {
                        text: 'Pengajuan Barang per Bulan'
                    },
                    subtitle: {
                        text: 'Source: Your Source Here'
                    },
                    xAxis: {
                        categories: months,
                    },
                    yAxis: {
                        title: {
                            text: 'Jumlah Pengajuan Barang'
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    plotOptions: {
                        column: { // Menggunakan tipe grafik batang
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Jumlah Pengajuan',
                        data: data
                    }],
                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }]
                    }
                });
            }
        });
    }
</script>
@endsection

