<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
include('../system/myfunc.php');

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
		include('sidebar.php');
		?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-12">
							<h3>Pengajuan Data SKPI</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3 class="card-title">Identitas Diri</h3>
								</div>
								<div class="card-body">
									<label>Nama</label><br />
									<input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
									<label>NIM</label><br />
									<input type="text" class="form-control" name="nim" value="<?= $nim; ?>" readonly /></input>
									<label>Program Studi</label><br />
									<input type="text" class="form-control" name="jurusan" value="<?= $prodi; ?>" readonly /></input>
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
									<div class="row">
										<div class="col-lg-6">
											<button type="submit" class="btn btn-success btn-block" value="ajukan" formaction="skpi-ajukan.php"> <i class="fas fa-graduation-cap"></i> Ajukan</button>
										</div>
										<div class="col-lg-6">
											<button name="aksi" value="tolak" type="button" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-block"> <i class="fa fa-plus"></i> Tambah Data</button>
										</div>
									</div>
									<br />
									<small style="color:red">Apabila tidak memiliki sertifikat keahlian / workshop, pengajuan SKPI tetap dapat dilakukan dengan langsung klik tombol Ajukan</small>
									<br />
								</div><!-- /.container-fluid -->
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
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
</body>

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

<!-- modal tambah -->
<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Sertifikat</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label>Aktivitas Prestasi & Penghargaan</label>
				<select id="aktivitas" name="aktivitas" class="form-control">
					<option>Sertifikat Profesional</option>
					<option>Pelatihan & Workshop</option>
				</select>
				<br />
				<label>Kegiatan (Bahasa Indonesia)</label><br />
				<input type="text" class="form-control" name="indonesia" required>
				<label>Activity (in English)</label><br />
				<input type="text" class="form-control" name="english" required>
				<label>File Sertifikat</label><br />
				<input type="file" name="fileToUpload" class="form-control" />
				<small style="color:blue"><i>*) Ukuran file maksimal 1MB format JPEG / JPG</i></small>
				<br />

			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success" value="simpan" formaction="skpi-simpan.php"> <i class="fa fa-file-upload"></i> Upload</button>
			</div>
		</div>
	</div>
</div>
<!-- ./modal tolak-->

</html>