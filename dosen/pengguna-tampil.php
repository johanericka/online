<?php
require('../system/dbconn.php');
require('../system/myfunc.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAINTEK Digital Service</title>
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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="../system/saintek-logo.png" width="100%" />
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Pendaftaran Pengguna Baru</p>
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "registered") {
                ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>ERROR!</strong> NIM / NIP / NIPT / EMail / UserID telah terdaftar
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                $nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
                $qpengguna = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE no='$nodata'");
                $dpengguna = mysqli_fetch_array($qpengguna);
                $namamhs = $dpengguna['nama'];
                $nim = $dpengguna['nip'];
                $nohp = $dpengguna['nohp'];
                $email = $dpengguna['email'];
                $prodi = $dpengguna['prodi'];
                ?>
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" value="<?= $namamhs; ?>">
                <label>NIM / NIP / NIPT</label>
                <input type="number" class="form-control" name="nip" value="<?= $nim; ?>">
                <label>No. HP / WhatsApp</label>
                <input type="number" class="form-control" name="nohp" value="<?= $nohp; ?>">
                <label>e-Mail</label>
                <input type="email" class="form-control" name="email" value="<?= $email; ?>">
                <label>Program Studi</label>
                <input type="prodi" class="form-control" name="prodi" value="<?= $prodi; ?>">
                <hr />
                <form role="form" method="POST">
                    <input type="hidden" name="nodata" value="<?= $nodata; ?>"></input>
                    <input type="hidden" name="email" value="<?= $email; ?>"></input>
                    <input type="hidden" name="namamhs" value="<?= $namamhs; ?>"></input>
                    <div class="row">
                        <div class="col-lg-6">
                            <button name="aksi" value="setujui" type="submit" formaction="pengguna-aktifkan.php" class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin akan mengaktifkan pengguna ini ?')"> <i class="fa fa-check"></i> Aktifkan</button>
                        </div>
                        <div class="col-lg-6">
                            <button name="aksi" value="tolak" type="submit" formaction="pengguna-hapus.php" class="btn btn-danger btn-block" onclick="return confirm('Apakah anda yakin akan menghapus pengguna ini ?')"> <i class="fa fa-trash"></i> Hapus</button>
                        </div>
                    </div>
                </form>
                <br />
                <p class="mb-0" align="center">
                    <small><a href="index.php" class="text-center">Kembali ke Dashboard</a></small>
                </p>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../system/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../system/dist/js/adminlte.min.js"></script>
</body>

</html>