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

<!-- location sharing -->
<?php
$lokasi = "coming soon ...";
?>

<!-- akses ke database -->
<?php require_once('../system/dbconn.php'); ?>


<!-- cek session -->
<?php
session_start();
if ($_SESSION['role'] != "mahasiswa") {
    header("location:../index.php?pesan=noaccess");
}
?>

<?php
$iduser = $_SESSION['iduser'];
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];
$jurusan = $_SESSION['jurusan'];
$status = $_SESSION['status'];
?>

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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../system/uin-malang-logo.png" alt="../../system Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">UIN Malang</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional)-->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $nama; ?></a>
                        <a href="#" class="d-block">NIM : <?php echo $nim; ?></a>
                        <a href="#" class="d-block">Jurusan : <?php echo $jurusan; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview menu-close">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-file"></i>
                                <p>
                                    Dokumen
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="http://saintek.uin-malang.ac.id/online/doc/SOPIjinLayananLaboratorium.pdf" target="_blank" class="nav-link">
                                        <i class="far fa-file-pdf"></i>
                                        <p>SOP Ijin Layanan Lab.</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="mailto:saintekonline@gmail.com" class="nav-link">
                                <i class="nav-icon fas fa-question-circle"></i>
                                <p>
                                    Bantuan
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa-window-close"></i>
                                <p>
                                    Keluar
                                    <span class="right badge badge-danger"></span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3>Lampiran Ijin Laboratorium</h3>
                        </div>
                    </div>
                    <b style="color:green">Lampiran Dokumen Persyaratan Ijin Penggunaan Laboratorium</b>
                    <p style="color:green"><a href="https://kedokteran.uin-malang.ac.id/konsuldokter/formulir" target="_blank"><b>Lampiran 1</b></a> Mengisi Form screening Bebas Covid-19 Universitas di laman: http://kedokteran.uin-malang.ac.id/konsuldokter/Formulir dan mencetak hasil pemeriksaan (print screen hasil pemeriksaan) </p>
                    <p style="color:green"><a href="https://saintek.uin-malang.ac.id/online/doc/Lampiran4.docx"><b>Lampiran 4</b></a> Surat pernyataan melaksanakan karantina mandiri di rumah masing-masing sebelum bekerja di laboratorium selama 14 hari berturut-turut </p>
                    <p style="color:green"><a href="https://saintek.uin-malang.ac.id/online/doc/Lampiran5.docx"><b>Lampiran 5</b></a> Surat pernyataan kesanggupan menerapkan protokol kesehatan</p>
                    <p style="color:green"><a href="https://saintek.uin-malang.ac.id/online/doc/Lampiran6.docx"><b>Lampiran 6</b></a> Surat pernyataan kesanggupan mengawasi mahasiswa bimbingan skripsi / tugas ahir</p>
                    <p style="color:green"><a href="https://saintek.uin-malang.ac.id/online/doc/Lampiran7.docx" target="_blank"><b>Lampiran 7</b></a> Jika hasil verifikasi Satgas Covid-19 Fakultas merekomendasikan karantina mandiri setelah tiba di Malang maka mahasiswa wajib mengisi form kesediaan karantina mandiri selama 14 hari di Malang sebelum bekerja di laboratorium</p>
                    <br />
                </div><!-- /.container-fluid -->
            </section>

            <!-- pengajuan surat mahasiswa -->
            <section class="content">
                <!-- Default box -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Upload lampiran </h3>
                        <!-- card minimize -->
                        <div class="card-tools">
                            <!-- This will cause the card to maximize when clicked 
							<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>-->
                            <!-- This will cause the card to collapse when clicked -->
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <!-- This will cause the card to be removed when clicked
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
                        </div>
                    </div>
                    <!-- /.card-header -->

                    <!-- dapatkan no surat -->
                    <?php
                    $query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim' AND keterangan is null");
                    $data = mysqli_fetch_array($query);
                    $nodata = $data['no'];
                    ?>

                    <div class="card-body p-0">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%" style="text-align:center">No</th>
                                        <th width="20%" style="text-align:center">Lampiran</th>
                                        <th style="text-align:center">Dokumen Ter-Upload</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Lampiran 1 (Screenshot)</td>
                                        <td style="text-align:center">
                                            <?php
                                            $query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='screeningcovid'");
                                            $cekhasil = mysqli_num_rows($query);
                                            if ($cekhasil > 0) {
                                                $lamp1 = 1;
                                                $data = mysqli_fetch_array($query);
                                                $namafile = $data['namafile'];
                                            } else {
                                                $lamp1 = 0;
                                                $namafile = '../uploads/noimage.gif';
                                            };

                                            $ext = substr($namafile, -3);
                                            if ($ext == "pdf") {
                                            ?>
                                                <div><iframe src="<?php echo $namafile; ?>" width="400px" height="400px"></iframe></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div><img src="<?php echo $namafile; ?>" width="400px" height="400px" /></div>
                                            <?php
                                            }
                                            ?>
                                            <br />
                                            <label>Upload file</label>
                                            <form action="upload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
                                                <input type="file" name="image" class="form-control" />
                                                <small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPG/PDF</i></small>
                                                <br />
                                                <input type="hidden" name="nim" value="<?php echo $nim; ?>" />
                                                <input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
                                                <button class="btn btn-block btn-primary btn-upload" name="upload" value="screeningcovid"> Upload Hasil Screening COVID-19</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Lampiran 4</td>
                                        <td style="text-align:center">
                                            <?php
                                            $query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='karantinamandiri'");
                                            $cekhasil = mysqli_num_rows($query);
                                            if ($cekhasil > 0) {
                                                $lamp4 = 1;
                                                $data = mysqli_fetch_array($query);
                                                $namafile = $data['namafile'];
                                            } else {
                                                $lamp4 = 0;
                                                $namafile = '../uploads/noimage.gif';
                                            }

                                            $ext = substr($namafile, -3);
                                            if ($ext == "pdf") {
                                            ?>
                                                <div><iframe src="<?php echo $namafile; ?>" width="400px" height="400px"></iframe></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div><img src="<?php echo $namafile; ?>" width="400px" height="400px" /></div>
                                            <?php
                                            }
                                            ?>
                                            <br />
                                            <label>Upload file</label>
                                            <form action="upload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
                                                <input type="file" name="image" class="form-control" />
                                                <small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPG/PDF</i></small>
                                                <br />
                                                <input type="hidden" name="nim" value="<?php echo $nim; ?>" />
                                                <input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
                                                <button class="btn btn-block btn-primary btn-upload" name="upload" value="karantinamandiri"> Upload Surat Pernyataan Karantina Mandiri</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Lampiran 5</td>
                                        <td style="text-align:center">
                                            <?php
                                            $query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='kesanggupanprotokol'");
                                            $cekhasil = mysqli_num_rows($query);
                                            if ($cekhasil > 0) {
                                                $lamp5 = 1;
                                                $data = mysqli_fetch_array($query);
                                                $namafile = $data['namafile'];
                                            } else {
                                                $lamp5 = 0;
                                                $namafile = '../uploads/noimage.gif';
                                            }

                                            $ext = substr($namafile, -3);
                                            if ($ext == "pdf") {
                                            ?>
                                                <div><iframe src="<?php echo $namafile; ?>" width="400px" height="400px"></iframe></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div><img src="<?php echo $namafile; ?>" width="400px" height="400px" /></div>
                                            <?php
                                            }
                                            ?>
                                            <br />
                                            <label>Upload file</label>
                                            <form action="upload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
                                                <input type="file" name="image" class="form-control" />
                                                <small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPG/PDF </i></small>
                                                <br />
                                                <input type="hidden" name="nim" value="<?php echo $nim; ?>" />
                                                <input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
                                                <button class="btn btn-block btn-primary btn-upload" name="upload" value="kesanggupanprotokol"> Upload Surat Pernyataan Melaksanakan Protokol Kesehatan</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Lampiran 6</td>
                                        <td style="text-align:center">
                                            <?php
                                            $query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='kesanggupanmengawasi'");
                                            $cekhasil = mysqli_num_rows($query);
                                            if ($cekhasil > 0) {
                                                $lamp6 = 1;
                                                $data = mysqli_fetch_array($query);
                                                $namafile = $data['namafile'];
                                            } else {
                                                $lamp6 = 0;
                                                $namafile = '../uploads/noimage.gif';
                                            }

                                            $ext = substr($namafile, -3);
                                            if ($ext == "pdf") {
                                            ?>
                                                <div><iframe src="<?php echo $namafile; ?>" width="400px" height="400px"></iframe></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div><img src="<?php echo $namafile; ?>" width="400px" height="400px" /></div>
                                            <?php
                                            }
                                            ?>
                                            <br />
                                            <label>Upload file</label>
                                            <form action="upload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
                                                <input type="file" name="image" class="form-control" />
                                                <small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPG/PDF </i></small>
                                                <br />
                                                <input type="hidden" name="nim" value="<?php echo $nim; ?>" />
                                                <input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
                                                <button class="btn btn-block btn-primary btn-upload" name="upload" value="kesanggupanmengawasi"> Upload Surat Pernyataan Dosen Kesanggupan Mengawasi Mahasiswa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Lampiran 7</td>
                                        <td><?php
                                            $query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='karantinamandirimlg'");
                                            $cekhasil = mysqli_num_rows($query);
                                            if ($cekhasil > 0) {
                                                $lamp7 = 1;
                                                $data = mysqli_fetch_array($query);
                                                $namafile = $data['namafile'];
                                            } else {
                                                $lamp7 = 0;
                                                $namafile = '../uploads/noimage.gif';
                                            }
                                            ?>
                                            <?php
                                            $ext = substr($namafile, -3);
                                            if ($ext == "pdf") {
                                            ?>
                                                <div><iframe src="<?php echo $namafile; ?>" width="400px" height="400px"></iframe></div>
                                            <?php
                                            } else {
                                            ?>
                                                <div><img src="<?php echo $namafile; ?>" width="400px" height="400px" /></div>
                                            <?php
                                            }
                                            ?>
                                            <br />
                                            <label>Upload file</label>
                                            <form action="upload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
                                                <input type="file" name="image" class="form-control" />
                                                <small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPG/PDF</i></small>
                                                <br />
                                                <input type="hidden" name="nim" value="<?php echo $nim; ?>" />
                                                <input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
                                                <button class="btn btn-block btn-primary btn-upload" name="upload" value="karantinamandirimlg"> Upload Surat Pernyataan Karantina Mandiri</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br />
                            <?php
                            if ($lamp1 == 1 and $lamp4 == 1 and $lamp5 == 1 and $lamp6 == 1 and $lamp7 == 1) {
                            ?>
                                <a href="lab-simpanfinal.php" class="btn btn-block btn-success"><i class="fa fa-save"></i> Ajukan </a>
                            <?php
                            } else {
                            ?>
                                <a href="#" class="btn btn-block btn-secondary"><i class="fa fa-save"></i> Ajukan </a>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.content -->
                </div>
            </section>
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