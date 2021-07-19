<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../deauth.php");
}
require('../system/dbconn.php');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
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
							<h3>Pengajuan Surat Pengantar PKL / Magang</h3>
							<div class="alert alert-warning alert-dismissible fade show">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>PERHATIAN!!</strong> Cukup ketua kelompok yang mengajukan
							</div>
						</div>

					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<?php
							if (isset($_GET['pesan'])) {
								if ($_GET['pesan'] == "gagal") {
							?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR!</strong> Upload file gagal
									</div>
								<?php
								} else if ($_GET['pesan'] == "filesize") {
								?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR! </strong> ukuran file terlalu besar
									</div>
								<?php
								} else if ($_GET['pesan'] == "extention") {
								?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR! </strong> format file harus JPG/JPEG
									</div>
								<?php
								} else if ($_GET['pesan'] == "registered") {
								?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR!</strong> Anda telah terdaftar<br />
										Klik Lupa Password apabila anda lupa password
									</div>
								<?php
								} else if ($_GET['pesan'] == "success") {
								?>
									<div class="alert alert-success alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>BERHASIL! </strong> upload file berhasil
									</div>
								<?php
								} else if ($_GET['pesan'] == "noaccess") {
								?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR! </strong> Anda tidak memiliki akses
									</div>
								<?php
								} else if ($_GET['pesan'] == "antibot") {
								?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR! </strong> penjumlahan salah
									</div>
							<?php
								}
							}
							?>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Lampiran Pakta Integritass</h3>
								</div>
								<div class="card-body">
									<b>Lampiran 1 - Pakta Integritas</b>
									<br />
									Upload Pakta Integritas PKL / Magang <a href="../doc/paktaintegritaspkl.docx" target="_blank"><b>Download disini </b></a>
									<br />
									<form action="pkl-isilampiran-upload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
										<input type="file" name="fileToUpload" class="form-control" />
										<small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPEG / JPG</i></small>
										<br />
										<input type="hidden" name="nodata" value="<?= $nodata; ?>" />
										<button class="btn btn-block btn-primary btn-upload" name="fileToUpload" value="fileToUpload"><i class="fa fa-file-upload"></i> Upload Pakta Integritas PKL / Magang</button>
									</form>
									<br />
									<!--tampilkan lampiran-->
									<?php
									$qlampiran = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE no='$nodata' AND nim='$nim'");
									$dlampiran = mysqli_fetch_array($qlampiran);
									$lampiran = $dlampiran['lampiran'];
									?>
									<div class="container-fluid">
										<div class="row">
											<div class="col">
												<?php
												if ($lampiran == '') {
													$namafile = 'noimage.gif';
												} else {
													$namafile = $lampiran;
												}
												?>
												Lampiran
												<br />
												<a href="../img/<?= $namafile; ?>" target="_blank"><img src="../img/<?= $namafile; ?>" class="img-fluid"></img></a>
											</div>
										</div>
									</div>
									<br />

									<br />
									<?php
									if ($lampiran <> '') {
									?>
										<a href="pkl-ajukan.php?nodata=<?= $nodata; ?>" class="btn btn-success btn-block"><i class="fa fa-check "></i> Ajukan Pegantar PKL </a>
									<?php
									} else {
									?>
										<a href="#" class="btn btn-success btn-block disabled"><i class="fa fa-check"></i> Ajukan Pegantar PKL </a>
									<?php
									}
									?>
								</div>
							</div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- footer -->
		<?php include '../system/footer.html' ?>
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

<!-- alert upload file -->
<?php
if (isset($_GET['error'])) {
	if ($_GET['error'] == 0) {
?>
		<div class="alert alert-info alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Info : </strong> File berhasil di upload.
		</div>
	<?php
	} else if ($_GET['error'] == 1) {
	?>
		<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>ERROR : </strong> ukuran file maksimal 1MB.
		</div>
	<?php
	} else if ($_GET['error'] == 2) {
	?>
		<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>ERROR : </strong> ketika upload file.
		</div>
	<?php
	} else if ($_GET['error'] == 3) {
	?>
		<div class="alert alert-danger alert-dismissible fade show">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>ERROR : </strong> hanya menerima file .JPG / .JPEG.
		</div>
<?php
	}
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