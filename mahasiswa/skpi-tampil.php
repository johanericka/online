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
	<!-- data table -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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
if ($_SESSION['role'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}
?>

<?php
$iduser = $_SESSION['iduser'];
$nip = $iduser;
$nama = $_SESSION['nama'];
$status = $_SESSION['status'];
$jurusan = $_SESSION['jurusan'];
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
						<a href="#" class="d-block">Prodi : <?php echo $jurusan; ?></a>
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
					<div class="row mb-6">
						<div class="col-sm-6">
							<h3>Validasi Data SKPI</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<?php
			$nim = mysqli_real_escape_string($dbsurat, $_GET['iduser']);
			$qmhs = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim'");
			$jmldata = mysqli_num_rows($qmhs);
			$data = mysqli_fetch_array($qmhs);
			$namamhs = $data['nama'];
			$jurusanmhs = $data['jurusan'];
			$dosen = $data['verifikator1'];
			?>
			<section class="content">
				<div class="content">
					<div class="container-fluid">
						<label>Nama</label><br />
						<input type="text" class="form-control" name="nama" value="<?= $namamhs; ?>" readonly /></input>
						<label>NIM</label><br />
						<input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
						<label>Program Studi</label><br />
						<input type="text" class="form-control" name="jurusan" value="<?= $jurusanmhs; ?>" readonly /></input>
						<hr>
						<div class="card">
							<div class="card-header">
								<h3 class="card-title"><label>Sertifikat di ajukan</label></h3>
							</div>
							<div class="card-body p-0">
								<table class="table table-striped">
									<thead>
										<tr>
											<th style="width: 10px">No</th>
											<th>Aktivitas</th>
											<th>Indonesia</th>
											<th>English</th>
											<th>Bukti</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;

										$qprestasi = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim' ORDER BY aktivitas ASC, indonesia ASC");
										while ($data = mysqli_fetch_array($qprestasi)) {
											$nodata = $data[0];
											$aktivitas = $data['aktivitas'];
											if (!is_null($aktivitas)) {
										?>
												<tr>
													<form role="form" method="POST">
														<td><?= $no; ?></td>
														<td><?= $data['aktivitas']; ?></td>
														<td><?= $data['indonesia']; ?></td>
														<td><i><?= $data['english']; ?></i></td>
														<td> <a href="<?= urldecode($data['bukti']) ?>" target="_blank">Klik Disini</a> </td>
													</form>
												</tr>
										<?php
											}
											$no++;
										}
										?>
									</tbody>
								</table>
							</div>
						</div>

						<form role="form" method="POST" action="skpi-setujui.php">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title"><label>Capaian Pembelajaran</label></h3>
								</div>
								<div class="card-body">
									<b>Kemampuan Kerja</b><br />
									<?php
									$qcpl = mysqli_query($dbsurat, "SELECT * FROM skpi WHERE cpl='Kemampuan Kerja' AND nim='$nim' AND verifikasi3=1 ORDER BY indonesia");
									while ($cpl = mysqli_fetch_array($qcpl)) {
										$nodata = $cpl['no'];
										$indonesia = $cpl['indonesia'];
										$english = $cpl['english'];

									?>
										<div class="row">
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" onclick="return false;" checked><label class="form-check-label"><?= $indonesia; ?></label>
													<br />
													<input class="form-check-input" type="checkbox" onclick="return false;" checked><label class="form-check-label"><?= $english; ?></label>
												</div>
											</div>
										</div>
									<?php
									}
									?>
									<br />
									<b>Penguasaan Pengetahuan</b>
									<?php
									$qcpl2 = mysqli_query($dbsurat, "SELECT * FROM skpi WHERE cpl='Penguasaan Pengetahuan' AND nim='$nim' AND verifikasi3=1 ORDER BY indonesia");
									while ($cpl2 = mysqli_fetch_array($qcpl2)) {
										$nodata = $cpl2['no'];
										$indonesia = $cpl2['indonesia'];
										$english = $cpl2['english'];
									?>
										<div class="row">
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" onclick="return false;" checked><label class="form-check-label"><?= $indonesia; ?></label>
													<br />
													<input class="form-check-input" type="checkbox" onclick="return false;" checked><label class="form-check-label"><?= $english; ?></label>
												</div>
											</div>
										</div>
									<?php
									}
									?>
									<br />
									<b>Sikap Khusus</b>
									<?php
									$qcpl3 = mysqli_query($dbsurat, "SELECT * FROM skpi WHERE cpl='Sikap Khusus' AND nim='$nim' AND verifikasi3=1 ORDER BY indonesia");
									while ($cpl3 = mysqli_fetch_array($qcpl3)) {
										$nodata = $cpl3['no'];
										$indonesia = $cpl3['indonesia'];
										$english = $cpl3['english'];
									?>
										<div class="row">
											<div class="form-group">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" onclick="return false;" checked><label class="form-check-label"><?= $indonesia; ?></label>
													<br />
													<input class="form-check-input" type="checkbox" onclick="return false;" checked><label class="form-check-label"><?= $english; ?></label>
												</div>
											</div>
										</div>
									<?php
									}
									?>
								</div>
							</div>
							<hr />
						</form>
					</div>
				</div>
			</section>
		</div>

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				<b>Versi</b> 2.1
			</div>
			<strong>Gunakan <a href="https://play.google.com/store/apps/details?id=com.android.chrome&hl=en">Google Chrome</a></strong>
		</footer>

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