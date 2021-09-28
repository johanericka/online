<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAINTEK Online </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../system/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../system/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<!-- ambil data -->
<?php
require('../system/dbconn.php');
require('../system/myfunc.php');
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$query = mysqli_query($dbsurat, "SELECT * FROM wfh WHERE no='$nodata'");
$jdata = mysqli_num_rows($query);
$data = mysqli_fetch_array($query);
$verifikatorprodi = namadosen($dbsurat, $data['verifikatorprodi']);
$nip = $data['verifikatorprodi'];
$tglverifikasi = tgljam_indo($data['tglverifikasiprodi']);
?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><img src="../system/saintek-logo.png"></img></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Data Penanda Tangan</p>
                <label>Surat</label>
                <input type="text" class="form-control" name="surat" value="Izin Work From Home" readonly>
                <label>Penanda Tangan</label>
                <input type="text" class="form-control" name="nama" value="<?= $verifikatorprodi; ?>" readonly>
                <input type="text" class="form-control" name="nip" value="<?= $nip; ?>" readonly>
                <label>Tanggal Disetujui</label>
                <input type="text" class="form-control" name="tanggal" value="<?= $tglverifikasi; ?>" readonly>
                <br />
                <div class="row">
                    <div class="col-12">
                        <a href="index.php" class="btn btn-primary btn-block">Kembali</a>
                    </div>
                </div>
                <br />
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../system/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../system/dist/js/adminlte.min.js"></script>

</body>

</html>