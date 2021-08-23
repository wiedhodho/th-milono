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
            hide: function(deleteElement) {
                let deleted = $("#deleted").val() != '' ? $("#deleted").val().split(',') : [];
                deleted.push($(this).children().find("input[name*='id']").val());
                $("#deleted").val(deleted.join(','));
                $(this).slideUp(deleteElement);
            },
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
                        <h5 class="card-title">Form Edit Transaksi</h5>
                        <p>Silahkan lengkapi form dibawah ini. </p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <?= $validation->listErrors(); ?>
                        <form method="post" action="<?= base_url('transaksi/update/' . $item->transaksi_id); ?>" class="needs-validation repeater" novalidate>
                            <input type="hidden" name="deleted" id="deleted" value="">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Customer</label>
                                    <select name="customer" class="form-control select2" required>
                                        <option value="">Pilih Customer</option>
                                        <?php foreach ($customer as $c) : ?>
                                            <option value="<?= $c->customer_id ?>" <?= $item->transaksi_customer == $c->customer_id ? 'selected' : '' ?>><?= $c->customer_nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div data-repeater-list="data">
                                <?php foreach ($barang as $k => $b) :
                                ?>

                                    <div class="form-row" data-repeater-item>
                                        <div class="col-md-3 mb-3">
                                            <label for="validationCustom02">Nama Barang</label>
                                            <input type="text" class="form-control" name="barang_nama" placeholder="Nama Barang" value="<?= $b->barang_nama; ?>" required>
                                            <input type="hidden" name="barang_id" value="<?= $b->barang_id; ?>" required>
                                            <div class="invalid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationCustom02">Pekerjaan</label>
                                            <input type="text" class="form-control" name="barang_pekerjaan" placeholder="Nama Pekerjaan" value="<?= $b->barang_pekerjaan; ?>" required>
                                            <div class="invalid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-1 mb-3">
                                            <label for="validationCustom02">QTY</label>
                                            <input type="text" class="form-control" name="barang_qty" placeholder="Qty" value="<?= $b->barang_qty; ?>" required>
                                            <div class="invalid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-1 mb-3">
                                            <label for="validationCustom02">Satuan</label>
                                            <select name="barang_satuan" class="form-control" required>
                                                <?php foreach ($satuan as $c) : ?>
                                                    <option value="<?= $c->satuan_id ?>" <?= $c->satuan_id == $b->barang_satuan ? 'selected' : '' ?>><?= $c->satuan_nama ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label for="validationCustom02">Harga</label>
                                            <input type="text" class="form-control" name="barang_harga" placeholder="Harga" value="<?= $b->barang_harga; ?>" required>
                                            <div class="invalid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="margin-top: 30px;">
                                            <button data-repeater-delete class="btn btn-danger" type="button"> Del </button>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <!-- <button data-repeater-create class="btn btn-info" type="button">Tambah</button> -->
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