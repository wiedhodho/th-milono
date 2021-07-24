<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>

</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('settings'); ?>">Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form <?= $title; ?></h5>
                        <p>Silahkan lengkapi form dibawah ini. </p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <?= $validation->listErrors(); ?>
                        <form method="post" action="<?= base_url('settings/update/'); ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="validationCustom01">Nama Settings</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Settings" value="<?= $item->setting_name; ?>" required readonly>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom01">Deskripsi</label>
                                <input type="text" class="form-control" name="desc" value="<?= $item->setting_desc; ?>" readonly>
                                <input type="hidden" name="tipe" value="<?= $item->setting_type; ?>" required>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom01">Value</label>
                                <input type="<?= $item->setting_type; ?>" class="form-control" name="value" placeholder="<?= $item->setting_desc; ?>" value="<?= $item->setting_value; ?>">
                                <div class="invalid-feedback">
                                    Looks good!
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