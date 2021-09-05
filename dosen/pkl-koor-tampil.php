<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['hakakses'] != "dosen") {
    header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
require('../system/myfunc.php');
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h3>Pengajuan Surat Pengantar PKL / Magang</h3>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ambil data mahasiswa dari database -->
            <?php
            $nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
            $datamhs = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE no='$nodata'");
            $row = mysqli_fetch_array($datamhs);
            $nim = $row['nim'];
            $nama = $row['nama'];
            $prodi = $row['prodi'];
            $instansi = $row['instansi'];
            $tempatpkl = $row['tempatpkl'];
            $alamat = $row['alamat'];
            $tglmulai = $row['tglmulai'];
            $tglselesai = $row['tglselesai'];
            $lampiran = $row['lampiran'];
            $buktivaksin = $row['buktivaksin'];
            $jenispkl = $row['jenispkl'];
            $pklmagang = $row['pklmagang'];
            ?>

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- card pilihan lab -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Identitas Mahasiswa</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
                                    <label>NIM</label>
                                    <input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
                                    <label>Program Studi</label>
                                    <input type="text" class="form-control" name="jurusan" value="<?= $prodi; ?>" readonly /></input>
                                    <label>Instansi</label>
                                    <input type="text" class="form-control" name="instansi" value="<?= $instansi; ?>" readonly /></input>
                                    <label> PKL / Magang </label>
                                    <input type="text" class="form-control" name="tempatpkl" value="<?= $tempatpkl; ?>" readonly /></input>
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="alamat" value="<?= $alamat; ?>" readonly /></input>
                                    <label>Waktu Pelaksanaan</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Tanggal Mulai<br />
                                            <input type="text" class="form-control" id="tglmulai" name="tglmulai" value="<?= tgl_indo($tglmulai); ?>" disabled></input>
                                        </div>
                                        <div class="col-lg-6">
                                            Tanggal Selesai<br />
                                            <input type="text" class="form-control" id="tglselesai" name="tglselesai" value="<?= tgl_indo($tglselesai); ?>" disabled></input>
                                        </div>
                                    </div>
                                    <label>Jenis Kegiatan</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Surat Pengantar
                                            <input type="text" class="form-control" name="pklmagang" value="<?= $pklmagang; ?>" readonly>
                                        </div>
                                        <div class="col-lg-6">
                                            Jenis <?= $pklmagang; ?>
                                            <input type="text" class="form-control" name="jenispkl" value="<?= $jenispkl; ?>" readonly>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- pakta Integritas -->
                                    <?php
                                    if ($lampiran == '') {
                                        $namafile = 'noimage.gif';
                                    } else {
                                        $namafile = $lampiran;
                                    }
                                    ?>
                                    <label>Pakta Integritas</label>
                                    <br />
                                    <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid" width="50%"></img></a>
                                    <br />
                                    <!-- tabel lampiran -->
                                    <div class="container-fluid">
                                        <div class="row">
                                            <table class="table table-bordered" id="tabel">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No.</th>
                                                        <th width="10%">NIM</th>
                                                        <th width="35%">NAMA</th>
                                                        <th>Bukti Vaksin</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- tabel anggota -->
                                                    <?php
                                                    $dataanggota = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimketua='$nim'");
                                                    $no = 1;
                                                    while ($q = mysqli_fetch_array($dataanggota)) {
                                                        $id = $q['id'];
                                                        $nimanggota = $q['nimanggota'];
                                                        $nama = $q['nama'];
                                                        $buktivaksin = $q['buktivaksin'];
                                                        if ($jenispkl == 'Offline' and $buktivaksin == '') {
                                                            $namafile2 = 'noimage.gif';
                                                        } elseif ($jenispkl == 'Offline' and $buktivaksin <> '') {
                                                            $namafile2 = $buktivaksin;
                                                        } elseif ($jenispkl == 'Online') {
                                                            $namafile2 = 'online.png';
                                                        }
                                                    ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <?php $id; ?>
                                                            <td><?= $nimanggota; ?></td>
                                                            <td><?= $nama; ?></td>
                                                            <td><a href="../img/<?= $namafile2; ?>" target="_blank"><img src="../img/<?= $namafile2; ?>" class="img-fluid" width="20%"></img></a></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <small>Klik pada gambar untuk memperbesar</small>
                                        </div>
                                    </div>
                                    <hr>
                                    <form role="form" method="POST">
                                        <input type="hidden" name="nodata" value="<?php echo $nodata; ?>"></input>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <button name="aksi" value="setujui" type="submit" formaction="pkl-koor-setujui.php" class="btn btn-success btn-block" onclick="return confirm('Apakah anda menyetujui pengajuan ini ?')"> <i class="fa fa-check"></i> Setujui</button>
                                            </div>
                                            <div class="col-lg-6">
                                                <button name="aksi" value="tolak" type="button" data-toggle="modal" data-target="#modal-tolak" class="btn btn-danger btn-block"> <i class="fa fa-times"></i> Tolak</button>
                                            </div>
                                        </div>
                                        <!-- modal tolak -->
                                        <div class="modal fade" id="modal-tolak">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Alasan Penolakan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <textarea class="form-control" rows="3" name="keterangan"></textarea>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                                                        <button name="aksi" value="tolak" type="submit" formaction="pkl-koor-tolak.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menolak pengajuan ini ?')"> <i class="fa fa-times"></i> Tolak</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./modal tolak-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

<!-- alert upload file -->
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] == 0) {
?>
        <div class="alert alert-info alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Info : </strong> File berhasil di upload.
        </div>
    <?php
    } else if ($_GET['error'] == 1) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>ERROR : </strong> ukuran file maksimal 1MB.
        </div>
    <?php
    } else if ($_GET['error'] == 2) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>ERROR : </strong> ketika upload file.
        </div>
    <?php
    } else if ($_GET['error'] == 3) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>ERROR : </strong> hanya menerima file .JPG / .JPEG.
        </div>
<?php
    }
}
?>
<!-- timer untuk alert -->
<script>
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 1000);
</script>


</html>