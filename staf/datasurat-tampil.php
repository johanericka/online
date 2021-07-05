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
	<!-- DataTables -->
	<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
//if($_SESSION['role']!="wakildekan"){
//	header("location:../index.php?pesan=belum_login");
//}
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
//$jurusan = $fakultas;
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
						<a href="#" class="d-block"><?php echo $jurusan; ?></a>
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
											<th width="15%">Program Studi</th>
											<th width="20%">Nama</th>
											<th width="25%">Jenis Surat</th>
											<th width="20%">No. Surat</th>
											<th width="5%">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1; ?>

										<!-- cetak KHS -->
										<?php
										if ($jurusan == 'SAINTEK') {
											$query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE validasifakultas=1 ORDER BY jurusan");
										} else {
											$query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE jurusan='$jurusan' AND validasifakultas=1 ORDER BY jurusan");
										}

										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['id'];
											$nama = $data['nama'];
											$jurusan = $data['jurusan'];
											$jenissurat = 'Permohonan Cetak KHS';
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/cetakkhs-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /cetak KHS -->

										<!-- ijin lab -->
										<?php
										if ($jurusan == 'SAINTEK') {
											$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE validasifakultas=1 ORDER BY prodi");
										} else {
											$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE prodi='$jurusan' AND validasifakultas=1 ORDER BY prodi");
										}
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['no'];
											$nama = $data['nama'];
											$jurusan = $data['prodi'];
											$jenissurat = 'Ijin Penggunaan Laboratorium';
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/lab-cetak.php?<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /ijin lab -->

										<!-- ijin penelitian -->
										<?php
										if ($jurusan == 'SAINTEK') {
											$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validasifakultas=1 ORDER BY kdjurusan ");
										} else {
											//cari kode jurusan
											$qjurusan = mysqli_query($dbsurat, "SELECT kdjurusan FROM jurusan WHERE jurusan='$jurusan'");
											while ($djurusan = mysqli_fetch_array($qjurusan)) {
												$kdjurusan = $djurusan['kdjurusan'];
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE kdjurusan='$kdjurusan' AND validasifakultas=1 ORDER BY kdjurusan ");
											}
											while ($data = mysqli_fetch_array($query)) {
												$nodata = $data['id'];
												$nama = $data['nama'];
												$kdjurusan = $data['kdjurusan'];
												$jenissurat = 'Ijin Penelitian';
												$validasifakultas = $data['validasifakultas'];
												$keterangan = $data['keterangan'];

												//cari nama jurusan
												$query2 = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan='$kdjurusan'");
												$data2 = mysqli_fetch_array($query2);
												$jurusan = $data2['jurusan'];
										?>
												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $jurusan; ?></td>
													<td><?php echo $nama; ?></td>
													<td><?php echo $jenissurat; ?></td>
													<td><?php echo $keterangan; ?></td>
													<td>
														<a class="btn btn-success btn-sm" href="../mahasiswa/ijinpenelitian-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
															<i class="fas fa-print"></i>
														</a>
													</td>
												</tr>
										<?php
												$no++;
											}
										}
										?>
										<!-- /ijin penelitian -->

										<!-- ijin observasi -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validasifakultas=1 ORDER BY jurusan");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['id'];
											$nim = $data['nim'];
											$jurusan = $data['jurusan'];
											$jenissurat = 'Ijin Observasi';
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];

											//cari nama mahasiswa
											$query3 = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode='$nim'");
											$data3 = mysqli_fetch_array($query3);
											$nama = $data3['nama'];
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/observasi-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /ijin observasi -->

										<!-- ijin peminjaman alat -->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE validasifakultas=1 ORDER BY jurusan");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['id'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$jurusan = $data['jurusan'];
											$jenissurat = 'Ijin Peminjaman Alat';
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/peminjamanalat-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /ijin peminjaman alat -->

										<!-- ijin pengambilan data-->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validasifakultas=1 ORDER BY jurusan");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['id'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$jurusan = $data['jurusan'];
											$jenissurat = 'Ijin Pengambilan Data';
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];
										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/pengambilandata-cetak.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /ijin pengambilan data -->

										<!-- Surat Pengantar PKL-->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validasifakultas=1 ORDER BY kdjurusan ");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['id'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$kdjurusan = $data['kdjurusan'];
											$jenissurat = 'Surat Pengantar PKL';
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];

											//cari nama jurusan
											$query2 = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan='$kdjurusan'");
											$data2 = mysqli_fetch_array($query2);
											$jurusan = $data2['jurusan'];

										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/pkl-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /Surat Pengantar PKL -->

										<!-- Surat Keterangan-->
										<?php
										$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validasifakultas=1 ORDER BY kdjurusan, jenissurat");
										while ($data = mysqli_fetch_array($query)) {
											$nodata = $data['id'];
											$nim = $data['nim'];
											$nama = $data['nama'];
											$kdjurusan = $data['kdjurusan'];
											$jenissurat = $data['jenissurat'];
											$validasifakultas = $data['validasifakultas'];
											$keterangan = $data['keterangan'];

											//cari nama jurusan
											$query2 = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan='$kdjurusan'");
											$data2 = mysqli_fetch_array($query2);
											$jurusan = $data2['jurusan'];

										?>
											<tr>
												<td><?php echo $no; ?></td>
												<td><?php echo $jurusan; ?></td>
												<td><?php echo $nama; ?></td>
												<td><?php echo $jenissurat; ?></td>
												<td><?php echo $keterangan; ?></td>
												<td>
													<a class="btn btn-success btn-sm" href="../mahasiswa/suket-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
													</a>
												</td>
											</tr>
										<?php
											$no++;
										}
										?>
										<!-- /Surat Keterangan-- -->

									</tbody>
								</table>
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</section>


			<!-- Control Sidebar -->
			<aside class="control-sidebar control-sidebar-dark">
				<!-- Control sidebar content goes here -->
			</aside>
			<!-- /.control-sidebar -->
		</div>
		<!-- ./wrapper -->

		<!-- footer -->
		<?php include '../system/footerdsn.html' ?>
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
		<!-- DataTables  & Plugins -->
		<script src="../system/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="../system/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="../system/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../system/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="../system/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
		<script src="../system/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
		<script src="../system/plugins/jszip/jszip.min.js"></script>
		<script src="../system/plugins/pdfmake/pdfmake.min.js"></script>
		<script src="../system/plugins/pdfmake/vfs_fonts.js"></script>
		<script src="../system/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
		<script src="../system/plugins/datatables-buttons/js/buttons.print.min.js"></script>
		<script src="../system/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../system/dist/js/adminlte.min.js"></script>
		<!-- page script -->
		<script>
			$(function() {
				$("#example1").DataTable({
					"responsive": true,
					"lengthChange": false,
					"autoWidth": false,
					"buttons": ["copy", "csv", "excel", "pdf", "print"]
				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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