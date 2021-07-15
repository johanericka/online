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

//cek kalo sudah mengisi data maka lanjut ke upload lampiran
$status = -1;
$stmt = $dbsurat->prepare("SELECT * FROM ijinlab WHERE nim=? AND status=?");
$stmt->bind_param("si", $nim, $status);
$stmt->execute();
$result = $stmt->get_result();
$jhasil = $result->num_rows;
if ($jhasil > 0) {
    $dhasil = $result->fetch_array();
    $nodata = $dhasil['no'];
    header("location:ijinlab-isi2.php?nodata=$nodata");
}
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
                            <?= $jhasil; ?>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <!-- card pilihan lab -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Identitas Diri</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form role="form" method="POST" action="ijinlab-isi1-simpan.php">
                                        <label>Nama </label><br />
                                        <input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
                                        <br />
                                        <label>NIM </label> <br />
                                        <input type="number" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
                                        <br />
                                        <label>Program Studi </label><br />
                                        <input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly /></input>
                                        <br />
                                        <label>Tempat / Tgl. Lahir </label><small style="color:red">*</small><br />
                                        <input type="text" class="form-control" name="ttl" placeholder="Tempat / Tgl. Lahir" required>
                                        </input>
                                        <br />
                                        <label>Alamat Asal </label><small style="color:red">*</small><br />
                                        <textarea class="form-control" rows="3" id="alamatasal" name="alamatasal" required></textarea>
                                        <br />
                                        <label>Alamat Di Malang </label><small style="color:red">*</small><br />
                                        <textarea class="form-control" rows="3" id="alamatmalang" name="alamatmalang" required></textarea>
                                        <small style="color:red"><i> tuliskan <b>TIDAK ADA</b> apabila tidak tinggal di Malang </i></small>
                                        <br />
                                        <label>No. HP </label><small style="color:red">*</small><br />
                                        <input type="number" class="form-control" name="nohp" required>
                                        </input>
                                        <br />
                                        <label>No. HP Orang Tua / Wali </label><small style="color:red">*</small><br />
                                        <input type="number" class="form-control" name="nohportu" required>
                                        </input>
                                        <br />
                                        <label>Riwayat Penyakit </label><small style="color:red">*</small><br />
                                        <textarea class="form-control" rows="3" id="riwayatpenyakit" name="riwayatpenyakit" required></textarea>
                                        <small style="color:red"><i> tuliskan <b>TIDAK ADA</b> apabila tidak pernah sakit </i></small>
                                        <br />
                                        <label>Posisi saat mendaftar </label><small style="color:red">* </small><br />
                                        <input type="radio" id="asal" name="posisi" value="Alamat Asal" checked> Alamat Asal<br />
                                        <input type="radio" id="malang" name="posisi" value="Alamat di malang"> Alamat di Malang<br />
                                        <br />
                                        <label>Nama Laboratorium </label><br />
                                        <select name="namalab">
                                            <?php
                                            $sql = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE jurusan like '%$jurusan'");
                                            $jmldata = mysqli_num_rows($sql);
                                            //echo "Jumlah data = ".$jmldata;
                                            while ($data = mysqli_fetch_array($sql)) {
                                                if ($data['kapasitas'] > 0) {
                                            ?>
                                                    <option value="<?php echo $data['namalab']; ?>"><?php echo $data['namalab']; ?></option>;
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <br />
                                        <small style="color:red"><i>Apabila nama lab. tidak ada berarti kapasitas lab. sudah penuh.</i></small>
                                        <br />
                                        <label>Dosen Pembimbing </label><br />
                                        <div class="search-box">
                                            <input type="text" autocomplete="off" placeholder="cari dosen" name="dosen" required>
                                            </input>
                                            <div class="result"></div>
                                        </div>
                                        <small style="color:red"><i> Pilih dari daftar </i></small>
                                        <br />
                                        <label>Waktu Penggunaan </label><small style="color:red"><i>*</i></small>
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
                                        <br />
                                        <input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
                                        <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Dengan ini saya menyatakan bahwa data yang saya isi adalah benar')"> <i class=" fa fa-arrow-right"></i> Selanjutnya <i class="fa fa-arrow-right"></i></button>
                                    </form>
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