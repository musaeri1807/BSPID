<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $judul; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Favicon -->
  <link href="<?php echo base_url(); ?>assets_frontend/img/icon_bsp.png" rel="icon">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url('Auth/lupapassword'); ?>"><b>Reset Password</b></a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg"></p>
      <?php

      echo $this->session->flashdata('message');

      ?>
      <form action="<?php echo base_url('/Auth/send_mail'); ?>" method="post">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

        <select hidden name="pilih" id="pilih">
          <option value="forgot">Forgot password</option>
        </select>

        <div class="form-group has-feedback">
          Anda tidak punya akun? Klik <a href="<?php echo base_url('Auth/registrasi'); ?>">|<b>Registrasi</b> |</a> <br>
          Silakan klik <a href="<?php echo base_url('Auth/login'); ?>">|<b>Login</b>|</a>
        </div>
        <div class="row">
          <div class="col-xs-offset-8 col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
          </div>

        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
    <?php
    echo show_err_msg($this->session->flashdata('error_msg'));
    ?>
  </div>


  <!-- /.login-box -->

  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script> -->
  <!-- <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script> -->
</body>

</html>