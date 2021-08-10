<?php
session_start();
if ($_SESSION['hakakses'] != "dosen") {
    header("location:../deauth.php");
}
require('../system/dbconn.php');
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
$jabatan = mysqli_real_escape_string($dbsurat, $_SESSION['jabatan']);
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
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
                            <h3>Pengajuan Surat Pengambilan Data</h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <?php
            $sql = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE no='$nodata'");
            $dsql = mysqli_fetch_array($sql);
            $nim = $dsql['nim'];
            $nama = $dsql['nama'];
            $prodi = $dsql['prodi'];
            $judulskripsi = $dsql['judulskripsi'];
            $dosen = $dsql['dosen'];
            $instansi = $dsql['instansi'];
            $alamat = $dsql['alamat'];
            $tglpelaksanaan = $dsql['tglpelaksanaan'];
            $datadiperlukan = $dsql['datadiperlukan'];
            ?>
            <!-- Main content -->
            <section class="content">
                <div class="col-12 col-sm-6 col-lg-12">
                    <div class="card card-success card-tabs">
                        <label>NIM</label>
                        <input type="text" class="form-control" name="nim" value="<?= $nim ?>" readonly />
                        <label>Nama </label>
                        <input type="text" class="form-control" name="nama" value="<?= $nama ?>" readonly />
                        <label>Judul Skripsi / penelitian </label>
                        <input type="text" class="form-control" name="judulskripsi" value="<?= $judulskripsi; ?>" readonly>
                        <label>Dosen Pembimbing </label>
                        <input type="text" class="form-control" name="dosen" value="<?= $dosen; ?>" readonly>
                        <label>Instansi</label>
                        <input type="text" class="form-control" name="instansi" value="<?= $instansi; ?>" readonly>
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" value="<?= $alamat; ?>" readonly>
                        <label>Tanggal Pelaksanaan</label>
                        <input type="text" class="form-control" name="tglpelaksanaan" value="<?= $tglpelaksanaan; ?>" readonly>
                        <label>Data / sample :</label>
                        <input type="text" class="form-control" name="datadiperlukan" value="<?= $datadiperlukan; ?>" readonly>
                        <hr>
                        <form role="form" method="POST">
                            <input type="hidden" name="nodata" value="<?php echo $nodata; ?>"></input>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button name="aksi" value="setujui" type="submit" formaction="pengambilandata-dosen-setujui.php" class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin akan MENERIMA pengajuan ini ?')"> <i class="fa fa-check"></i> Setujui</button>
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
                                            <button name="aksi" value="tolak" type="submit" formaction="pengambilandata-dosen-tolak.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan MENOLAK pengajuan ini ?')"> <i class="fa fa-times"></i> Tolak</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./modal tolak-->
                        </form>
                    </div>
                </div>

                <div class="content">
                    <div class="container-fluid">
                    </div>
                    <!-- /.form group -->



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
<!-- tanggal indonesia -->
<?php
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $pecahkan = explode('-', $tanggal);
    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

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

<!-- cari dosen -->
<script src="../system/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.search-box input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("cari-proses.php", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });
        // Set search input value on click of result item
        $(document).on("click", ".result p", function() {
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>

</html>