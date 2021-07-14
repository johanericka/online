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
	<!-- overlayScrollbars -->
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
if ($_SESSION['role'] != "kajur") {
	if ($_SESSION['role'] != "kabag") {
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
$role = $_SESSION['role'];
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
			<a href="" class="brand-link">
				<img src="../system/uin-malang-logo.png" alt="UIN Malang" class="brand-image img-circle elevation-3" style="opacity: .8">
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
							<a href="bimbingan-tampil.php" class="nav-link">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Mhs. Bimbingan
									<span class="right badge badge-danger"></span>
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview menu-close">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-home"></i>
								<p>
									Work From Home
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="wfh-isi.php" class="nav-link">
										<i class="nav-icon fas fa-envelope"></i>
										<p>
											Pengajuan WFH
											<span class="right badge badge-danger"></span>
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="wfh-rekap.php" class="nav-link">
										<i class="nav-icon fas fa-envelope-open"></i>
										<p>
											Rekap. Pengajuan WFH
											<span class="right badge badge-danger"></span>
										</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="notifikasi-isi.php" class="nav-link">
								<i class="nav-icon fas fa-bullhorn"></i>
								<p>
									Kirim Notifikasi
									<span class="right badge badge-danger"></span>
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview menu-close">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-file"></i>
								<p>
									Dokumen
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="http://saintek.uin-malang.ac.id/online/doc/se92-2021.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>SE Rektor UIN Malang</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="http://saintek.uin-malang.ac.id/online/doc/panduandosen.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>Panduan Pengajuan WFH</p>
									</a>
								</li>
								<?php if ($iduser == '62007') { ?>
									<li class="nav-item">
										<a href="http://saintek.uin-malang.ac.id/online/doc/panduankajur.pdf" target="_blank" class="nav-link">
											<i class="far fa-file-pdf"></i>
											<p>Panduan Verifikasi WFH</p>
										</a>
									</li>
								<?php
								}
								?>
							</ul>
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
								<i class="nav-icon fas fa-window-close"></i>
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
							<h3></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- pengajuan surat mahasiswa -->
			<section class="content">
				<!-- Default box -->
				<div class="card card-warning">
					<div class="card-header">
						<h3 class="card-title">Pengajuan Surat Mahasiswa </h3>
						<!-- card minimize -->
						<div class="card-tools">
							<!-- This will cause the card to maximize when clicked 
							<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>-->
							<!-- This will cause the card to collapse when clicked -->
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							<!-- This will cause the card to be removed when clicked
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
						</div>
					</div>
					<!-- /.card-header -->
					<?php $no = 1; ?>
					<div class="card-body p-0">
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="5%" style="text-align:center">No</th>
										<th width="10%" style="text-align:center">NIM</th>
										<th style="text-align:center">Nama</th>
										<th style="text-align:center">Surat</th>
										<th width="10%" colspan="2" style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>

									<!-- PKL Koordinator-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validatorkoor='$iduser' AND validasikoordinator = 0");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin PKL';
										$validasikoordinator = $data['validasikoordinator'];
										$validasijurusan = $data['validasijurusan'];
										$validasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="pkl-tampil.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /. PKL koordinator-->

									<!-- PKL Kajur-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validatorjurusan='$iduser' AND validasijurusan = 0 AND validasikoordinator = 1");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin PKL';
										$validasikoordinator = $data['validasikoordinator'];
										$validasijurusan = $data['validasijurusan'];
										$validasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($validasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="pkl-tampil.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /. PKL Kajur-->

									<!-- ijin lab as dosen-->
									<?php
									$query = mysqli_query($dbsurat, "select * from ijinlab where validatordosen='$iduser' AND validasidosen = 0");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Penggunaan Laboratorium';
										$verifikasidosen = $data['verifikasidosen'];
										$verifikasijurusan = $data['verifikasijurusan'];
										$verifikasifakultas = $data['verifikasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="lab-tampildsn.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /.ijin lab -->

									<!-- ijin lab as kajur-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE validatorjurusan='$iduser' AND validasijurusan = 0 AND validasidosen=1");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Penggunaan Laboratorium';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="lab-tampil.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /.ijin lab -->

									<!-- ijin penelitian as dosen pembimbing-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validatordosen='$iduser' AND validasidosen = 0");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Penelitian';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="ijinpenelitian-tampil2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /.ijin penelitian as dosen pembimbing -->

									<!-- ijin penelitian as kajur-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validatorjurusan='$iduser' AND validasijurusan = 0 AND validasidosen = 1");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Penelitian';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="ijinpenelitian-tampil.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /.ijin penelitian as kajur-->

									<!-- peminjaman alat as dosbing -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE validatordosen='$iduser' AND validasidosen = 0");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Peminjaman Alat';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="peminjamanalat-tampil2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /peminjaman alat -->

									<!-- peminjaman alat as kajur-->
									<?php
									$sql = "SELECT * FROM peminjamanalat WHERE validatorjurusan='$iduser' AND validasijurusan=0 AND validasidosen=1";
									$query = mysqli_query($dbsurat, $sql);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Peminjaman Alat';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="peminjamanalat-tampil.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /peminjaman alat as kajur -->

									<!-- Observasi as dosbing-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validatordosen='$iduser' AND validasidosen = 0");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Observasi';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="observasi-tampildsn.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /Observasi -->

									<!-- Observasi as kajur-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validatorjurusan='$iduser' AND validasijurusan=0 AND validasidosen=1");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Observasi';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="observasi-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /Observasi -->

									<!-- pengambilandata as dosen pembimbing-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validatordosen='$iduser' AND validasidosen = 0");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Pengambilan Data';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="pengambilandata-tampil2.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /pengambilandata -->

									<!-- pengambilandata as kajur-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validatorjurusan='$iduser' AND validasijurusan = 0 AND validasidosen=1");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Pengambilan Data';
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="pengambilandata-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /pengambilandata as kajur-->

									<!-- Surat Keterangan as dosen wali-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validatordosen='$iduser' AND validasidosen is null");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = $data['jenissurat'];
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($verifikasidosen == 0) {
												?>
													<a class="btn btn-info btn-sm" href="suket-tampil2.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /Surat Keterangan as dosen wali-->

									<!-- Surat Keterangan as Kajur-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validatorjurusan='$iduser' AND validasijurusan= 0 AND validasidosen = 1");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$jurusan = $data['jurusan'];
										$surat = $data['jenissurat'];
										$verifikasidosen = $data['validasidosen'];
										$verifikasijurusan = $data['validasijurusan'];
										$verifikasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<a class="btn btn-info btn-sm" href="suket-tampil.php?nodata=<?php echo $nodata; ?>">
													<i class="fas fa-search">
													</i>
													Lihat
												</a>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /Surat Keterangan -->

									<!-- cetak KHS-->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE validatorjurusan='$iduser' AND validasijurusan = 0");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['id'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$jurusan = $data['jurusan'];
										$surat = 'Permohonan Cetak KHS';
										$validasijurusan = $data['validasijurusan'];
										$validasifakultas = $data['validasifakultas'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<?php
												if ($validasifakultas == 0) {
												?>
													<a class="btn btn-info btn-sm" href="cetakkhs-tampil.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /.Cetak KHS-->

									<!-- SKPI as Dosen PA -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE verifikator1='$iduser' AND verifikasi1=0");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = "Surat Keterangan Pendamping Ijazah";
										$verifikator1 = $data['verifikator1'];
										$qdosenwali = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode='$verifikator1'");
										$ddosenwali = mysqli_fetch_array($qdosenwali);
										$dosenwali = $ddosenwali['nama'];
										$verifikasi1 = $data['verifikasi1'];
										$verifikasi2 = $data['verifikasi2'];
										$verifikasi3 = $data['verifikasi3'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?><br />
												Dosen Wali = <?= $dosenwali; ?>
											</td>
											<td>
												<?php
												if ($verifikasi1 == 0) {
												?>
													<a class="btn btn-info btn-sm" href="skpi-tampil.php?nim=<?php echo mysqli_real_escape_string($dbsurat, $nim); ?>">
														<i class="fas fa-search">
														</i>
														Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /SKPI as Dosen PA -->

									<!-- SKPI as kajur -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE verifikator2='$iduser' AND verifikasi2=0 AND verifikasi1=1");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = "Surat Keterangan Pendamping Ijazah";
										$verifikator1 = $data['verifikator1'];
										$qdosenwali = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode='$verifikator1'");
										$ddosenwali = mysqli_fetch_array($qdosenwali);
										$dosenwali = $ddosenwali['nama'];
										$verifikasi1 = $data['verifikasi1'];
										$verifikasi2 = $data['verifikasi2'];
										$verifikasi3 = $data['verifikasi3'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td><?php echo $surat; ?><br />
												Dosen Wali = <?= $dosenwali; ?>
											</td>
											<td>
												<?php
												if ($verifikasi2 == 0) {
												?>
													<a class="btn btn-info btn-sm" href="skpi-tampil2.php?nim=<?php echo mysqli_real_escape_string($dbsurat, $nim); ?>">
														<i class="fas fa-search"></i>Lihat
													</a>
												<?php
												};
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /SKPI as kajur -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
			<!-- data pengajuan WFH -->

			<!-- verifikasi WFH -->
			<section class="content">
				<!-- Default box -->
				<div class="card card-success">
					<div class="card-header">
						<h3 class="card-title">Verifikasi Surat Tugas <i>Work From Home</i></h3>
					</div>
					<!-- /.card-header -->
					<?php $no = 1; ?>
					<div class="card-body p-0">
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Program Studi</th>
										<th>Nama</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM wfh WHERE verifikasijurusan=0 and verifikatorjurusan='$iduser'");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data[0];
										$jurusanstaf = $data[2];
										$nipstaf = $data[4];
										$namastaf = $data[6];
										$verifikasijurusan = $data[12];
										$verifikasifakultas = $data[16];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $jurusanstaf; ?></td>
											<td><?php echo $namastaf; ?></td>
											<td>
												<a class="btn btn-info btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
													<i class="fas fa-search">
													</i>
													Lihat
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
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<!-- /.content -->
				</div>
			</section>

			<!-- data pengajuan pribadi -->
			<section class="content">
				<!-- Default box -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Rencana Kerja dan Surat Tugas <i>Work From Home</i></h3>
						<!-- card minimize -->
						<div class="card-tools">
							<!-- This will cause the card to maximize when clicked 
							<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>-->
							<!-- This will cause the card to collapse when clicked -->
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							<!-- This will cause the card to be removed when clicked
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
						</div>
					</div>
					<!-- /.card-header -->
					<?php $no = 1; ?>
					<div class="card-body p-0">
						<!-- /.card-header -->
						<div class="card-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Mulai WFH</th>
										<th>Akhir WFH</th>
										<th>Rencana Kerja</th>
										<th>Surat Tugas</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query = mysqli_query($dbsurat, "select * from wfh where iduser='$iduser' order by tglwfh1 desc");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$tglwfh1 = $data['tglwfh1'];
										$tglwfh2 = $data['tglwfh2'];
										$tglwfh3 = $data['tglwfh3'];
										$tglwfh4 = $data['tglwfh4'];
										$tglwfh5 = $data['tglwfh5'];
										$verifikasijurusan = $data['verifikasijurusan'];
										$verifikasifakultas = $data['verifikasifakultas'];
										if (date($tglwfh5) != 0) {
											$wfhselesai = $tglwfh5;
										} else {
											if (date($tglwfh4) != 0) {
												$wfhselesai = $tglwfh4;
											} else {
												if (date($tglwfh3) != 0) {
													$wfhselesai = $tglwfh3;
												} else {
													if (date($tglwfh2) != 0) {
														$wfhselesai = $tglwfh2;
													}
												}
											}
										}
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php if (date($tglwfh1) != 0) {
													echo tgl_indo($tglwfh1);
												}  ?></td>
											<td><?php echo tgl_indo($wfhselesai);

												?>
											</td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="wfh-tampil2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														<!--Lihat-->
													</a>
												<?php
												};
												?>
												<?php
												if ($verifikasijurusan == 1) {
												?>
													<a class="btn btn-success btn-sm" href="wfh-cetakrk.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-print">
														</i>
														<!--Cetak-->
													</a>
												<?php
												};
												?>
												<?php
												if ($verifikasijurusan == 2) {
												?>
													<a class="btn btn-danger btn-sm" href="wfh-tampil2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-times">
														</i>
														<!--Cek-->
													</a>
												<?php
												};
												?>


											</td>
											<td>
												<?php
												if ($verifikasijurusan < 2 and $verifikasifakultas == 0) {
												?>
													<a class="btn btn-info btn-sm" href="wfh-tampil2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-search">
														</i>
														<!--Lihat-->
													</a>
												<?php
												};
												?>
												<?php
												if ($verifikasijurusan < 2 and $verifikasifakultas == 1) {
												?>
													<a class="btn btn-success btn-sm" href="wfh-cetakst.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-print">
														</i>
														<!--Cetak-->
													</a>
												<?php
												};
												?>
												<?php
												if ($verifikasijurusan < 2 and $verifikasifakultas == 2) {
												?>
													<a class="btn btn-danger btn-sm" href="wfh-tampil2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-times">
														</i>
														<!--Cek-->
													</a>
												<?php
												};
												?>
											</td>
											<td>
												<?php
												if (($verifikasijurusan == 0 and $verifikasifakultas == 0) or ($verifikasijurusan == 2) or ($verifikasifakultas == 2)) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="wfh-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash">
														</i>
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
								</tbody>
							</table>
						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					<!-- /.content -->
				</div>
			</section>
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
	<!-- AdminLTE for demo purposes -->
	<script src="../system/dist/js/demo.js"></script>
</body>
<!-- tanggal indonesia -->
<?php
function tgl_indo($tanggal)
{
	if (isset($tanggal)) {
		$bulan = array(
			1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}
}
?>

</html>