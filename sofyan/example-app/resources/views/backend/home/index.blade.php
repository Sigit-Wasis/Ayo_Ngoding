@extends('backend.app')
@section('title', 'Home')
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

        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$countDiterimaPengajuan}}<sup style="font-size: 20px"></sup></h3>
                        <p>Di Terima Pengajuan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>



            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $countDitolakPengajuan }}</h3>
                        <p>Ditolak pengajaun</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>


            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$countDiterimaVendor}}<sup style="font-size: 20px"></sup></h3>
                        <p>Di Terima vendor</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>



            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $countDitolakVendor }}</h3>
                        <p>Ditolak Vendor</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <section class="content">
                        <div id="container"></div>
                    </section>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
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

                // Create the column chart (Highcharts)
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

    $(document).ready(function() {
        $.ajax({
            url: "{{ route('charvendordonut') }}",
            method: 'GET',
            success: function(data) {
                // Data yang Anda ambil dari server berada dalam variabel 'data'
                var chartData = data;

                // Data yang Anda ambil dari server berada dalam variabel 'data'
                // var chartData = data;    

                // Ambil elemen canvas berdasarkan ID
                var donutChartCanvas = document.getElementById('donutChart').getContext('2d');

                // Proses data untuk digunakan oleh Chart.js
                // Proses data untuk digunakan oleh Chart.js
                var labels = chartData.map(function(item) {
                    return item.nama_vendor + ' (' + item.persentase_pemesanan + '%)';
                });

                var values = chartData.map(function(item) {
                    return item.persentase_pemesanan;
                });

                var donutData = {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }]
                };

                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                };

                // Buat chart donat dengan Chart.js
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                });
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    });
</script>
@endsection