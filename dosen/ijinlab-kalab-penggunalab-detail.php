<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['hakakses'] != "dosen") {
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
                            <h3>Pengajuan Ijin Penggunaan Laboratorium</h3>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- dapatkan no surat -->
            <?php
            $nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
            ?>

            <!-- ambil data ijin lab dari tabel ijinlab -->
            <?php
            $query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE no = '$nodata'");
            $cek = mysqli_num_rows($query);
            if ($cek > 0) {
                $data = mysqli_fetch_array($query);
                $nama = $data['nama'];
                $tanggal = $data['tanggal'];
                $nim = $data['nim'];
                $ttl = $data['ttl'];
                $alamatasal = $data['alamatasal'];
                $alamatmalang = $data['alamatmalang'];
                $nohp = $data['nohp'];
                $nohportu = $data['nohportu'];
                $riwayatpenyakit = $data['riwayatpenyakit'];
                $posisi = $data['posisi'];
                $prodi = $data['prodi'];
                $namalab = $data['namalab'];
                $dosen = $data['dosen'];
                $tglmulai = $data['tglmulai'];
                $tglselesai = $data['tglselesai'];
                $lamp1 = $data['lamp1'];
                $lamp4 = $data['lamp4'];
                $lamp5 = $data['lamp5'];
                $lamp6 = $data['lamp6'];
                $lamp7 = $data['lamp7'];
                $lamp8 = $data['lamp8'];
                $validator0 = $data['validator0'];
                $tglvalidasi0 = $data['tglvalidasi0'];
            }
            ?>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Pengajuan Surat Mahasiswa </h3>
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
                                        <?php
                                        if (isset($_GET['pesan'])) {
                                            if ($_GET['pesan'] == "penuh") {
                                        ?>
                                                <div class="alert alert-danger alert-dismissible fade show">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong>ERROR!!</strong> kapasitas lab penuh
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-one-datadiri" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                <label>Tanggal Pengajuan</label> <br />
                                                <input type="text" class="form-control" name="tanggal" value="<?= tgljam_indo($tanggal); ?>" readonly></input>
                                                <label>Nama</label> <br />
                                                <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly></input>
                                                <label>NIM</label><br />
                                                <input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>" readonly></input>
                                                <label>Tempat / Tgl. Lahir </label><br />
                                                <input type="text" class="form-control" name="ttl" value="<?php echo $ttl; ?>" readonly></input>
                                                <label>Alamat Asal </label><br />
                                                <textarea class="form-control" rows="3" id="alamatasal" name="alamatasal" readonly><?php echo $alamatasal; ?></textarea>
                                                <label>Alamat Di Malang </label><br />
                                                <textarea class="form-control" rows="3" id="alamatmalang" name="alamatmalang" readonly><?php echo $alamatmalang; ?></textarea>
                                                <label>No. HP</label><br />
                                                <input type="text" class="form-control" name="nohp" value="<?php echo $nohp; ?>" readonly></input>
                                                <label>No. HP Orang Tua / Wali</label><br />
                                                <input type="text" class="form-control" name="nohportu" value="<?php echo $nohportu; ?>" readonly></input>
                                                <label>Riwayat Penyakit</label><br />
                                                <textarea class="form-control" rows="3" id="riwayatpenyakit" name="riwayatpenyakit" readonly><?php echo $riwayatpenyakit; ?></textarea>
                                                <label>Posisi saat mendaftar</label><br />
                                                <?php
                                                if ($posisi == 'Alamat Asal') {
                                                ?>
                                                    <input type="radio" id="asal" name="posisi" value="Alamat Asal" checked readonly> Alamat Asal<br />
                                                    <input type="radio" id="malang" name="posisi" value="Alamat di malang" readonly> Alamat di Malang<br />
                                                    <br />
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="radio" id="asal" name="posisi" value="Alamat Asal" readonly> Alamat Asal<br />
                                                    <input type="radio" id="malang" name="posisi" value="Alamat di malang" checked readonly> Alamat di Malang<br />
                                                    <br />
                                                <?php
                                                }
                                                ?>
                                                <label>Program Studi </label><br />
                                                <input type="text" class="form-control" name="prodi" value="<?php echo $prodi; ?>" readonly></input>
                                                <?php
                                                //kapasitas lab
                                                $query2 = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE namalab = '$namalab'");
                                                $data2 = mysqli_fetch_array($query2);
                                                $kapasitas = $data2['kapasitas'];
                                                ?>
                                                <label>Laboratorium </label>
                                                <input type="text" class="form-control" name="namalab" value="<?php echo $namalab; ?>" readonly></input>
                                                <label>Dosen Pembimbing</label><br />
                                                <input type="text" class="form-control" name="nohp" value="<?php echo $dosen; ?>" readonly></input>
                                                <label>Waktu Penggunaan</label>
                                                <form action="ijinlab-kalab-penggunalab-perpanjangan.php" method="POST">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            Tanggal Mulai<br />
                                                            <input type="date" class="form-control" id="tglmulai" name="tglmulai" value="<?= $tglmulai; ?>"></input>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            Tanggal Selesai<br />
                                                            <input type="date" class="form-control" id="tglselesai" name="tglselesai" value="<?= $tglselesai; ?>"></input>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="nodata" value="<?= $nodata; ?>">
                                                    <br />
                                                    <button name="aksi" value="perpanjangan" type="submit" class="btn btn-warning btn-block" onclick="return confirm('Yakin mengubah waktu penelitian ini ?')"> <i class="fa fa-clock"></i> UBAH TANGGAL</button>
                                                </form>
                                                <br />
                                                <label>Lampiran</label> <br />
                                                <small style="color:red">Klik pada gambar untuk memperbesar</small>
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p class="text-center">Lampiran-1</p>
                                                            <?php
                                                            if ($lamp1 == '') {
                                                                $namafile = '../img/noimage.gif';
                                                            } else {
                                                                $namafile = $lamp1;
                                                            }
                                                            ?>
                                                            <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-center">Lampiran-4</p>
                                                            <?php
                                                            if ($lamp4 == '') {
                                                                $namafile = '../img/noimage.gif';
                                                            } else {
                                                                $namafile = $lamp4;
                                                            }
                                                            ?>
                                                            <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-center">Lampiran-5</p>
                                                            <?php
                                                            if ($lamp5 == '') {
                                                                $namafile = '../img/noimage.gif';
                                                            } else {
                                                                $namafile = $lamp5;
                                                            }
                                                            ?>
                                                            <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-center">Lampiran-6</p>
                                                            <?php
                                                            if ($lamp6 == '') {
                                                                $namafile = '../img/noimage.gif';
                                                            } else {
                                                                $namafile = $lamp6;
                                                            }
                                                            ?>
                                                            <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-center">Lampiran-7</p>
                                                            <?php
                                                            if ($lamp7 == '') {
                                                                $namafile = '../img/noimage.gif';
                                                            } else {
                                                                $namafile = $lamp7;
                                                            }
                                                            ?>
                                                            <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                        </div>
                                                        <div class="col">
                                                            <p class="text-center">Lampiran-8</p>
                                                            <?php
                                                            if ($lamp8 == '') {
                                                                $namafile = '../img/noimage.gif';
                                                            } else {
                                                                $namafile = $lamp8;
                                                            }
                                                            ?>
                                                            <a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                Keterangan : <br />
                                                <p style="color:red;">Kapasitas Lab. <?= $namalab; ?> saat ini <?= $kapasitas; ?> </p>
                                                Untuk menyelesaikan penelitian ini ubah tanggal selesai sesuai tanggal hari ini kemudian klik tombol <b>SELESAIKAN</b>.
                                                <hr>
                                                <form role="form" method="POST">
                                                    <input type="hidden" name="nodata" value="<?php echo $nodata; ?>"></input>
                                                    <input type="hidden" name="prodi" value="<?php echo $prodi; ?>"></input>
                                                    <input type="hidden" name="nim" value="<?php echo $nim; ?>"></input>
                                                    <input type="hidden" name="nama" value="<?php echo $nama; ?>"></input>
                                                    <input type="hidden" name="namalab" value="<?php echo $namalab; ?>"></input>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <button name="aksi" value="setujui" type="submit" formaction="ijinlab-kalab-penggunalab-selesaikan.php" class="btn btn-danger btn-block" onclick="return confirm('Apakah anda yakin akan menyelesaikan penelitian ini ?')"> <i class="fa fa-times"></i> SELESAIKAN</button>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <button name="aksi" value="tolak" type="submit" formaction="ijinlab-kalab-penggunalab-tampil.php" class="btn btn-secondary btn-block"> <i class="fa fa-arrow-left"></i> Kembali</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <?php include 'footerdsn.php' ?>
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