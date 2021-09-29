<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
    header("location:../deauth.php");
}
require('../system/dbconn.php');
//include('../system/myfunc.php');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
if (isset($_GET['nodata'])) {
    $nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
}
//cari no telepon
$sql = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip='$nim'");
$dsql = mysqli_fetch_array($sql);
$telepon = $dsql['nohp'];
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

        <?php
        require('sidebar.php');
        ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h3>Pengajuan Surat Pengantar PKL / Magang</h3>
                        </div>
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
                                    <h3 class="card-title">Data Peserta PKL / Magang</h3>
                                </div>
                                <div class="card-body">

                                    <form role="form" method="post" action="pkl-anggotatambah.php">
                                        <div class="form-group">
                                            NIM
                                            <input type="number" name="nimanggota" autocomplete="none" />
                                            <input type="hidden" name="nodata" value="<?= $nodata; ?>" />
                                            <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Tambah</button>
                                        </div>
                                    </form>

                                    <div class="box">
                                        <div class="box-body">
                                            <table class="table table-bordered" id="tabel">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No.</th>
                                                        <th>NIM</th>
                                                        <th>NAMA</th>
                                                        <th>No Telepon</th>
                                                        <th width="5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- memasukkan pengusul -->
                                                    <?php
                                                    $qcari = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota = '$nim'");
                                                    $data = mysqli_num_rows($qcari);
                                                    if ($data == 0) {
                                                        $qtambah = "INSERT into pklanggota (nodata,nimketua, nimanggota, nama, telepon) 
																		values('$nodata','$nim','$nim','$nama','$telepon')";
                                                        $sql =  mysqli_query($dbsurat, $qtambah);
                                                    }
                                                    ?>
                                                    <!--baca status -->
                                                    <?php
                                                    if (isset($_GET['ket'])) {
                                                        $ket = mysqli_real_escape_string($dbsurat, $_GET['ket']);
                                                        if ($ket == 'notfound') {
                                                    ?>
                                                            <div class="alert alert-danger alert-dismissible fade show">
                                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                                <strong>ERROR!</strong> Data tidak ditemukan.
                                                            </div>
                                                        <?php
                                                        } elseif ($ket == 'used') {
                                                        ?>
                                                            <div class="alert alert-danger alert-dismissible fade show">
                                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                                <strong>ERROR!</strong> Anggota sudah terdaftar pada kelompok lain.
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    $dataanggota = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimketua='$nim'");
                                                    $no = 1;
                                                    while ($q = mysqli_fetch_array($dataanggota)) {
                                                        $id = $q['id'];
                                                        $nimanggota = $q['nimanggota'];
                                                        $nama = $q['nama'];
                                                        $telepon = $q['telepon'];
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <?php $id; ?>
                                                            <td><?= $nimanggota; ?></td>
                                                            <td><?= $nama; ?></td>
                                                            <td><?= $telepon; ?></td>
                                                            <td>
                                                                <form action="pkl-anggotahapus.php" method="POST">
                                                                    <input type="hidden" name="id" value="<?= $id; ?>">
                                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm ('Yakin menghapus anggota ini ?');"><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <div class="alert alert-warning alert-dismissible fade show">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong>KETERANGAN : </strong><br />
                                                Apabila no. telepon tidak tampil, silahkan melengkapi data pada menu user profile anda dan ulangi proses penambahan anggota kelompok
                                            </div>
                                        </div>
                                    </div>
                                    <a href="pkl-isilampiran.php?nodata=<?= $nodata; ?>" class="btn btn-success btn-block" onclick="return confirm('Dengan ini saya menyatakan bahwa data yang saya isi adalah benar')"> <i class="fa fa-file"></i> Isi Lampiran <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br />


        <br />
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