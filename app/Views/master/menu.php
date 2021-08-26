<div class="page-sidebar">
    <div class="logo-box"><img src="<?= base_url('assets/images/logo.png') ?>" border="0" width="100px;" style="margin-top: -20px;"><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
    <div class="page-sidebar-inner slimscroll">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            <li>
                <a href="<?= base_url(); ?>"><i class="material-icons-outlined">dashboard</i>Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">inbox</i>Transaksi<i class="material-icons has-sub-menu">add</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= base_url('transaksi/status/1'); ?>">Barang Masuk</a>
                    </li>
                    <li>
                        <a href="<?= base_url('transaksi/status/2'); ?>">Dikerjakan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('transaksi/status/3'); ?>">Selesai</a>
                    </li>
                    <?php if (session()->level < 4) : ?>
                        <li>
                            <a href="<?= base_url('transaksi/status/4'); ?>">Diambil</a>
                        </li>
                        <li>
                            <a href="<?= base_url('transaksi/status/5'); ?>">Dibayar</a>
                        </li>
                        <li>
                            <a href="<?= base_url('transaksi/status/0'); ?>">Batal</a>
                        </li>
                        <li>
                            <a href="<?= base_url('transaksi'); ?>">List All</a>
                        </li>
                    <?php endif ?>
                </ul>
            </li>
            <?php if (session()->level < 4) : ?>
                <li>
                    <a href="#"><i class="material-icons">attach_money</i>Keuangan<i class="material-icons has-sub-menu">add</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?= base_url('keuangan/add'); ?>">Tambah</a>
                        </li>
                        <li>
                            <a href="<?= base_url('keuangan'); ?>">List</a>
                        </li>
                        <li>
                            <a href="<?= base_url('keuangan/approved'); ?>">Approved</a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>
            <li class="sidebar-title">
                Manajemen
            </li>
            <li>
                <a href="<?= base_url('users/profil'); ?>"><i class="material-icons">account_circle</i>Profil</a>
            </li>
            <?php if (session()->level == 1) : ?>
                <li>
                    <a href="<?= base_url('users'); ?>"><i class="material-icons">manage_accounts</i>Users</a>
                </li>
                <li>
                    <a href="<?= base_url('customer'); ?>"><i class="material-icons">apps</i>Customer</a>
                </li>
                <li>
                    <a href="<?= base_url('settings'); ?>"><i class="material-icons">settings</i>Settings</a>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?= base_url('auth/logout'); ?>"><i class="material-icons">input</i>Logout</a>
            </li>
        </ul>
    </div>
</div>