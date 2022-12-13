<!DOCTYPE html>
<html>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Loket | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/css/ionicon.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="<?= BASEURL ?>assets/css/font.css" rel="stylesheet">

</head>

<body class="hold-transition login-page" style="background-image: url(<?= BASEURL ?>assets/img/vb1.jpg)" ;>
    <div class="login-box">
        <div class="login-logo" style="color: black;">
            <b>Aplikasi </b> LOKET
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masukkan Username dan Password Anda</p>

                <form action="<?php echo site_url('log/login'); ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="nav-icon fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <center><label style="color : red;"><?= $this->session->flashdata('status_login') ?></label></center>
                    <!-- <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div> -->
                    <!-- /.col -->
                    <center>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in-alt"> </i> Log In</button>
                    </center>
                    <!-- /.col -->
                    <!-- </div> -->
                </form>
                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= BASEURL ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASEURL ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASEURL ?>assets/dist/js/adminlte.min.js"></script>

</body>

</html>