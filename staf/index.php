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

	<!-- Font Awesome -->
	<link rel="stylesheet" href="../system/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
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
											<td><?php
												if (isset($wfhselesai)) {
													echo tgl_indo($wfhselesai);
												}
												?>
											</td>
											<td>
												<?php
												if ($verifikasijurusan == 0) {
												?>
													<a class="btn btn-info btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
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
												if ($verifikasijurusan < 2 and $verifikasifakultas == 0) {
												?>
													<a class="btn btn-info btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
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
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../system/dist/js/demo.js"></script>
</body>

</html>