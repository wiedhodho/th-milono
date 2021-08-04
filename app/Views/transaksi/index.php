<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        "use strict";
        $('#zero-conf').DataTable();
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
            <a href="<?= base_url('transaksi/add'); ?>" class="btn btn-primary rounded-pill">Tambah</a>
        </div>
    </div>
    <div class="main-wrapper">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $title ?></h5>
                        <p>Berikut adalah daftar seluruh transaksi yang ada pada system ini.</p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <table id="zero-conf" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Customer</th>
                                    <th>Last Update</th>
                                    <th>Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nomor = 1;
                                foreach ($transaksi as $u) : ?>
                                    <tr>
                                        <td><?= $nomor++; ?></td>
                                        <td><?= $u->customer_nama; ?></td>
                                        <td><?= strftime('%d %b %Y %H:%M', strtotime($u->transaksi_updated)); ?></td>
                                        <td><?= $u->barang_pekerjaan; ?></td>
                                        <td><span class="badge badge-pill badge-<?= $status[$u->transaksi_status]['warna'] ?>"><?= $status[$u->transaksi_status]['label'] ?></span></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('transaksi/proses/' . $u->transaksi_status . '/' . $u->transaksi_id); ?>" class="mr-3 text-success"><i class="fa fa-check"></i></a>
                                            <a href="<?= base_url('transaksi/edit/' . $u->transaksi_id); ?>" class="mr-3 text-info"><i class="fa fa-edit"></i></a>
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