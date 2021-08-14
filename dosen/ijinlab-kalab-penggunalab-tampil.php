<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
//cek apakah kalab
$sql = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE kalab='$nip'");
$jsql = mysqli_num_rows($sql);
if ($jsql > 0) {
    while ($dsql = mysqli_fetch_array($sql)) {
        //tampilkan semua lab
        $namalab = $dsql['namalab'];
    }
} else {
    header("location:../deauth.php");
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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3>Rekap. Pengguna Lab.</i></h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Pengguna Lab</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="15%">Nama Lab.</th>
                                            <th width="20%">Nama</th>
                                            <th width="25%">Tgl. Mulai</th>
                                            <th width="20%">Tgl. Selesai</th>
                                            <th width="5%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>

                                        <!-- ijin lab -->
                                        <?php
                                        $query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE prodi='$jurusan' AND validasifakultas=1 ORDER BY prodi");
                                        while ($data = mysqli_fetch_array($query)) {
                                            $nodata = $data['no'];
                                            $nama = $data['nama'];
                                            $jurusan = $data['prodi'];
                                            $jenissurat = 'Ijin Penggunaan Laboratorium';
                                            $validasifakultas = $data['validasifakultas'];
                                            $keterangan = $data['keterangan'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $jurusan; ?></td>
                                                <td><?php echo $nama; ?></td>
                                                <td><?php echo $jenissurat; ?></td>
                                                <td><?php echo $keterangan; ?></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm" href="../mahasiswa/lab-cetak.php?<?= $nodata; ?>" target="_blank">
                                                        <i class="fas fa-print"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                        <!-- /ijin lab -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>


            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- footer -->
        <?php include '../system/footerdsn.html' ?>
        <!-- /.footer -->

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
</body>

</html>