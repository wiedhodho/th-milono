<?= $this->extend('master/index') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('keuangan'); ?>">Keuangan</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Keuangan</h5>
                        <p>Silahkan lengkapi form dibawah ini. </p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <?= $validation->listErrors(); ?>
                        <form method="post" action="<?= base_url('keuangan/update/' . $item->keuangan_id); ?>" class="needs-validation" novalidate>

                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom02">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?= $item->keuangan_keterangan; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationCustom02">Nominal</label>
                                    <input type="number" class="form-control" placeholder="Nominal" name="nominal" id="nominal" value="<?= $item->keuangan_nominal; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom01">Debet / Kredit</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="dk" id="exampleRadios1" value="D" <?= $item->keuangan_dk == 'D' ? 'checked' : ''; ?> required>
                                        <label class="custom-control-label" for="exampleRadios1">
                                            Debet
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="dk" id="exampleRadios2" value="K" <?= $item->keuangan_dk == 'K' ? 'checked' : ''; ?> required>
                                        <label class="custom-control-label" for="exampleRadios2">
                                            Kredit
                                        </label>
                                    </div>
                                </div>
                            </div>
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