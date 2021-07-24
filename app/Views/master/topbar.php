<div class="page-header">
    <nav class="navbar navbar-expand">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav">
            <li class="nav-item small-screens-sidebar-link">
                <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="<?= base_url('foto/' . session()->foto) ?>" alt="profile image">
                    <span><?= session()->username; ?></span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('permohonan/baru'); ?>">Ajukan Baru</a>
                    <a class="dropdown-item" href="<?= base_url('permohonan/renew'); ?>">Ajukan Pembaruan</a>
                    <a class="dropdown-item" href="<?= base_url('permohonan/pencabutan_baru'); ?>">Ajukan Pencabutan</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('users/profil'); ?>">My Profile</a>
                    <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Log out</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="dark-theme-toggle"><i class="material-icons-outlined">brightness_2</i><i class="material-icons">brightness_2</i></a>
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a href="<?= base_url('users'); ?>" class="nav-link">Users</a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('reporting'); ?>" class="nav-link">Reports</a>
                </li>
            </ul>
        </div>
        <div class="navbar-search">
            <form>
                <div class="form-group">
                    <input type="text" name="search" id="nav-search" placeholder="Search...">
                </div>
            </form>
        </div>
    </nav>
</div>