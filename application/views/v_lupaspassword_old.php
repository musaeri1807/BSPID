<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $judul; ?></title>
</head>

<body>
    <?php
    //echo $this->session->flashdata('email_sent');
    echo $this->session->flashdata('message');
    //echo $this->session->flashdata('msg');
    echo form_open('/Auth/send_mail');
    ?>
    <select name="pilih" id="pilih">
        <option value="forgot">Forgot password</option>
    </select>
    <hr>
    <input type="email" name="email"  required />
    <input type="submit" value="Reset Password">

    <?php
    echo form_close();
    ?>
</body>

</html>