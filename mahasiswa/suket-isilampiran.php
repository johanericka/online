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
		<?php require('sidebar.php'); ?>
		<!-- ./Main Sidebar Container -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-12">
							<h3>Pengajuan Surat Keterangan</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<?php
			$qsql = mysqli_query($dbsurat, "SELECT * FROM suket WHERE nim='$nim' AND statussurat=-1");
			$dsurat = mysqli_fetch_array($qsql);
			$nodata = $dsurat['no'];
			$jenissurat = $dsurat['jenissurat'];
			$keperluan = $dsurat['keperluan'];
			?>
			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
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
							<label>Nama</label>
							<input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
							<label>NIM</label>
							<input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
							<label>Program Studi</label>
							<input type="text" class="form-control" name="prodi" value="<?= $prodi; ?>" readonly /></input>
							<br />
							<label>Mengajukan permohonan</label>
							<br />
							<input type="text" class="form-control" name="jenissurat" value="<?= $jenissurat; ?>" readonly /></input>
							<label>Keperluan</label>
							<input type="text" class="form-control" name="keperluan" value="<?= $keperluan; ?>" readonly /></input>
							<br />
							<form action="suket-upload.php" method="post" enctype="multipart/form-data">
								<label>Lampiran</label>
								<br />
								<small>Lampirkan dokumen pendukung apabila ada</small>
								<br />
								<label>File</label>
								<br />
								<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
								<br />
								<small style="color:red">Format file JPG/JPEG ukuran maksimal 1MB</small>
								<br />
								<br />
								<input type="hidden" name="nodata" value="<?= $nodata; ?>">
								<button type="submit" class="btn btn-primary btn-block" value="Upload Lampiran" name="submit"><i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
							</form>
							<br />
							<!--tampilkan lampiran-->
							<?php
							$qlampiran = mysqli_query($dbsurat, "SELECT * FROM suket WHERE no='$nodata' AND nim='$nim'");
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
							<form role="form" method="post" action="suket-ajukan.php">
								<input type="hidden" name="nodata" value="<?= $nodata; ?>">
								<button type="submit" class="btn btn-success btn-block" onclick="return confirm('Dengan ini saya menyatakan bahwa data yang saya isi adalah benar')"> <i class="fa fa-check"></i> Ajukan</button>
							</form>
						</div><!-- /.container-fluid -->
					</div>
					<!-- /.content -->
				</div>
				<!-- /.content-wrapper -->
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