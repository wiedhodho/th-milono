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
<script src="<?= base_url() ?>/assets/js/pages/dashboard.js"></script>
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
            <a href="<?= base_url('settings'); ?>" class="btn btn-secondary">Tambah Customer</a>
            <a href="<?= base_url('permohonan/baru'); ?>" class="btn btn-primary">Transaksi Baru</a>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="row stats-row">
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">123</h5>
                            <p class="stats-text">Total Users</p>
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
                            <h5 class="card-title">122></h5>
                            <p class="stats-text">Pengajuan Baru</p>
                        </div>
                        <div class="stats-icon change-success">
                            <i class="material-icons">trending_up</i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card card-transparent stats-card">
                    <div class="card-body">
                        <div class="stats-info">
                            <h5 class="card-title">131</h5>
                            <p class="stats-text">Perpanjangan</p>
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
                <div class="card savings-card">
                    <div class="card-body">
                        <h5 class="card-title">Masa Berlaku Sertifikat</h5>
                        <div class="savings-stats text-center">
                            <h1>5454</h1>
                        </div>
                    </div>
                </div>
                <div class="card top-products">
                    <div class="card-body">
                        <h5 class="card-title">Customer Baru<span class="card-title-helper">Jenis</span></h5>
                        <div class="top-products-list">
                            trx
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
                                        <p>Grafik Permohonan Tahun <?= date('Y'); ?></p>
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