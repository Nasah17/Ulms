<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?= $title; ?> | Ulms App </title>
    <meta property="og:title" content="Sign In">
    <meta name="author" content="PTIKF2017">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Learning Management System">
    <meta property="og:description" content="Learning Management System">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
    <meta property="og:site_name" content="Learning Management System - Ulms App">
    <script type="application/ld+json">
        {
            "name": "Web - Ulms App",
            "description": "Forgot password and Activate account",
            "author": {
                "@type": "Person",
                "name": "Muhammad Hasan Z"
            },
            "@type": "WebSite",
            "url": "www.hasan.ml",
            "headline": "",
            "@context": ""
        }
    </script>
    <!-- <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon.png"> -->
    <!-- <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/icon.png"> -->
    <!-- <meta name="theme-color" content="#3063A0"> -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/custom.css">
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script>
</head>

<body>
    <main class="auth">
        <header id="auth-header" class="auth-header" style="background-image: url();">
            <h1>
                <img class="mb-4" height="80" src="<?= base_url() ?>" alt="">
            </h1>
        </header>
        <form action="<?= base_url('auth/changepassword?email=') . $email . '&token=' . urlencode($token); ?>" method="post" class="auth-form">
            <fieldset>
                <?= $this->session->flashdata('Message') ?>
                <div class="form-group mb-4">
                    <label class="d-flex justify-content-between" for="password"><span>New Password</span> <a href=".password" data-toggle="password"><i class="fa fa-eye fa-fw"></i><span>Show</span></a></label> <input type="password" class="password form-control <?= form_error('password', 'is-invalid ', ''); ?>" id="password" name="password" autofocus="on" value="<?= set_value('password') ?>">
                    <?= form_error('password', '<div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>', '</div>'); ?>
                </div>
                <div class="form-group mb-4">
                    <label class="d-flex justify-content-between" for="cpassword"><span>Confirm New Password</span></label> <input type="password" class="password form-control <?= form_error('cpassword', 'is-invalid ', ''); ?>" id="cpassword" name="cpassword" value="<?= set_value('cpassword') ?>">
                    <?= form_error('cpassword', '<div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>', '</div>'); ?>
                </div>
                <div class="form-group mb-4">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
                </div>
            </fieldset>
        </form>
        <footer class="auth-footer">
            <p class="text-center"> &copy; Copyright <strong>Ulms</strong>. All Rights Reserved <br>
                Modified by Ulms
            </p>
        </footer>
    </main>
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/javascript/theme.min.js"></script>
</body>

</html><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?= $title; ?> | Ulms App </title>
    <meta property="og:title" content="Sign In">
    <meta name="author" content="PTIKF2017">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Learning Management System">
    <meta property="og:description" content="Learning Management System">
    <link rel="canonical" href="index.html">
    <meta property="og:url" content="index.html">
    <meta property="og:site_name" content="Learning Management System - Ulms App">
    <script type="application/ld+json">
        {
            "name": "Web - Ulms App",
            "description": "Forgot password and Activate account",
            "author": {
                "@type": "Person",
                "name": "Muhammad Hasan Z"
            },
            "@type": "WebSite",
            "url": "www.hasan.ml",
            "headline": "",
            "@context": ""
        }
    </script>
    <!-- <link rel="apple-touch-icon" sizes="144x144" href="assets/apple-touch-icon.png"> -->
    <!-- <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/icon.png"> -->
    <!-- <meta name="theme-color" content="#3063A0"> -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/stylesheets/custom.css">
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var isCompact = JSON.parse(localStorage.getItem('hasCompactMenu'));
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        if (isCompact == true) document.querySelector('html').classList.add('preparing-compact-menu');
    </script>
</head>

<body>
    <main class="auth">
        <header id="auth-header" class="auth-header" style="background-image: url();">
            <h1>
                <img class="mb-4" height="80" src="<?= base_url() ?>" alt="">
            </h1>
        </header>
        <form action="<?= base_url('auth/changepassword?email=') . $email . '&token=' . urlencode($token); ?>" method="post" class="auth-form">
            <fieldset>
                <?= $this->session->flashdata('Message') ?>
                <div class="form-group mb-4">
                    <label class="d-flex justify-content-between" for="password"><span>New Password</span> <a href=".password" data-toggle="password"><i class="fa fa-eye fa-fw"></i><span>Show</span></a></label> <input type="password" class="password form-control <?= form_error('password', 'is-invalid ', ''); ?>" id="password" name="password" autofocus="on" value="<?= set_value('password') ?>">
                    <?= form_error('password', '<div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>', '</div>'); ?>
                </div>
                <div class="form-group mb-4">
                    <label class="d-flex justify-content-between" for="cpassword"><span>Confirm New Password</span></label> <input type="password" class="password form-control <?= form_error('cpassword', 'is-invalid ', ''); ?>" id="cpassword" name="cpassword" value="<?= set_value('cpassword') ?>">
                    <?= form_error('cpassword', '<div class="invalid-feedback"><i class="fa fa-exclamation-circle fa-fw"></i>', '</div>'); ?>
                </div>
                <div class="form-group mb-4">
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Reset</button>
                </div>
            </fieldset>
        </form>
        <footer class="auth-footer">
            <p class="text-center"> &copy; Copyright <strong>Ulms</strong>. All Rights Reserved <br>
                Modified by Ulms
            </p>
        </footer>
    </main>
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/javascript/theme.min.js"></script>
</body>

</html>