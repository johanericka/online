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
if ($_SESSION['role'] != "Dosen") {
	header("location:../index.php?pesan=belum_login");
}
?>

<?php
$iduser = $_SESSION['iduser'];
$nip = $_SESSION['nip'];
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
					<div class="row mb-2">
						<div class="col-sm-6">
							<h3>Pengisian Data SKPI</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
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
										<th style="text-align:center">Status Surat</th>
										<th style="text-align:center">Dosen Wali</th>
										<th colspan="2" style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>

									<!-- SKPI -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE jurusan='$jurusan' GROUP BY NIM");
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$verifikator1 = $data['verifikator1'];
										$surat = "Surat Keterangan Pendamping Ijazah";
										$verifikasi1 = $data['verifikasi1'];
										$verifikasi2 = $data['verifikasi2'];
										$verifikasi3 = $data['verifikasi3'];

										$qverifikator = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode='$verifikator1'");
										$dverifikator = mysqli_fetch_array($qverifikator);
										$dosenpa = $dverifikator['nama'];
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $nim; ?></td>
											<td><?php echo $nama; ?></td>
											<td>
												Dosen Pembimbing Akademik
												<?php
												if ($verifikasi1 == 0) {
												?>
													<i class="fa fa-spinner" aria-hidden="true"></i> <br />
												<?php
												} elseif ($verifikasi1 == 1) {
												?>
													<i class="fa fa-check" aria-hidden="true"></i> <br />
												<?php
												} else {
												?>
													<i class="fa fa-ban" aria-hidden="true"></i> <br />
												<?php
												};
												?>
												Ketua Program Studi
												<?php
												if ($verifikasi2 == 0) {
												?>
													<i class="fa fa-spinner" aria-hidden="true"></i> <br />
												<?php
												} elseif ($verifikasi2 == 1) {
												?>
													<i class="fa fa-check" aria-hidden="true"></i> <br />
												<?php
												} else {
												?>
													<i class="fa fa-ban" aria-hidden="true"></i> <br />
												<?php
												};
												?>
												Wakil Dekan Akademik
												<?php
												if ($verifikasi3 == 0) {
												?>
													<i class="fa fa-spinner" aria-hidden="true"></i> <br />
												<?php
												} elseif ($verifikasi3 == 1) {
												?>
													<i class="fa fa-check" aria-hidden="true"></i> <br />
												<?php
												} else {
												?>
													<i class="fa fa-ban" aria-hidden="true"></i> <br />
												<?php
												};
												?>
											</td>
											<td>
												<form role="FORM" method="POST">
													<div class="form-group">
														<div class="search-box">
															<input type="text" class="form-control" autocomplete="off" placeholder="ketikkan nama dosen" name="dosen" value="<?= $dosenpa; ?>" />
															<div class="result"></div>
														</div>
													</div>

													<input type="hidden" name="nim" value="<?= $nim; ?>" />
													<input type="hidden" name="nama" value="<?= $nama; ?>" />
													<input type="hidden" name="jurusan" value="<?= $jurusan; ?>" />
													<?php
													if (empty($dosenpa)) {
													?>
														<button type="submit" value="simpan" formaction="skpi-ubahdosen.php" class="btn btn-danger btn-sm"> <i class="fa fa-plus"></i> Masukkan Dosen Wali</button>
													<?php
													} else {
													?>
														<button type="submit" value="simpan" formaction="skpi-ubahdosen.php" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i> Ubah Dosen Wali</button>
													<?php
													}
													?>

												</form>
											</td>
											<td>
												<?php
												if ($verifikasi3 == 1) {
												?>
													<a class="btn btn-success btn-sm" href="skpi-final.php?nim=<?php echo mysqli_real_escape_string($dbsurat, $nim); ?>">
														<i class="fas fa-print"></i>
													</a>
												<?php
												};
												?>
												<?php
												if ($iduser == 'DENYZA' and $verifikasi1 == 0) {
												?>
													<a class="btn btn-warning btn-sm" href="skpi-tampil.php?nim=<?php echo mysqli_real_escape_string($dbsurat, $nim); ?>">
														<i class="fas fa-eye"></i>
													</a>
												<?php
												};
												?>
												<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan SKPI <?= $nama; ?> ?')" href="skpi-hapuspengajuan.php?iduser=<?php echo $nim; ?>">
													<i class="fas fa-trash"></i> Hapus
												</a>
											</td>
										</tr>
									<?php
										$no++;
									}
									?>
									<!-- /SKPI  -->
								</tbody>
							</table>
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

<!-- cari dosen -->
<script src="../system/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.search-box input[type="text"]').on("keyup input", function() {
			/* Get input value on change */
			var inputVal = $(this).val();
			var resultDropdown = $(this).siblings(".result");
			if (inputVal.length) {
				$.get("cari-proses.php", {
					term: inputVal
				}).done(function(data) {
					// Display the returned data in browser
					resultDropdown.html(data);
				});
			} else {
				resultDropdown.empty();
			}
		});
		// Set search input value on click of result item
		$(document).on("click", ".result p", function() {
			$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			$(this).parent(".result").empty();
		});
	});
</script>

</html>