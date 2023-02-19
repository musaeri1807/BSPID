<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
    <title><?php echo $titale; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="BSP,Bank Sampah Pintar, BSP, pok lisa" name="keywords">
    <meta content="Digitalikasi Bank Sampah,bank sampah pintar,emas,gold,aplikasi,bersih" name="description">

    <!-- Favicon -->
    <link href="<?php echo base_url(); ?>assets_frontend/img/icon_bspid.png" rel="icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url();?>/assets_/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url();?>/assets_/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url();?>/assets_/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>/assets_/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url();?>/assets_/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Daftar Unit</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li><a href=""><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Register 
        <small>Unit Bank Sampah Pintar</small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Fixed</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">      
        <p>Patikan Anda Sudah membaca aturan yang berlaku</p>
      </div>
      <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('Frontend/unit');?>" method="post">
      <!-- Default box -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Identitas Pengajuan</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>                  
                  <input type="text" class="form-control " id="name" name="name" placeholder="Full name" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama Bank Sampah</label>
                  <input type="text" class="form-control " id="bank_sampah" name="bank_sampah" placeholder="bama Bank Sampah" value="<?= set_value('bank_sampah'); ?>">
                                <?= form_error('bank_sampah', '<small class="text-danger pl-3">', '</small>'); ?>                  
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Jumlah Pengurusan</label>
                  <input type="number" class="form-control " id="Jumlah_pengurus" name="jumlah_pengurus" placeholder="Jumlah Pengurus" value="<?= set_value('jumlah_pengurus'); ?>">
                                <?= form_error('jumlah_pengurus', '<small class="text-danger pl-3">', '</small>'); ?> 
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama Ketua</label>
                  <input type="text" class="form-control" name="nama_ketua" id="namaketua" placeholder="Nama Ketua" value="<?= set_value('nama_ketua'); ?>">
                                <?php echo form_error('nama_ketua','<small class="text-danger pl-3">', '</small>');?>
                </div> 
                  <div class="form-group">
                  <label for="exampleInputPassword1">Nomor HP</label>
                  <input type="number" class="form-control" name="nohp" id="hp" placeholder="Nomor HP yang Aktif" value="<?= set_value('nohp'); ?>">
                                <?php echo form_error('nohp','<small class="text-danger pl-3">', '</small>');?>
                </div> 
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Alamat Unit</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Propinsi</label>                  
                  <select name="provinsi" class="form-control" id="provinsi" style="width: 100%;" >
                  <option value="">Pilih Provinsi</option>
                  <?php
                  foreach ($provinsi as $prov) {
                    echo '<option value="' . $prov->field_provinsi_id . '">' . $prov->field_nama_provinsi . '</option>';
                  }
                  ?>
                </select>
                <?= form_error('provinsi', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Kota / Kabupaten</label>
                <select name="kabupaten" class="form-control select2" id="kabupaten"  style="width: 100%;">
                
                </select>
                <?= form_error('kabupaten', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" class="form-control select2" id="kecamatan"  style="width: 100%;">
                </select>
                <?= form_error('kecamatan', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Kelurahan atau Desa</label>
                <select name="desa" class="form-control select2" id="desa"  style="width: 100%;">                
                </select>
                <?= form_error('desa', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
            <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Akun Pengguna</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control " id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">                  
                                <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                  <!-- <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="miga.informatika@gmail.com"> -->
                </div>  
                <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <!-- <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="P@ssw0rd"> -->
                  <input type="password" class="form-control " id="password" name="password" placeholder="Password" value="<?= set_value('password'); ?>">
                                <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <button class="btn btn-dropbox">Simpan</button>      <a href="<?= base_url();?>" class="btn btn-Warning">Keluar </a>
    </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; <?php echo date('Y');?><a href=""></a>.</strong> All rights
    reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url();?>/assets_/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url();?>/assets_/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url();?>/assets_/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url();?>/assets_/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>/assets_/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url();?>/assets_/dist/js/demo.js"></script>

  <script>
    $(document).ready(function() {
      $("#provinsi").change(function() {
        var url = "<?php echo site_url('Frontend/add_ajax_kab'); ?>/" + $(this).val();
        $('#kabupaten').load(url);
        return false;
      })

      $("#kabupaten").change(function() {
        var url = "<?php echo site_url('Frontend/add_ajax_kec'); ?>/" + $(this).val();
        $('#kecamatan').load(url);
        return false;
      })

      $("#kecamatan").change(function() {
        var url = "<?php echo site_url('Frontend/add_ajax_des'); ?>/" + $(this).val();
        $('#desa').load(url);
        return false;
      })
    });
  </script>
</body>
</html>
