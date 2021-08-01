<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/jquery-ui.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.js"></script>
<script src="<?= base_url(); ?>/js/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#zero-conf').DataTable();
        $('#tgl2').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(d, i) {
                $('#form_lihat').submit();
            }
        });
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
        <div class="col text-right">
            <a href="<?= base_url('keuangan/add'); ?>" class="btn btn-primary rounded-pill">Tambah</a>
        </div>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">List Keuangan</h5>
                        <p>Berikut adalah daftar seluruh keuangan yang ada pada system ini.</p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="" id="form_lihat">
                            <div class="form-row">
                                <div class="col-md-3 col-sm-6 col-12 mb-3">
                                    <label for="validationCustom02">Tanggal</label>
                                    <input type="text" class="form-control" name="tgl2" id="tgl2" placeholder="yy-mm-dd" autocomplete="off" value="<?= $now ?>">
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table id="zero-conf" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th class="text-right">Nominal</th>
                                    <th>Tgl</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($keuangan as $u) : ?>
                                    <tr>
                                        <td><?= $nomor++; ?></td>
                                        <td><?= $u->keuangan_keterangan; ?></td>
                                        <td class="text-right"><?= number_format($u->keuangan_nominal); ?></td>
                                        <td><?= strftime('%d %b %Y %H:%M', strtotime($u->keuangan_created)); ?></td>
                                        <td><?= $u->keuangan_approved != null ? strftime('%d %b %Y %H:%M', strtotime($u->keuangan_approved)) : '-'; ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('keuangan/approve/' . $u->keuangan_id); ?>" class="mr-3 text-info"><i class="fa fa-check"></i></a>
                                            <a href="<?= base_url('keuangan/edit/' . $u->keuangan_id); ?>" class="mr-3 text-info"><i class="fa fa-edit"></i></a>
                                            <a href="<?= base_url('keuangan/delete/' . $u->keuangan_id); ?>" class="text-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>