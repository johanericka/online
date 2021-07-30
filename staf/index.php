<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['hakakses'] != "tendik") {
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

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../system/plugins/fontawesome-free/css/all.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="../system/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../system/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../system/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
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
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Default box -->
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Rencana Kerja dan Surat Tugas <i>Work From Home</i></h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
									</div>
								</div>
								<!-- /.card-header -->
								<?php $no = 1; ?>
								<div class="card-body p-0">
									<!-- /.card-header -->
									<div class="card-body">
										<table id="example2" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th width="5%">No</th>
													<th>Mulai WFH</th>
													<th>Akhir WFH</th>
													<th>Rencana Kerja</th>
													<th>Surat Tugas</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM wfh WHERE nip='$nip' ORDER BY tglwfh1 DESC");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$tglwfh1 = $data['tglwfh1'];
													$tglwfh2 = $data['tglwfh2'];
													$tglwfh3 = $data['tglwfh3'];
													$tglwfh4 = $data['tglwfh4'];
													$tglwfh5 = $data['tglwfh5'];
													$verifikasiprodi = $data['verifikasiprodi'];
													$verifikasifakultas = $data['verifikasifakultas'];
													$keterangan = $data['keterangan'];
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
															}  ?>
														</td>
														<td><?php
															if (isset($wfhselesai)) {
																echo tgl_indo($wfhselesai);
															}
															?>
														</td>
														<td>
															<?php
															if ($verifikasiprodi == 0) {
															?>
																menunggu verifikasi
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi == 1) {
															?>
																<a class="btn btn-success btn-sm" href="wfh-cetakrk.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-print"></i> Cetak
																</a>
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi == 2) {
															?>
																<a class="btn btn-danger btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
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
															if ($verifikasiprodi < 2 and $verifikasifakultas == 0) {
															?>
																menunggu verifikasi
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi < 2 and $verifikasifakultas == 1) {
															?>
																<a class="btn btn-success btn-sm" href="wfh-cetakst.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-print"></i> Cetak
																</a>
															<?php
															};
															?>

														</td>
														<td>
															<?php
															if ($verifikasifakultas <> 1) {
															?>
																<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="wfh-hapus.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-trash"></i> Hapus
																</a>
															<?php
															};
															?>
															<?= $keterangan; ?>
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
						</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

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
	<!-- AdminLTE for demo purposes -->
	<script src="../system/dist/js/demo.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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

</html>