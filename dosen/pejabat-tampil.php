<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['nip'] != "198312132019031004") {
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
                        <div class="col-sm-12">
                            <h3>Manajemen Pejabat</h3>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Pejabat Fakultas & Prodi </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <?php $no = 1; ?>
                                <div class="card-body p-0">
                                    <div class="card-body">
                                        <form action="pejabat-simpan.php" method="POST">
                                            <label>Nama</label>
                                            <div class="form-group">
                                                <div class="search-box">
                                                    <input type="text" class="form-control" autocomplete="off" name="dosen" required>
                                                    <div class="result"></div>
                                                </div>
                                            </div>
                                            <label>Program Studi</label>
                                            <select name="prodi" class="form-control">
                                                <option value="SAINTEK">SAINTEK</option>
                                                <?php
                                                $qprodi = mysqli_query($dbsurat, "SELECT * FROM prodi GROUP BY namaprodi");
                                                while ($dprodi = mysqli_fetch_array($qprodi)) {
                                                    $namaprodi = $dprodi['namaprodi'];
                                                ?>
                                                    <option value="<?= $namaprodi; ?>"><?= $namaprodi; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <label>Jabatan</label>
                                            <select name="kdjabatan" class="form-control">s
                                                <option value="dekan">Dekan</option>
                                                <option value="wadek1">Wakil Dekan 1</option>
                                                <option value="wadek2">Wakil Dekan 2</option>
                                                <option value="wadek3">Wakil Dekan 3</option>
                                                <option value="kaprodi">Kaprodi</option>
                                                <option value="sekprodi">Sekprodi</option>
                                                <option value="kabag-tu">Kabag. TU</option>
                                                <option value="kasubag-pak">Kasubag PAK</option>
                                                <option value="kasubag-akademik">Kasubag Akademik</option>
                                                <option value="kasubag-umum">Kasubag Umum</option>
                                            </select>
                                            <hr>
                                            <button name="aksi" value="setujui" type="submit" class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin akan meyimpan data ini ?')"> <i class="fa fa-save"></i> SIMPAN</button>
                                        </form>
                                        <hr>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%" style="text-align:center">No</th>
                                                    <th style="text-align:center">Program Studi</th>
                                                    <th style="text-align:center">Kode Jabatan</th>
                                                    <th style="text-align:center">Nama</th>
                                                    <th style="text-align:center">Tanda Tangan</th>
                                                    <th width="5%" colspan="2" style="text-align:center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $qpejabat = mysqli_query($dbsurat, "SELECT * FROM pejabat ORDER BY prodi, kdjabatan");
                                                while ($qdata = mysqli_fetch_array($qpejabat)) {
                                                    $nodata = $qdata['no'];
                                                    $prodi = $qdata['prodi'];
                                                    $kdjabatan = $qdata['kdjabatan'];
                                                    $nama = $qdata['nama'];
                                                    $nip = $qdata['nip'];
                                                    $nama = $qdata['nama'];
                                                    $jabatan = $qdata['jabatan'];
                                                    $ttd = $qdata['ttd'];
                                                ?>
                                                    <tr>
                                                        <td><?= $no; ?></td>
                                                        <td><?= $prodi; ?></td>
                                                        <td><?= $kdjabatan; ?></td>
                                                        <td><?= $nama; ?></td>
                                                        <td><?= $ttd; ?></td>
                                                        <td>
                                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus data ini ?')" href="pejabat-hapus.php?nodata=<?= $nodata; ?>">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
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

                <div class="content">
                    <div class="container-fluid">
                    </div>
                </div>
            </section>
        </div>

        <!-- footer -->
        <?php
        require('footerdsn.php');
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