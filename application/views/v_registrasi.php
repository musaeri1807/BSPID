<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $judul; ?></title>
</head>

<body>
    <?php
    echo $this->session->flashdata('email_sent');
    echo $this->session->flashdata('message');
    echo form_open('/Auth/send_mail');
    ?>
    <select name="pilih" id="pilih">
        <option value="registrasi">Registrasi</option>
    </select>
    <hr>
    Nama : <input type="text" name="nama" value=""  /> <br>
    Email : <input type="email" name="email"  required /> <br>
    Nomor : <input type="number" name="notelpon" value=""  />
    <input type="submit" value="Daftar">

    <?php
    echo form_close();
    ?>
</body>

</html>