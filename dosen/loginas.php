<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['nip'] != "198312132019031004") {
    //header("location:../deauth.php");
}
require('../system/dbconn.php');
require('../system/myfunc.php');
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
        <?php
        require('navbar.php');
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        require('sidebar.php');
        ?>
        <!-- ./Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3>Login As</h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- pengajuan surat mahasiswa -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Pengguna </h3>
                                    <!-- card minimize -->
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <?php $no = 1; ?>
                                <div class="card-body p-0">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%" style="text-align:center">No</th>
                                                    <th style="text-align:center">NIP / NIM</th>
                                                    <th style="text-align:center">Nama</th>
                                                    <th style="text-align:center">Prodi</th>
                                                    <th width="10%" style="text-align:center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Daftar Pengguna-->
                                                <?php
                                                $query = mysqli_query($dbsurat, "SELECT * FROM pengguna ORDER BY nip,prodi");
                                                $jmldata = mysqli_num_rows($query);
                                                while ($data = mysqli_fetch_array($query)) {
                                                    $nodata = $data['no'];
                                                    $nip = $data['nip'];
                                                    $nama = $data['nama'];
                                                    $prodi = $data['prodi'];
                                                    $user = $data['user'];
                                                    $pass = $data['pass'];
                                                ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $nip; ?></td>
                                                        <td><?= $nama; ?></td>
                                                        <td><?= $prodi; ?></td>
                                                        <td>
                                                            <form action="../auth.php" method="POST">
                                                                <input type="hidden" name="username" value="<?= $user; ?>">
                                                                <input type="hidden" name="password" value="<?= $pass; ?>">
                                                                <input type="submit" class="btn btn-danger btn-sm" value="Log In" name="loginas" onclick="return confirm ('Login As <?= $nama; ?> ?');">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- footer -->
        <?php
        include('footerdsn.php');
        ?>
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
                "autoWidth": true,
                "paging": true,
                "searching": true,
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
</body>

</html>