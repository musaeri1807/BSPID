<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title><?php echo $judul; ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="BSP,Bank Sampah Pintar, BSP, pok lisa" name="keywords">
  <meta content="Digitalikasi Bank Sampah,bank sampah pintar,emas,gold,aplikasi,bersih" name="description">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Favicon -->
  <link href="<?php echo base_url(); ?>assets_frontend/img/icon_bspid.png" rel="icon">
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="<?php echo base_url('Auth/login'); ?>"><b>Mendaftar Nasabah</b></a>
    </div>



    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">
        <!-- Log in to start your session -->
        <?php
        echo show_err_msg($this->session->flashdata('error_msg'));
        ?>
      </p>

      <form action="<?php echo base_url('Auth/signup'); ?>" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="<?= set_value('name'); ?>">
          <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="email" class="form-control " id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
          <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="number" class="form-control " id="nohp" name="nohp" placeholder="Nomor HP" value="<?= set_value('nohp'); ?>">
          <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
          <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <select name="cabang" id="cabang" class="form-control">
            <option value="">--Pilih Cabang Nasabah Mendaftar--</option>
            <?php foreach ($C as $cabang) {
            ?>
              <option value="<?php echo $cabang->ID_CABANG; ?>">Cabang BSP- <?php echo $cabang->NAMA_CABANG; ?></option>
            <?php }; ?>
          </select>
          <?= form_error('cabang', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control " id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
          <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          Silakan klik <a href="<?php echo base_url('Auth'); ?>">|<b>Login</b> |</a><br>
          Jika Kehilangan Akses Klik <a href="<?php echo base_url('Auth/lupapassword'); ?>">|<b>Lupa Password</b>|</a>
        </div>
        <div class="row">
          <!-- <div class="col-xs-4 col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div> -->

          <div class="col-xs-offset-8 col-xs-4">
            <button type="submit" class="btn btn-success btn-block btn-flat">Daftar</button>
          </div>

        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
            Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
            Google+</a>
        </div> -->
      <!-- /.social-auth-links -->

      <!-- <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->

    </div>
    <!-- /.login-box-body -->

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