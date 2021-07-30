<?= $this->extend('master/index') ?>

<?= $this->section('css') ?>
<!-- <link href="<?= base_url(); ?>/assets/plugins/DataTables/datatables.min.css" rel="stylesheet"> -->
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function previewImg(field) {
        // console.log(field);
        const sampul = document.querySelector(`#${field}`);
        // const sampulLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector(`.${field}`);

        // sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="page-info">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('users'); ?>">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
            </ol>
        </nav>
    </div>
    <div class="main-wrapper">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Profil</h5>
                        <p>Silahkan lengkapi form dibawah ini. </p>
                        <?php if (session()->getFlashdata('tipe')) : ?>
                            <div class="alert alert-<?= session()->getFlashdata('tipe') ?> outline-alert" role="alert">
                                <?= session()->getFlashdata('pesan') ?>
                            </div>
                        <?php endif; ?>
                        <?= $validation->listErrors(); ?>
                        <form method="post" action="<?= base_url('users/update_profil/'); ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="validationCustom01">Nama Lengkap</label>
                                <input type="text" class="form-control" id="validationCustom01" name="nama" placeholder="Nama Lengkap" value="<?= $item->users_nama; ?>" required>
                                <input type="hidden" name="users_id" value="<?= $item->users_id; ?>" required>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">NO HP</label>
                                    <input type="text" class="form-control" name="nohp" placeholder="NO HP" value="<?= $item->users_nohp; ?>" required>
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Foto</label>
                                    <input type="file" class="form-control" placeholder="Foto" name="foto" id="foto" onchange="previewImg('foto')">
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="validationCustom01">Username</label>
                                <input type="text" class="form-control" id="validationCustom01" name="name" placeholder="Username" value="<?= $item->users_name; ?>" required>
                                <div class="invalid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom02">Ulangi Password</label>
                                    <input type="password" name="ulangi_password" class="form-control" placeholder="Ulangi Password">
                                    <div class="invalid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Foto</h5>
                        <img src="<?= base_url('foto/' . $item->users_foto); ?>" width="300px" alt="" class="img-thumbnail img-preview foto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>