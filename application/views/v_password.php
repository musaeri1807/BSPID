<div class="row">
  <div class="col-md-3">
    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <!-- <img class="profile-user-img img-responsive img-circle"  src="" alt="User profile picture"> -->
        <img class="profile-user-img img-responsive img-circle" style="width: 80px;height:80px;" src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->field_photo; ?>" alt="User profile picture">
        <h3 class="profile-username text-center"><?php echo $userdata->field_nama; ?></h3>
        <p class="text-muted text-center">
          <?php
          if ($userdata->field_blokir_status == 'A') {
            echo '<span class="badge btn-success text-white">Enable</span>';
          } else {
            echo '<span class="badge btn-warning text-white">Disable</span>';
          }

          ?>
        </p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Username</b> <i class="pull-right"><?php echo $userdata->field_handphone; ?></i>
          </li>
          <li class="list-group-item">
            <b>Email</b> <i class="pull-right"><?php echo $userdata->field_email;?></i>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li ><a href="#settings" data-toggle="tab">Users</a></li>
        <li class="active"><a href="#password" data-toggle="tab">Ubah Password</a></li>
        <li><a href="#personal" data-toggle="tab">Personal</a></li>
      </ul>
      <div class="tab-content">
        <div class=" tab-pane" id="settings">
          <form class="form-horizontal" action="<?php echo base_url('Profile/update') ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputUsername" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="" placeholder="Email" name="field_email" value="<?php echo $userdata->field_email; ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="inputNama" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Name" name="field_nama" value="<?php echo $userdata->field_nama; ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" placeholder="Foto" name="field_photo">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="active tab-pane" id="password">
          <form class="form-horizontal" action="<?php echo base_url('Profile/ubah_password') ?>" method="POST">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">Password Lama</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Lama" name="passLama">
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Password Baru" name="passBaru">
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Konfirmasi Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" placeholder="Konfirmasi Password" name="passKonf">
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
        <div class="tab-pane" id="personal">
          <form class="form-horizontal" action="<?php echo base_url('Profile/personal') ?>" method="POST">
            <div class="form-group">
              <label for="passLama" class="col-sm-2 control-label">NIK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="NIK" value="<?php echo $nasabah->Nik_Nasabah; ?>" data-inputmask="'mask': '999999 9999999999'" data-mask >
                <?= form_error('NIK', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">NPWP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="NPWP" value="<?php echo $nasabah->Nik_Nasabah; ?>" data-inputmask="'mask': '999999 9999999999'" data-mask >
              </div>
            </div>
            <div class="form-group">
              <label for="passBaru" class="col-sm-2 control-label">Gender</label > 
              <div class="col-sm-10">
                <select class="form-control" name="gender" id="gender">
                    <?php if ($nasabah->Jenis_Kelamin_N == 'L') {
                    echo '<option value="L">Laki-Laki</option>';
                  } elseif($nasabah->Jenis_Kelamin_N == 'P') {
                    echo '<option value="P">Perempuan</option>';
                  }else{
                    echo '<option value="">Belum di Update</option>';
                  }

                  ?>
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="alamat" value="<?php echo $nasabah->Alamat_Nasabah; ?>" placeholder="Alamat">               
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Provinsi</label>
              <div class="col-sm-10">
                <select name="provinsi" class="form-control" id="provinsi">
                  <option value="<?php echo $nasabah->Provinsi_N; ?>"><?php echo $nasabah->PROVINSI; ?></option>
                  <?php

                  foreach ($provinsi as $prov) {
                    echo '<option value="' . $prov->field_provinsi_id . '">' . $prov->field_nama_provinsi . '</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Kabupaten/Kota</label>
              <div class="col-sm-10">

                <select name="kabupaten" class="form-control" id="kabupaten">
                  <option value='<?php echo $nasabah->Kabupaten_N; ?>'><?php echo $nasabah->KABUPATEN; ?></option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Kecamatan</label>
              <div class="col-sm-10">
                <select name="kecamatan" class="form-control" id="kecamatan">
                  <option value="<?php echo $nasabah->Kecamatan_N; ?>"><?php echo $nasabah->KECAMATAN; ?></option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="passKonf" class="col-sm-2 control-label">Kelurahan / Desa</label>
              <div class="col-sm-10">
                <select name="desa" class="form-control" id="desa">
                  <option value="<?php echo $nasabah->Kelurahan_N; ?>"><?php echo $nasabah->DESA; ?></option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Simpan</button>

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="msg" style="display:none;">
      <?php echo $this->session->flashdata('msg'); ?>
    </div>
  </div>
</div>