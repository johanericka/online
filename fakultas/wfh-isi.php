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

<!-- location sharing -->
<?php
$lokasi = "coming soon ...";
?>

<!-- akses ke database -->
<?php require_once('../system/dbconn.php'); ?>


<!-- cek session -->
<?php
session_start();
if ($_SESSION['role'] != "wakildekan") {
	header("location:../index.php?pesan=belum_login");
}
?>
<?php
$iduser = $_SESSION['iduser'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$status = $_SESSION['status'];
$jurusan = $_SESSION['jurusan'];
if ($iduser == '63007') {
	$jabatan = "Wakil Dekan Bidang Akademik";
}
if ($iduser == '62007') {
	$jabatan = "Wakil Dekan Bidang AUPK";
}
if ($iduser == '64005') {
	$jabatan = "Wakil Dekan Bidang Kemahasiswaan & Kerja Sama";
}
$fakultas = "Sains dan Teknologi";
$jurusan = $fakultas;
if ($iduser == '55022') {
	$jurusan = "Teknik Informatika";
}
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
			<a href="../../system/index3.html" class="brand-link">
				<img src="../system/uin-malang-logo.png" alt="../../system Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">UIN Malang</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional)-->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="info">
						<a href="#" class="d-block"><?php echo $nama; ?></a>
						<a href="#" class="d-block">NIP : <?php echo $nip; ?></a>
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
						<li class="nav-item">
							<a href="https://wa.me/6281234302099" class="nav-link">
								<i class="nav-icon fas fa-question-circle"></i>
								<p>
									Bantuan
									<span class="right badge badge-danger"></span>
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../logout.php" class="nav-link">
								<i class="nav-icon fas fa-user"></i>
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
							<h3>Pengajuan <i>Work From Home</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="content">
					<div class="container-fluid">
						<form role="form" method="post" action="wfh-simpan.php">
							<input type="hidden" class="form-control" name="iduser" value="<?php echo $iduser; ?>" readonly /></input>
							Nama <br />
							<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly /></input>
							NIP <br />
							<input type="text" class="form-control" name="nip" value="<?php echo $nip; ?>" readonly /></input>
							Jabatan <br />
							<input type="text" class="form-control" name="jabatan" value="<?php echo $jabatan; ?>" readonly /></input>
							Fakultas <br />
							<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly /></input>
							<input type="hidden" class="form-control" name="fakultas" value="<?php echo $fakultas; ?>" readonly /></input>
							<br />
							<b>Rencana Kerja WFH 1</b><br>
							<div class="form-group">
								Tanggal
								<input type="date" id="tgl1" name="tgl1">
							</div>
							Kegiatan
							<textarea class="form-control" rows="3" id="kegiatan1" name="kegiatan1" placeholder="uraian kegiatan" /></textarea>
							<b>Rencana Kerja WFH 2</b><br>
							<div class="form-group">
								Tanggal
								<input type="date" id="tgl2" name="tgl2">
							</div>
							<label>Kegiatan</label>
							<textarea class="form-control" rows="3" id="kegiatan2" name="kegiatan2" placeholder="uraian kegiatan" /></textarea>
							<b>Rencana Kerja WFH 3</b><br>
							<div class="form-group">
								Tanggal
								<input type="date" id="tgl3" name="tgl3">
							</div>
							<label>Kegiatan</label>
							<textarea class="form-control" rows="3" id="kegiatan3" name="kegiatan3" placeholder="uraian kegiatan" /></textarea>
							<b>Rencana Kerja WFH 4</b><br>
							<div class="form-group">
								Tanggal
								<input type="date" id="tgl4" name="tgl4">
							</div>
							<label>Kegiatan</label>
							<textarea class="form-control" rows="3" id="kegiatan4" name="kegiatan4" placeholder="uraian kegiatan" /></textarea>
							<b>Rencana Kerja WFH 5</b><br>
							<div class="form-group">
								Tanggal
								<input type="date" id="tgl5" name="tgl5">
							</div>
							<label>Kegiatan</label>
							<textarea class="form-control" rows="3" id="kegiatan5" name="kegiatan5" placeholder="uraian kegiatan" /></textarea>

							<br />
							<!-- /.form group -->
							<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Ajukan</button>
						</form>
					</div><!-- /.container-fluid -->
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- footer -->
		<?php include '../system/footerdsn.html' ?>
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

<!-- timer untuk alert -->
<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 1000);
</script>

</html>