<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        "use strict";
        let status = JSON.parse(JSON.stringify(<?= $status ?>));
        let level = <?= session()->level ?>

        $('#zero-conf').DataTable({
            ordering: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('transaksi/data/' . $tahap); ?>",
                type: "GET",
            },
            columns: [{
                    data: "transaksi_id"
                },
                {
                    data: "customer_nama"
                },
                {
                    data: "transaksi_updated"
                },
                {
                    data: "barang_pekerjaan"
                },
                {
                    data: "transaksi_total",
                    render: $.fn.dataTable.render.number('.', ',', 0, '')
                },
                {
                    data: "transaksi_status"
                },
                {
                    data: "transaksi_id"
                }
            ],
            columnDefs: [{
                    targets: 3,
                    render: function(data, type, row, meta) {
                        return `<a href="#" onclick="barang(${row.transaksi_id})" style="color: #7d7d83">${data}</a>`;
                    },
                },
                {
                    targets: 4,
                    className: 'text-right'
                },
                {
                    targets: 5,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        return `<a href="#" onclick="history(${row.transaksi_id})"><span class="badge badge-pill badge-${status[data].warna}">${status[data].label}</span></a>`;
                    },
                },
                {
                    targets: 6,
                    className: "text-center",
                    render: function(data, type, row, meta) {
                        var a = `<a href="<?= base_url('transaksi/proses') ?>/${row.transaksi_status}/${data}"><i class="fas fa-check text-success font-16 mr-3"></i></a>`;
                        a += `<a href="<?= base_url('transaksi/print') ?>/${data}"><i class="fas fa-print text-dark font-16 mr-3"></i></a>`
                        if (row.transaksi_status == 1 && level < 4) {
                            a += `<a href="<?= base_url('transaksi/edit') ?>/${data}"><i class="fas fa-edit text-info font-16 mr-3"></i></a>`;
                            a += `<a href="<?= base_url('transaksi/proses') ?>/-1/${data}" onclick="return confirm('are you sure ? ')"><i class="fas fa-times text-danger font-16"></i></a>`;
                        }

                        return a;
                    },
                },
            ]
        });
    })

    function history(id) {
        $.get('<?= base_url('history/detail') ?>/' + id, function(data) {
            $('.modal-title').html('History Transaksi');
            $('.modal-body').html(data);
            $('#exampleModal').modal('show');
        })
    }

    function barang(id) {
        $.get('<?= base_url('barang/detail') ?>/' + id, function(data) {
            $('.modal-title').html('Detail Barang');
            $('.modal-body').html(data);
            $('#exampleModal').modal('show');
        })
    }
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
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">History Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                </div>
                <div class="modal-body">
                    Loading...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>