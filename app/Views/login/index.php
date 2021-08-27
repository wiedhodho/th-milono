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
    <title>Loading...</title>

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
                                <div class="logo-box"><a href="#" class="logo-text" style="font-size:18px;">Sistem Informasi Bengkel Harapan</a></div>
                                <?php if (session()->getFlashdata('tipe') || $validation->getErrors()) : ?>
                                    <div class="alert alert-<?= session()->getFlashdata('tipe') ?><?= $validation->getErrors() ? 'danger' : ''; ?> outline-alert" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                        <?= $validation->listErrors(); ?>
                                    </div>
                                <?php endif; ?>
                                <form method="post" action="<?= base_url('auth/check_login'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block btn-submit">Sign In</button>
                                    <div class="auth-options">
                                        <div class="custom-control custom-checkbox form-group">
                                            <input type="checkbox" class="custom-control-input" id="exampleCheck1">
                                            <label class="custom-control-label" for="exampleCheck1">Remember me</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block d-xl-block">
                    <div class="auth-image" style="background-image: url(<?= base_url('img/logo.png') ?>); background-size: 21% 20%"></div>
                </div>
            </div>
        </div>

        <!-- Javascripts -->
        <script src="<?= base_url(); ?>/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap/popper.min.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/initMenu.js"></script>
        <script src="<?= base_url(); ?>/assets/js/connect.min.js"></script>
        <script src="<?= base_url() ?>/assets/js/js.cookie.min.js"></script>
        <script>
            <?php
            if (session()->getFlashdata('logout')) :
            ?>
                let c = Cookies.get();
                Object.keys(c).map(e => {
                    Cookies.remove(e);
                })
            <?php endif ?>
            if (Cookies.get("site_title") === undefined || Cookies.get("footer") === undefined) {
                let url = "<?= base_url('api/settings'); ?>";
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        data.map((e, index) => {
                            Cookies.set(e.setting_name, e.setting_value);
                            if (e.setting_name == 'site_title') {
                                document.title = e.setting_value;
                                // $('.logo-text').html(e.setting_value);
                            }
                        })
                    });
            }
            if (Cookies.get('site_title')) {
                document.title = Cookies.get('site_title')
                // $('.logo-text').html(document.title);
            }
        </script>
</body>

</html>