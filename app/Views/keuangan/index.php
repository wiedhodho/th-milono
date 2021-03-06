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
        $('#zero-conf2').DataTable();
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
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#cash" data-toggle="tab">Cash</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#transfer" data-toggle="tab">Transfer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
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
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="cash">
                                <table id="zero-conf" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Tgl</th>
                                            <th class="text-right">Debet</th>
                                            <th class="text-right">Kredit</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1;
                                        $total_kredit = 0;
                                        $total_debet = 0;
                                        foreach ($keuangan as $u) :
                                            if ($u->keuangan_transfer == '0') {
                                                $u->keuangan_dk == 'D' ? $total_debet += $u->keuangan_nominal : $total_kredit += $u->keuangan_nominal;
                                        ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $u->keuangan_keterangan; ?></td>
                                                    <td><?= strftime('%d %b %Y %H:%M', strtotime($u->keuangan_created)); ?></td>
                                                    <td class="text-right"><?php if ($u->keuangan_dk == 'D') echo number_format($u->keuangan_nominal); ?></td>
                                                    <td class="text-right"><?php if ($u->keuangan_dk == 'K') echo number_format($u->keuangan_nominal); ?></td>
                                                    <td class="text-center">
                                                        <?php if (date('Y-m-d') == strftime('%Y-%m-%d', strtotime($u->keuangan_created))) : ?>
                                                            <a href="<?= base_url('keuangan/edit/' . $u->keuangan_id); ?>" class="mr-3 text-info"><i class="fa fa-edit"></i></a>
                                                            <a href="<?= base_url('keuangan/delete/' . $u->keuangan_id); ?>" class="text-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"></i></a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        endforeach; ?>
                                    </tbody>
                                </table>
                                <h5 class="card-title mt-5">Total Debet : <?= number_format($total_debet) ?></h5>
                                <h5 class="card-title mt-2">Total Kredit : <?= number_format($total_kredit) ?></h5>
                                <h5 class="card-title mt-2">Total (Kredit-Debet) : <?= number_format($total_kredit - $total_debet) ?></h5>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="transfer">
                                <table id="zero-conf2" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Keterangan</th>
                                            <th>Tgl</th>
                                            <th class="text-right">Debet</th>
                                            <th class="text-right">Kredit</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nomor = 1;
                                        $total_kredit_t = 0;
                                        $total_debet_t = 0;
                                        foreach ($keuangan as $u) :
                                            if ($u->keuangan_transfer == '1') {
                                                $u->keuangan_dk == 'D' ? $total_debet_t += $u->keuangan_nominal : $total_kredit_t += $u->keuangan_nominal;
                                        ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $u->keuangan_keterangan; ?></td>
                                                    <td><?= strftime('%d %b %Y %H:%M', strtotime($u->keuangan_created)); ?></td>
                                                    <td class="text-right"><?php if ($u->keuangan_dk == 'D') echo number_format($u->keuangan_nominal); ?></td>
                                                    <td class="text-right"><?php if ($u->keuangan_dk == 'K') echo number_format($u->keuangan_nominal); ?></td>
                                                    <td class="text-center">
                                                        <?php if (date('Y-m-d') == strftime('%Y-%m-%d', strtotime($u->keuangan_created))) : ?>
                                                            <a href="<?= base_url('keuangan/edit/' . $u->keuangan_id); ?>" class="mr-3 text-info"><i class="fa fa-edit"></i></a>
                                                            <a href="<?= base_url('keuangan/delete/' . $u->keuangan_id); ?>" class="text-danger" onclick="return confirm('are you sure?')"><i class="fas fa-trash"></i></a>
                                                        <?php endif ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        endforeach; ?>
                                    </tbody>
                                </table>
                                <h5 class="card-title mt-5">Total Debet : <?= number_format($total_debet_t) ?></h5>
                                <h5 class="card-title mt-2">Total Kredit : <?= number_format($total_kredit_t) ?></h5>
                                <h5 class="card-title mt-2">Total (Kredit-Debet) : <?= number_format($total_kredit_t - $total_debet_t) ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>