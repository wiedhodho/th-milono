<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url(); ?>/js/jquery.repeater.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    $(document).ready(function() {
        $('.repeater').repeater({
            isFirstItemUndeletable: true,
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
                <li class="breadcrumb-item"><a href="<?= base_url('transaksi'); ?>">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Transaksi</h5>
                        <p>Silahkan lengkapi form dibawah ini. </p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <?= $validation->listErrors(); ?>
                        <form method="post" action="<?= base_url('transaksi/save'); ?>" class="needs-validation repeater" novalidate>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Customer</label>
                                    <select name="customer" class="form-control select2" required>
                                        <option value="">Pilih Customer</option>
                                        <?php foreach ($customer as $c) : ?>
                                            <option value="<?= $c->customer_id ?>"><?= $c->customer_nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div data-repeater-list="data">
                                <div class="form-row" data-repeater-item>
                                    <div class="col-md-3 mb-3">
                                        <label for="validationCustom02">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang" value="<?= old('nama'); ?>" required>
                                        <div class="invalid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="validationCustom02">Pekerjaan</label>
                                        <input type="text" class="form-control" name="pekerjaan" placeholder="Nama Pekerjaan" value="<?= old('pekerjaan'); ?>" required>
                                        <div class="invalid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label for="validationCustom02">QTY</label>
                                        <input type="text" class="form-control" name="qty" placeholder="Qty" value="<?= old('qty'); ?>" required>
                                        <div class="invalid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-1 mb-3">
                                        <label for="validationCustom02">Satuan</label>
                                        <select name="satuan" class="form-control" required>
                                            <?php foreach ($satuan as $c) : ?>
                                                <option value="<?= $c->satuan_id ?>"><?= $c->satuan_nama ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label for="validationCustom02">Harga</label>
                                        <input type="text" class="form-control" name="harga" placeholder="Harga" value="<?= old('harga'); ?>" required>
                                        <div class="invalid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="margin-top: 30px;">
                                        <button data-repeater-delete class="btn btn-danger" type="button"> Del </button>
                                    </div>
                                </div>

                            </div>
                            <button data-repeater-create class="btn btn-info" type="button">Tambah</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>