<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['jabatan'] != "kabag") {
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
						<div class="col-sm-6">
							<h3>Pengajuan <i>Work From Home</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- get data pengajuan wfh -->
				<?php
				//get data wfh from table wfh
				$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
				$query = mysqli_query($dbsurat, "select * from wfh where no='$nodata'");
				$data = mysqli_fetch_array($query);
				$namadosen = $data['nama'];
				$nipdosen = $data['nip'];
				$prodidosen = mysqli_real_escape_string($dbsurat, $data['prodi']);
				$tglwfh1 = mysqli_real_escape_string($dbsurat, $data['tglwfh1']);
				$kegiatan1 = mysqli_real_escape_string($dbsurat, $data['kegiatan1']);
				$tglwfh2 = mysqli_real_escape_string($dbsurat, $data['tglwfh2']);
				$kegiatan2 = mysqli_real_escape_string($dbsurat, $data['kegiatan2']);
				$tglwfh3 = mysqli_real_escape_string($dbsurat, $data['tglwfh3']);
				$kegiatan3 = mysqli_real_escape_string($dbsurat, $data['kegiatan3']);
				$tglwfh4 = mysqli_real_escape_string($dbsurat, $data['tglwfh4']);
				$kegiatan4 = mysqli_real_escape_string($dbsurat, $data['kegiatan4']);
				$tglwfh5 = mysqli_real_escape_string($dbsurat, $data['tglwfh5']);
				$kegiatan5 = mysqli_real_escape_string($dbsurat, $data['kegiatan5']);
				$verifikasiprodi = mysqli_real_escape_string($dbsurat, $data['verifikasiprodi']);
				$verifikasifakultas = mysqli_real_escape_string($dbsurat, $data['verifikasifakultas']);
				$keterangan = mysqli_real_escape_string($dbsurat, $data['keterangan']);
				?>


				<div class="content">
					<div class="container-fluid">
						Nama <br />
						<input type="text" class="form-control" name="nama" value="<?= $namadosen; ?>" readonly /></input>
						NIP <br />
						<input type="text" class="form-control" name="niptk" value="<?= $nipdosen; ?>" readonly /></input>
						Program Studi <br />
						<input type="text" class="form-control" name="prodi" value="<?= $prodidosen; ?>" readonly /></input>
						<br />
						<?php $no = 1; ?>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal WFH</th>
									<th>Rencana Kerja</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (date($tglwfh1) != 0) {
								?>
									<tr>
										<td><?= $no; ?></td>
										<td><?= tgl_indo($tglwfh1); ?></td>
										<td><?= ($kegiatan1); ?></td>
									</tr>
								<?php
									$no++;
								}
								?>
								<?php
								if (date($tglwfh2) != 0) {
								?>
									<tr>
										<td><?= $no; ?></td>
										<td><?= tgl_indo($tglwfh2); ?></td>
										<td><?= ($kegiatan2); ?></td>
									</tr>
								<?php
									$no++;
								}
								?>
								<?php
								if (date($tglwfh3) != 0) {
								?>
									<tr>
										<td><?= $no; ?></td>
										<td><?= tgl_indo($tglwfh3); ?></td>
										<td><?= ($kegiatan3); ?></td>
									</tr>
								<?php
									$no++;
								}
								?>
								<?php
								if (date($tglwfh4) != 0) {
								?>
									<tr>
										<td><?= $no; ?></td>
										<td><?= tgl_indo($tglwfh4); ?></td>
										<td><?= ($kegiatan4); ?></td>
									</tr>
								<?php
									$no++;
								}
								?>
								<?php
								if (date($tglwfh5) != 0) {
								?>
									<tr>
										<td><?= $no; ?></td>
										<td><?= tgl_indo($tglwfh5); ?></td>
										<td><?= ($kegiatan5); ?></td>
									</tr>
								<?php
									$no++;
								}
								?>
							</tbody>
						</table>
						<form role="form" method="POST">
							<input type="hidden" name="nodata" value="<?= $nodata; ?>"></input>
							<div class="row">
								<div class="col-lg-6">
									<button name="aksi" value="setujui" type="submit" formaction="wfh-kabag-setujui.php" class="btn btn-success btn-block" onclick="return confirm('Apakah anda menyetujui pengajuan ini ?')"> <i class="fa fa-check"></i> Setujui</button>
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
											<button name="aksi" value="tolak" type="submit" formaction="wfh-kabag-tolak.php" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menolak pengajuan ini ?')"> <i class="fa fa-times"></i> Tolak</button>
										</div>
									</div>
								</div>
							</div>
							<!-- ./modal tolak-->
						</form>
					</div><!-- /.container-fluid -->
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- footer -->
		<?php require 'footerdsn.php' ?>
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