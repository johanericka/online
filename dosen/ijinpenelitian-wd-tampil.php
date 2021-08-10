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
							<h3>Pengajuan Surat Ijin Penelitian</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- ambil data dari database-->
			<?php
			$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
			$datamhs = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE no='$nodata'");
			$row = mysqli_fetch_array($datamhs);
			$nim = $row['nim'];
			$nama = $row['nama'];
			$judulskripsi = $row['judulskripsi'];
			$dosen = $row['dosen'];
			$instansi = $row['instansi'];
			$alamat = $row['alamat'];
			$tglmulai = $row['tglmulai'];
			$tglselesai = $row['tglselesai'];
			$validator1 = $row['validator1'];
			$tglvalidasi1 = $row['tglvalidasi1'];
			$validator2 = $row['validator2'];
			$tglvalidasi2 = $row['tglvalidasi2'];
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
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
									</div>
								</div>
								<?php $no = 1; ?>
								<div class="card-body p-0">
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
										<label>Nama</label> <br />
										<input type="text" class="form-control" name="nama" value="<?= $nama ?>" readonly></input>
										<label>NIM</label> <br />
										<input type="text" class="form-control" name="nim" value="<?= $nim ?>" readonly></input>
										<label>Judul Skripsi / penelitian</label> <br />
										<input type="text" class="form-control" name="judulskripsi" value="<?= $judulskripsi; ?>" readonly></input>
										<label>Dosen Pembimbing</label> <br />
										<input type="text" class="form-control" name="dosen" value="<?= $dosen; ?>" readonly></input>
										<label>Instansi</label>
										<input type="text" class="form-control" name="instansi" value="<?= $instansi; ?>" readonly></input>
										<label>Alamat</label>
										<input type="text" class="form-control" name="alamat" value="<?= $alamat; ?>" readonly>
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
										<hr />
										Telah disetujui oleh Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> pada tanggal <?= tgljam_indo($tglvalidasi1); ?> <br />
										Telah disetujui oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> pada tanggal <?= tgljam_indo($tglvalidasi2); ?>
										<hr />
										<form role="form" method="POST">
											<input type="hidden" name="nodata" value="<?php echo $nodata; ?>"></input>
											<div class="row">
												<div class="col-lg-6">
													<button name="aksi" value="setujui" type="submit" formaction="ijinpenelitian-wd-setujui.php" class="btn btn-success btn-block" onclick="return confirm('Apakah anda yakin akan MENYETUJUI pengajuan ini ?')"> <i class="fa fa-check"></i> Setujui</button>
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
															<button name="aksi" value="tolak" type="submit" formaction="ijinpenelitian-wd-tolak.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan MENOLAK pengajuan ini ?')"> <i class="fa fa-times"></i> Tolak</button>
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