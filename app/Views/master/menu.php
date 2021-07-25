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
                <a href="#"><i class="material-icons">inbox</i>Permohonan<i class="material-icons has-sub-menu">add</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= base_url('permohonan/penerbitan'); ?>">Penerbitan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('permohonan/perpanjangan'); ?>">Pembaruan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('permohonan/pencabutan'); ?>">Pencabutan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="material-icons">folder</i>Petunjuk<i class="material-icons has-sub-menu">add</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?= base_url('petunjuk/penerbitan'); ?>">Penerbitan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('petunjuk/perpanjangan'); ?>">Pembaruan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('petunjuk/pencabutan'); ?>">Pencabutan</a>
                    </li>
                    <li>
                        <a href="<?= base_url('petunjuk/penggunaan'); ?>">Penggunaan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('dokumen'); ?>"><i class="material-icons">book</i>Dokumen</a>
            </li>
            <li>
                <a href="<?= base_url('regulasi'); ?>"><i class="material-icons-outlined">book</i>Regulasi</a>
            </li>
            <li>
                <a href="<?= base_url('reporting'); ?>"><i class="material-icons">cloud_queue</i>Reporting</a>
            </li>
            <li>
                <a href="<?= base_url('faq'); ?>"><i class="material-icons">help_outline</i>FAQ</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">link</i>Link<i class="material-icons has-sub-menu">add</i></a>
                <ul class="sub-menu">
                    <li>
                        <a href="https://portal-bsre.bssn.go.id/login" target="_blank">AMS BSrE</a>
                    </li>
                    <li>
                        <a href="https://esign-bsre.bssn.go.id/login" target="_blank">eSign BSrE</a>
                    </li>
                    <li>
                        <a href="https://webmail.beraukab.go.id" target="_blank">Webmail</a>
                    </li>
                </ul>
            </li>

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