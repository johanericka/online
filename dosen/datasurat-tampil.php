<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['jabatan'] != "dosen") {
	header("location:../deauth.php");
}
require('../system/dbconn.php');
require('../system/myfunc.php');
if (isset($nodata)) {
	$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
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
							<h3>Rekap. Pengajuan Surat</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-12">

						<div class="card">
							<div class="card-header">
								<h3 class="card-title">Data Surat</h3>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th width="5%">No.</th>
											<th width="15%">Prodi</th>
											<th width="30%">Nama</th>
											<th width="35%">Jenis Surat</th>
											<th width="10%">Status</th>
											<th width="5%">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>

										<!-- PKL Koordinator-->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										$jmldata = mysqli_num_rows($query);
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$prodi = $data['prodi'];
											$surat = 'Ijin PKL';
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/pkl-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /. PKL koordinator-->

										<!-- ijin lab -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab where validator0='$nip' OR validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										$jmldata = mysqli_num_rows($query);
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$prodi = $data['prodi'];
											$surat = 'Ijin Penggunaan Laboratorium';
											$validasi0 = $data['validasi0'];
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi0 == 1 and $validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi0 == 2 or $validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi0 == 1 and $validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/ijinlab-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi0 == 2 or $validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /.ijin lab -->

										<!-- ijin penelitian -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$prodi = $data['prodi'];
											$surat = 'Ijin Penelitian';
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/ijinpenelitian-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /.ijin penelitian -->

										<!-- peminjaman alat -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$prodi = $data['prodi'];
											$surat = 'Ijin Peminjaman Alat';
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/peminjamanalat-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /peminjaman alat -->

										<!-- Observasi -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$prodi = $data['prodi'];
											$surat = 'Ijin Observasi';
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/observasi-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /Observasi -->

										<!-- pengambilandata -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$prodi = $data['prodi'];
											$nama = $data['nama'];
											$surat = 'Ijin Pengambilan Data';
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/pengambilandata-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /pengambilandata -->

										<!-- Surat Keterangan -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validator1='$nip' OR validator2='$nip' OR validator3='$nip' ORDER BY prodi");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$prodi = $data['prodi'];
											$nama = $data['nama'];
											$surat = $data['jenissurat'];
											$validasi1 = $data['validasi1'];
											$validasi2 = $data['validasi2'];
											$validasi3 = $data['validasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($validasi2 == 1 and $validasi3 == 1) {
															echo 'Disetujui';
														} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../mahasiswa/suket-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /Surat Keterangan -->

										<!-- SKPI -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM skpi WHERE verifikator1='$nip' OR verifikator2='$nip' OR verifikator3='$nip' GROUP BY nim ORDER BY jurusan");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nim = $data['nim'];
											$prodi = $data['jurusan'];
											$nama = $data['nama'];
											$surat = 'SKPI';
											$verifikasi1 = $data['verifikasi1'];
											$verifikasi2 = $data['verifikasi2'];
											$verifikasi3 = $data['verifikasi3'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?= $no; ?></td>
												<td><?= $prodi; ?></td>
												<td><?= $nama; ?></td>
												<td><?= $surat; ?></td>
												<td> <?php
														if ($verifikasi1 == 1 and $verifikasi2 == 1 and $verifikasi2 == 1) {
															echo 'Disetujui';
														} elseif ($verifikasi1 == 2 or $verifikasi2 == 2 or $verifikasi2 == 2) {
															echo 'Ditolak';
														} else {
															echo 'Proses';
														}
														?>
												</td>
												<td>
													<?php
													if ($validasi1 == 1 and $validasi2 == 1 and $validasi3 == 1) {
													?>
														<a class="btn btn-success btn-sm" href="../staf/skpi-tampil.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													<?php
													} elseif ($validasi1 == 2 or $validasi2 == 2 or $validasi3 == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return alert('<?= $keterangan; ?>')">
															<i class="fas fa-ban"></i>
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-secondary btn-sm" onclick="return alert('Dalam proses verifikasi')">
															<i class="fas fa-spinner"></i>
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
										<!-- /SKPI -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>


			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->

		<!-- footer -->
		<?php include 'footerdsn.php' ?>
		<!-- /.footer -->

		<!-- jQuery -->
		<script src="../system/plugins/jquery/jquery.min.js"></script>
		<!-- DataTables -->
		<script src="../system/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../system/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="../system/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../system/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../system/dist/js/adminlte.min.js"></script>
		<!-- page script -->
		<script>
			$(function() {
				$("#example1").DataTable({
					"responsive": true,
					"autoWidth": false,
				});
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
</body>

<!-- timer untuk alert -->
<script>
	window.setTimeout(function() {
		$(".alert").fadeTo(500, 0).slideUp(500, function() {
			$(this).remove();
		});
	}, 1000);
</script>

</html>