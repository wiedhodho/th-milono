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
    <script src="<?= base_url() ?>/assets/js/js.cookie.min.js"></script>
    <script>
        if (Cookies.get("site_title") === undefined || Cookies.get("footer") === undefined) {
            let url =
                "<?= base_url('api/settings'); ?>";
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    data.map((e, index) => {
                        Cookies.set(e.setting_name, e.setting_value);
                        if (e.setting_name == 'site_title') {
                            document.title = e.setting_value;
                        }
                    })
                });
        }
        if (Cookies.get('site_title'))
            document.title = Cookies.get('site_title')
    </script>

    <!-- Styles -->
    <link href="<?= base_url('css/Lato.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/Montserrat.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/material.css') ?>" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= base_url() ?>/assets/css/connect.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/dark_theme.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/css/custom.css" rel="stylesheet">
    <?= $this->renderSection('css') ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body>
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <?= $this->include('master/menu') ?>
        <div class="page-container">
            <?= $this->include('master/topbar') ?>
            <?= $this->renderSection('content') ?>
            <?= $this->include('master/footer') ?>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <?= $this->renderSection('js') ?>
    <script src="<?= base_url() ?>/assets/js/initMenu.js"></script>
    <script src="<?= base_url() ?>/assets/js/connect.min.js"></script>
    <script>
        // $('.logo-text').html(Cookies.get('app_name'))
        $('.footer-text').html(Cookies.get('footer'))
    </script>
</body>

</html>