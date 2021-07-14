<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
    header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$jurusan = mysqli_real_escape_string($dbsurat, $_SESSION['jurusan']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SAINTEK Digital Services</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../system/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../system/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../system/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../system/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
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
        <?php require('sidebar.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3>Pengajuan Ijin Penggunaan Laboratorium</h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- card lampiran -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lampiran</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%">No.</th>
                                                <th class="text-center" style="width: 75%">Lampiran</th>
                                                <th class="text-center" style="width: 20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Screenshot Hasil Pemeriksaan Screening Bebas COVID-19</td>
                                                <td>
                                                    <a href="https://kedokteran.uin-malang.ac.id/konsuldokter/formulir" target="_blank">Periksa</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td><b>Lampiran 4-</b>Surat pernyataan melaksanakan karantina mandiri</td>
                                                <td>
                                                    <a href="../doc/Lampiran4.docx">Download Lampiran 4</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td><b>Lampiran 5-</b>Surat pernyataan kesanggupan menerapkan protokol kesehatan</td>
                                                <td>
                                                    <a href="../doc/Lampiran5.docx">Download Lampiran 5</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td><b>Lampiran 6-</b>Surat pernyataan kesanggupan mengawasi mahasiswa bimbingan skripsi / tugas akhir dari Dosen Pembimbing</td>
                                                <td>
                                                    <a href="../doc/Lampiran6.docx">Download Lampiran 6</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td><b>Lampiran 7-</b>Form kesediaan karantina mandiri selama 14 hari di Malang sebelum bekerja di laboratorium</td>
                                                <td>
                                                    <a href="../doc/Lampiran7.docx">Download Lampiran 7</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card -->

                            <!-- card pilihan lab -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Upload Lampiran</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <form action="ijinlab-upload.php" method="post" enctype="multipart/form-data">
                                            <label>Lampiran</label>
                                            <select class="custom-select form-control-border" name="lampiran">
                                                <option value="lampiran-1" selected>Lampiran-1 Hasil screening COVID-19</option>
                                                <option value="lampiran-4">Lampiran-4 Karantina Mandiri</option>
                                                <option value="lampiran-5">Lampiran-5 Kesanggupan menerapkan protokol kesehatan</option>
                                                <option value="lampiran-6">Lampiran-6 Kesanggupan dosen mengawasi mahasiswa</option>
                                                <option value="lampiran-7">Lampiran-7 Kesediaan Karantina Mandiri</option>
                                            </select>
                                            <br />
                                            <br />
                                            <label>File</label>
                                            <br />
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                            <br />
                                            <small style="color:red">Format file JPG</small>
                                            <br />
                                            <br />
                                            <input type="hidden" name="nim" value="<?= $nim; ?>">
                                            <button type="submit" class="btn btn-primary btn-block" value="Upload Lampiran" name="submit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                        </form>
                                    </div>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <?php
                                                $namafile = 'noimage.gif';
                                                ?>
                                                <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                <p class="text-center">Lampiran-1</p>
                                            </div>
                                            <div class="col">
                                                <?php
                                                $namafile = 'noimage.gif';
                                                ?>
                                                <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                <p class="text-center">Lampiran-4</p>
                                            </div>
                                            <div class="col">
                                                <?php
                                                $namafile = 'noimage.gif';
                                                ?>
                                                <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                <p class="text-center">Lampiran-5</p>
                                            </div>
                                            <div class="col">
                                                <?php
                                                $namafile = 'noimage.gif';
                                                ?>
                                                <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                <p class="text-center">Lampiran-6</p>
                                            </div>
                                            <div class="col">
                                                <?php
                                                $namafile = 'noimage.gif';
                                                ?>
                                                <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                <p class="text-center">Lampiran-7</p>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-block" disabled> <i class="fa fa-upload" aria-hidden="true"></i> Ajukan </button>

                                </div>

                            </div>
                            <!-- /.card pilihan lab-->
                            <!-- footer -->
                            <?php include '../system/footer.html' ?>
                            <!-- /.footer -->
                        </div>
                        <!-- /.content-wrapper -->



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
                    <!-- DataTables  & Plugins -->
                    <script src="../system/plugins/datatables/jquery.dataTables.min.js"></script>
                    <script src="../system/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                    <script src="../system/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                    <script src="../system/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                    <script src="../system/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                    <script src="../system/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                    <script src="../system/plugins/jszip/jszip.min.js"></script>
                    <script src="../system/plugins/pdfmake/pdfmake.min.js"></script>
                    <script src="../system/plugins/pdfmake/vfs_fonts.js"></script>
                    <script src="../system/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                    <script src="../system/plugins/datatables-buttons/js/buttons.print.min.js"></script>
                    <script src="../system/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
                    <!-- AdminLTE App -->
                    <script src="../system/dist/js/adminlte.min.js"></script>
                    <!-- AdminLTE for demo purposes -->
                    <script src="../system/dist/js/demo.js"></script>

                    <script>
                        $(function() {
                            $("#example1").DataTable({
                                "responsive": true,
                                "lengthChange": false,
                                "autoWidth": false,
                                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            $('#example2').DataTable({
                                "paging": true,
                                "lengthChange": false,
                                "searching": false,
                                "ordering": true,
                                "info": true,
                                "autoWidth": false,
                                "responsive": true,
                            });
                        });
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