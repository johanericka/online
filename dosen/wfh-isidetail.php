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
if ($_SESSION['role'] != "Dosen") {
	if ($_SESSION['role'] != "koorpkl") {
		header("location:../index.php?pesan=noaccess");
	}
}
?>

<?php
$iduser = $_SESSION['iduser'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$status = $_SESSION['status'];
$jurusan = $_SESSION['jurusan'];
$tgl1 = $_POST['tgl1'];
$tgl2 = $_POST['tgl2'];
if ($_SESSION['role'] == 'koorpkl') {
	$jabatan = "Dosen";
} else {
	//khusus pak Anas
	if ($iduser == '61018') {
		$jabatan = "Tenaga Kependidikan";
	} else {
		$jabatan = "Dosen";
	}
}
$fakultas = "Sains dan Teknologi";
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
							<h3>Isi Rencana Kerja <i>Work From Home</i></h3>
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
							NIP / ID SIAKAD<br />
							<input type="text" class="form-control" name="nip" value="<?php echo $nip; ?>" readonly /></input>
							Jabatan <br />
							<input type="text" class="form-control" name="jabatan" value="<?php echo $jabatan; ?>" readonly /></input>
							Program Studi <br />
							<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly /></input>
							<input type="hidden" class="form-control" name="fakultas" value="<?php echo $fakultas; ?>" readonly /></input>
							<input type="hidden" name="tgl1" value=<?= $tgl1; ?> />
							<input type="hidden" name="tgl2" value=<?= $tgl2; ?> />
							<br />
							<?php
							while (strtotime($tgl1) <= strtotime($tgl2)) {
								//$jmlhari = (strtotime($tgl2) - strtotime($tgl1)) / 60 / 60 / 24;
								//if ($jmlhari > 5) {
								//	$tgl2 = date('Y-m-d', strtotime($tgl1 . " +5 days"));
								//echo "Tanggal Selesai baru ".$tglselesai;
								//}
								if ((date('w', strtotime($tgl1)) == '6') or (date('w', strtotime($tgl1)) == '0')) {
								} else {
							?>
									<b>Rencana Kerja <?= hari_indo($tgl1); ?>, <?= tgl_indo($tgl1); ?></b>
									<textarea class="form-control" rows="3" id="<?= strtotime($tgl1); ?>" name="<?= strtotime($tgl1); ?>" placeholder="uraian rencana kegiatan WFH tanggal <?= tgl_indo($tgl1); ?>" /></textarea>
								<?php
								}
								?>


							<?php
								$tgl1 = date("Y-m-d", strtotime("+1 days", strtotime($tgl1)));
							}
							?>
							<br />

							<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Ajukan</button>
						</form>
					</div>
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

function hari_indo($tanggal)
{
	$day = date('w', strtotime($tanggal));
	$hari = array(
		0 =>   'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
	);
	return $hari[(int)$day];
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