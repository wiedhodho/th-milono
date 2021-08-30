<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/jquery-ui.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url(); ?>/js/jquery-ui.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.tanggal').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('.select2').select2();
    })
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $title; ?></h5>
                        <p>Silahkan Pilih tanggal lalu klik download.</p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?= base_url('reporting/cetak_tagihan/'); ?>" class="needs-validation" novalidate>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom02">Customer</label>
                                    <select name="customer" class="form-control select2" required>
                                        <option value="">Pilih Customer</option>
                                        <?php foreach ($customer as $c) : ?>
                                            <option value="<?= $c->customer_id ?>"><?= $c->customer_nama . ' (' . $c->banyak . ' trx)' ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Mulai</label>
                                    <input type="text" class="form-control tanggal" name="mulai" placeholder="mulai" value="<?= $thn . '-' . $bln . '-01'; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Selesai</label>
                                    <input type="text" class="form-control tanggal" name="selesai" placeholder="Selesai" value="<?= $thn . '-' . $bln . '-' . $tgl; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>