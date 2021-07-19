<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
    header("location:../deauth.php");
}
require('../system/dbconn.php');
include('../system/myfunc.php');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAINTEK Online</title>
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
    <script type="text/javascript" src="../system/js/jquery.min.js"></script>
    <script type="text/javascript" src="../system/js/jquery.form.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"> Menu</i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        require('sidebar.php');
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h3>Pengajuan Surat Pengantar PKL / Magang</h3>
                        </div>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>PERHATIAN!!</strong> Cukup ketua kelompok yang mengajukan
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Identitas Diri</h3>
                                </div>
                                <div class="card-body">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly /></input>
                                    <label>NIM</label>
                                    <input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>" readonly /></input>
                                    <label>Program Studi</label>
                                    <input type="text" class="form-control" name="prodi" value="<?php echo $prodi ?>" readonly /></input>
                                    <form role="form" method="post" action="pkl-isitempat-simpan.php">
                                        <label>Instansi tujuan PKL / Magang </label>
                                        <input type="text" class="form-control" name="instansi" placeholder="nama Instansi" required /></input>
                                        <label>Tempat PKL / Magang </label>
                                        <input type="text" class="form-control" name="tempatpkl" placeholder="Bagian / Divisi Instansi tujuan PKL / Magang" required /></input>
                                        <label>Alamat </label>
                                        <textarea class="form-control" rows="3" name="alamat" placeholder="alamat instansi" required></textarea>
                                        <br />
                                        <label>Tanggal</label>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-6">
                                                    Tgl. Mulai
                                                    <input type="date" id="tglmulai" name="tglmulai" value="<?php echo $tglmulai; ?>" required>
                                                </div>
                                                <div class="col-6">
                                                    Tgl. Selesai
                                                    <input type="date" id="tglselesai" name="tglselesai" value="<?php echo $tglselesai; ?>" required>
                                                </div>
                                            </div>
                                            <small style="color:red"><i>Maksimal 1 bulan </i></small>
                                        </div>
                                        <br />
                                        <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Dengan ini saya menyatakan bahwa data yang saya isi adalah benar')"> <i class="fa fa-arrow-right"></i> Isi Anggota <i class="fa fa-arrow-right"></i></button>
                                    </form>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                </div>
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- footer -->
        <?php include '../system/footer.html' ?>
        <!-- /.footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../system/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../system/dist/js/adminlte.min.js"></script>
</body>

</html>