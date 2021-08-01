<?= $this->extend('master/index') ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('customer'); ?>">Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Edit Customer</h5>
                        <p>Silahkan lengkapi form dibawah ini. </p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <?= $validation->listErrors(); ?>
                        <form method="post" action="<?= base_url('customer/update/' . $item->customer_id); ?>" class="needs-validation" novalidate>

                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Nama Customer</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Customer" value="<?= $item->customer_nama; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">No HP</label>
                                    <input type="text" class="form-control" placeholder="No HP" name="telp" id="telp" value="<?= $item->customer_telp; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom01">Alamat</label>
                                <input type="text" class="form-control" id="validationCustom01" name="alamat" placeholder="Alamat" value="<?= $item->customer_alamat; ?>" required>
                                <div class="invalid-feedback">
                                    Looks good!
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