<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url() ?>/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/blockui/jquery.blockUI.js"></script>
<script src="<?= base_url() ?>/assets/plugins/flot/jquery.flot.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/flot/jquery.flot.symbol.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script>
    $(document).ready(function() {
        var options = {
            series: [{
                name: 'Total Transaksi',
                data: [
                    <?php
                    for ($i = 1; $i < 13; $i++) {
                        $ketemu = false;
                        foreach ($trx_per_bulan as $t) {
                            if ($i == $t->bulan) {
                                echo $t->banyak . ',';
                                $ketemu = true;
                                break;
                            }
                        }
                        if (!$ketemu) echo '0,';
                    }
                    ?>
                ]
            }],
            chart: {
                height: 350,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,

                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function(val) {
                        return val + "%";
                    }
                }

            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-visitors"), options);
        chart.render();

    })
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Apps</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <div class="page-options">
            <a href="<?= base_url('customer/add'); ?>" class="btn btn-secondary">Tambah Customer</a>
            <a href="<?= base_url('transaksi/add'); ?>" class="btn btn-primary">Transaksi Baru</a>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row stats-row">
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"><?= $customer ?></h5>
                            <p class="stats-text">Total Customer</p>
                        </div>
                        <div class="stats-icon change-danger">
                            <i class="material-icons">supervisor_account</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"><?= $count_transaksi ?></h5>
                            <p class="stats-text">Belum Selesai</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title"><?= $transaksi_bln_ini ?></h5>
                            <p class="stats-text">Transaksi Bulan Ini</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card top-products">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi Baru<span class="card-title-helper">Waktu</span></h5>
                        <div class="top-products-list">
                            <?php foreach ($last_trx as $l) : ?>
                                <div class="product-item">
                                    <h5><?= $l->customer_nama ?></h5>
                                    <span><?= $l->transaksi_created ?></span>
                                    <span class="product-item-status text-warning" style="font-size: 13px"><?= $l->barang ?></span>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">

                    <div class="card-body">
                        <div class="visitors-stats">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="visitors-stats-info">
                                        <p>Grafik Transaksi Tahun <?= date('Y'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div id="chart-visitors"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>