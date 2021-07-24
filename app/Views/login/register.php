<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>SIPENYU</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= base_url(); ?>/assets/css/connect.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/css/dark_theme.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet">
    <style>
        .custom-file-label1 {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            line-height: 1.5;
            background-color: #fff;
            background-clip: padding-box;
            display: block;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            padding: 12px 25px;
            /* height: auto; */
            border-radius: 25px;
            border: 2px solid #e8e8e8;
            font-size: 13px;
            font-weight: 700;
            color: #5c6662;
            font-family: inherit;
            margin-left: 15px;
            margin-right: 15px;
            overflow: hidden;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="auth-page sign-in">

    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="auth-form">
                        <div class="row">
                            <div class="col">
                                <div class="logo-box"><a href="#" class="logo-text">Form Register</a></div>
                                <?= $validation->listErrors(); ?>
                                <form method="post" action="<?= base_url('auth/register_save'); ?>" enctype="multipart/form-data">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" value="<?= old('nama'); ?>">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="<?= old('email'); ?>">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="nohp" placeholder="No HP" name="nohp" value="<?= old('nohp'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" value="<?= old('nik'); ?>">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="<?= old('nip'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="pangkat" placeholder="Pangkat/Golongan" name="pangkat" value="<?= old('pangkat'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Jabatan" placeholder="Jabatan" name="jabatan" value="<?= old('jabatan'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control custom-select" name="opd">
                                            <option value="">Pilih OPD</option>
                                            <?php foreach ($opd as $o) : ?>
                                                <option value="<?= $o->opd_id; ?>" <?= old('opd') == $o->opd_id ? 'selected' : ''; ?>><?= $o->opd_nama; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group row" style="margin-bottom: 25px;">
                                        <div class="col-6">
                                            <input type="file" class="custom-file-input" id="foto" placeholder="foto" name="foto">
                                            <label class="custom-file-label1 foto" for="foto">Pilih file Foto</label>
                                        </div>
                                        <div class="col-6">
                                            <input type="file" class="custom-file-input" id="ktp" placeholder="ktp" name="ktp">
                                            <label class="custom-file-label1 ktp" for="ktp">Pilih file KTP</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="Username" placeholder="Username" name="name" value="<?= old('name'); ?>">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-6">
                                            <input type="password" class="form-control" id="password" placeholder="password" name="password">
                                        </div>
                                        <div class="col-6">
                                            <input type="password" class="form-control" id="ulangi_password" placeholder="ulangi password" name="ulangi_password">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Daftar</button>
                                    <div class="auth-options">
                                        <div class="custom-control custom-checkbox form-group">
                                            <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                            <label class="custom-control-label" for="exampleCheck1">Sign me in</label>
                                        </div>
                                        <a href="<?= base_url('auth'); ?>" class="forgot-link">Sudah punya akun?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="<?= base_url('assets/images/logo.png') ?>" border="0" width="70%">
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/bootstrap/popper.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/connect.min.js"></script>
    <script>
        $('.custom-file-input').change(function() {
            // console.log('opk');
            // const sampul = document.querySelector('#kategori_gambar');
            const sampulLabel = document.querySelector(`.custom-file-label1`);
            // const imgPreview = document.querySelector('.img-preview');
            // console.log();
            // $('.custom-file-label1').html($(this).val());
            $(`.${this.id}`).html($(this).val());
            // $(`.${this.id}`).val('$(this).val()');

            // const fileSampul = new FileReader();
            // fileSampul.readAsDataURL(sampul.files[0]);

            // fileSampul.onload = function(e) {
            //     imgPreview.src = e.target.result;
            // }
        })
    </script>
</body>

</html>