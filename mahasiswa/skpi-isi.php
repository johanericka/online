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
$nim = $_SESSION['nim'];
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
						<a href="#" class="d-block">NIM : <?php echo $nim; ?></a>
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
				<div class="content">
					<div class="container-fluid">
						<label>Nama</label><br />
						<input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
						<label>NIM</label><br />
						<input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
						<label>Program Studi</label><br />
						<input type="text" class="form-control" name="jurusan" value="<?= $jurusan; ?>" readonly /></input>
						<hr>
						<form role="FORM" method="POST">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Aktivitas Prestasi & Penghargaan</label>
										<select id="aktivitas" name="aktivitas" class="form-control">
											<option>Sertifikat Profesional</option>
											<option>Pelatihan & Workshop</option>
										</select>
									</div>
								</div>
							</div>
							<label>Bahasa Indonesia</label><br />
							<textarea class="form-control" rows="2" name="indonesia" /></textarea>
							<label>Bahasa Inggris</label><br />
							<textarea class="form-control" rows="2" name="english" /></textarea>
							<label>Link Sertifikat</label><br />
							<input type="text" class="form-control" name="bukti" /></textarea>
							<small style="color:red"><i>
									Upload bukti sertifikat anda ke cloud storage. Paste link sertifikat anda disini. Pastikan file sertifikat anda dapat diakses tanpa permintaan izin. </i>
							</small>
							<br /><br />
							<button type="submit" class="btn btn-success" value="simpan" formaction="skpi-simpan.php"> <i class="fa fa-file-upload"></i> Upload</button>
							<hr>
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Sertifikat di ajukan</h3>
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
												<th>Hapus</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;

											$qprestasi = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim' ORDER BY aktivitas ASC, indonesia ASC");
											while ($data = mysqli_fetch_array($qprestasi)) {
												$nodata = $data[0];
											?>
												<tr>
													<td><?= $no; ?></td>
													<td><?= $data['aktivitas']; ?></td>
													<td><?= $data['indonesia']; ?></td>
													<td><i><?= $data['english']; ?></i></td>
													<td> <a href="<?= urldecode($data['bukti']) ?>" target="_blank">Klik Disini</a> </td>
													<td>
														<a class="btn btn-danger btn-sm" onclick="return confirm('Menghapus data <?= $data['indonesia']; ?> ?')" href="skpi-isihapus.php?nodata=<?php echo $nodata; ?>">
															<i class="fas fa-trash"></i>
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
							</div>
							<br />

							<input type="hidden" name="nim" value="<?= $nim; ?>"></input>
							<input type="hidden" name="nama" value="<?= $nama; ?>"></input>
							<input type="hidden" name="jurusan" value="<?= $jurusan; ?>"></input>

							<button type="submit" class="btn btn-warning" value="ajukan" formaction="skpi-ajukan.php"> <i class="fas fa-graduation-cap"></i> Ajukan</button>
							<br />
							<br />
							<small style="color:blue"><i>Apabila tidak memiliki sertifikat keahlian / workshop, pengajuan SKPI tetap dapat dilakukan dengan langsung klik tombol Ajukan</i></small>
						</form>
						<br />
					</div><!-- /.container-fluid -->
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