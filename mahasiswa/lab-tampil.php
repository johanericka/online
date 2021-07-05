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
	<script type="text/javascript" src="../system/js/jquery.min.js"></script>
	<script type="text/javascript" src="../system/js/jquery.form.js"></script>
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
	header("location:../index.php?pesan=belum_login");
}
?>

<?php
$iduser = $_SESSION['iduser'];
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];
$jurusan = $_SESSION['jurusan'];
$status = $_SESSION['status'];
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
			<a href="#" class="brand-link">
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
									<a href="http://saintek.uin-malang.ac.id/wfh/doc/SOPIjinLayananLaboratorium.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>SOP Ijin Layanan Lab.</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="mailto:saintekonline@gmail.com" class="nav-link">
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
							<h3>Pengajuan Ijin Penggunaan Laboratorium</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- dapatkan no surat -->
			<?php
			$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim' AND keterangan is null");
			$data = mysqli_fetch_array($query);
			$nodata = $data['no'];
			?>

			<!-- ambil data ijin lab dari tabel ijinlab -->
			<?php
			$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE no = '$nodata'");
			$cek = mysqli_num_rows($query);
			if ($cek > 0) {
				$data = mysqli_fetch_array($query);
				$nama = $data['nama'];
				$ttl = $data['ttl'];
				$alamatasal = $data['alamatasal'];
				$alamatmalang = $data['alamatmalang'];
				$nohp = $data['nohp'];
				$nohportu = $data['nohportu'];
				$riwayatpenyakit = $data['riwayatpenyakit'];
				$posisi = $data['posisi'];
				$prodi = $data['prodi'];
				$namalab = $data['namalab'];
				$dosen = $data['dosen'];
				$tglmulai = $data['tglmulai'];
				$tglselesai = $data['tglselesai'];
				$validatordosen = $data['validatordosen'];
			}
			?>

			<!-- Main content -->
			<section class="content">
				<div class="col-12 col-sm-6 col-lg-12">
					<div class="card card-success card-tabs">
						<div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-datadiri" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Data Diri</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-bebascovid" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Lampiran 1</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-mengiutiprotokol" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Lampiran 4</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-karantinamandiri" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Lampiran 5</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill" href="#custom-tabs-one-karantinamandirimlg" role="tab" aria-controls="custom-tabs-one-settings" aria-selected="false">Lampiran 7</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-one-tabContent">
								<div class="tab-pane fade show active" id="custom-tabs-one-datadiri" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
									<form role="form" method="POST">
										<label>Nama </label><br />
										<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly /></input>
										<label>NIM </label><br />
										<input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>" readonly /></input>
										<label>Tempat / Tgl. Lahir </label><br />
										<input type="text" class="form-control" name="ttl" value="<?php echo $ttl; ?>" /></input>
										<label>Alamat Asal </label><br />
										<textarea class="form-control" rows="3" id="alamatasal" name="alamatasal" /><?php echo $alamatasal; ?></textarea>
										<label>Alamat Di Malang </label><br />
										<textarea class="form-control" rows="3" id="alamatmalang" name="alamatmalang" /><?php echo $alamatmalang; ?></textarea>
										<label>No. HP</label><br />
										<input type="text" class="form-control" name="nohp" value="<?php echo $nohp; ?>" /></input>
										<label>No. HP Orang Tua / Wali</label><br />
										<input type="text" class="form-control" name="nohportu" value="<?php echo $nohportu; ?>" /></input>
										<label>Riwayat Penyakit</label><br />
										<textarea class="form-control" rows="3" id="riwayatpenyakit" name="riwayatpenyakit" /><?php echo $riwayatpenyakit; ?></textarea>
										<label>Posisi saat mendaftar</label><br />
										<?php
										if ($posisi != "Alamat di malang") {
										?>
											<input type="radio" id="asal" name="posisi" value="Alamat Asal" checked> Alamat Asal<br />
											<input type="radio" id="malang" name="posisi" value="Alamat di malang"> Alamat di Malang<br />
											<br />
										<?php
										} else {
										?>
											<input type="radio" id="asal" name="posisi" value="Alamat Asal"> Alamat Asal<br />
											<input type="radio" id="malang" name="posisi" value="Alamat di malang" checked> Alamat di Malang<br />
											<br />
										<?php
										}
										?>
										<label>Maka kami mohon dibuatkan surat ijin penggunaan laboratorium di :</label>
										<br />
										<label>Program Studi </label><br />
										<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly></input>
										<label>Nama Laboratorium </label><br />
										<input type="text" class="form-control" name="namalab" value="<?php echo $namalab; ?>" readonly></input>
										<label>Dosen Pembimbing</label><br />
										<div class="search-box">
											<input type="text" autocomplete="off" placeholder="cari dosen" name="dosen" value="<?php echo $dosen; ?>" /></input>
											<div class="result"></div>
										</div>
										<label>Waktu Penggunaan</label>
										<div class="form-group">
											Mulai
											<input type="date" id="tglmulai" name="tglmulai" value="<?php echo $tglmulai; ?>">
											<br />
											Selesai
											<input type="date" id="tglselesai" name="tglselesai" value="<?php echo $tglselesai; ?>">
											<!-- /.input group -->
										</div>
										<br />
										<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
										<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
										<button type="submit" class="btn btn-warning" formaction="lab-simpan.php"> <i class="fa fa-save"></i> Ubah Data</button>
										<?php
										if ($validatordosen === null) {
										?>
											<button type="submit" class="btn btn-success" formaction="lab-simpanfinal.php"> <i class="fa fa-check"></i> Ajukan Data</button>
										<?php
										};
										?>
									</form>
								</div>

								<!-- hasil screening COVID-19 -->
								<div class="tab-pane fade" id="custom-tabs-one-bebascovid" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
									<b>Lampiran 1 - Screenshot hasil screening bebas COVID-19</b>
									<br />
									Upload Hasil Pemeriksaan Screening Bebas COVID-19 <a href="http://kedokteran.uin-malang.ac.id/konsuldokter/formulir" target="_blank"><b>Isi form disini</b></a>
									<br />
									<br />
									<form action="ajaxupload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
										<input type="file" name="image" class="form-control" />
										<small style="color:blue"><i>*) Ukuran file maksimal 1MB format PDF / JPG</i></small>
										<br />
										<br />
										<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
										<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
										<button class="btn btn-block btn-primary btn-upload" name="upload" value="screeningcovid"><i class="fa fa-arrow-up"></i> Upload Hasil Screening COVID-19</button>
									</form>
									<br />
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='screeningcovid'");
									$cekhasil = mysqli_num_rows($query);
									if ($cekhasil > 0) {
										$data = mysqli_fetch_array($query);
										$namafile = $data['namafile'];
									} else {
										$namafile = '../uploads/noimage.gif';
									}
									?>
									<br />
									<?php
									$ext = substr($namafile, -3);
									if ($ext == "pdf") {
									?>
										<div><iframe src="<?php echo $namafile; ?>" width="80%" height="500px"></iframe></div>
									<?php
									} else {
									?>
										<div><img src="<?php echo $namafile; ?>" width="80%" /></div>
									<?php
									}
									?>

								</div>

								<!-- kesanggupan mengikuti protokol -->
								<div class="tab-pane fade" id="custom-tabs-one-mengiutiprotokol" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
									<b>Lampiran 4 - Scan Surat Pernyataan Melaksanakan Karantina Mandiri</b>
									<br />
									Scan Surat Pernyataan Melaksanakan Karantina Mandiri <a href="http://saintek.uin-malang.ac.id/wfh/doc/Lampiran4.docx"><b>Download Lampiran 4 </b></a>
									<br />
									<br />
									<form action="ajaxupload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
										<input type="file" name="image" class="form-control" />
										<small style="color:blue"><i>*) Ukuran file maksimal 1MB format PDF / JPG</i></small>
										<br />
										<br />
										<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
										<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
										<button class="btn btn-block btn-primary btn-upload" name="upload" value="karantinamandiri"><i class="fa fa-arrow-up"></i> Upload Surat Pernyataan</button>
									</form>
									<br />
									<?php
									$query = mysqli_query($dbsurat, "SELECT  * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='karantinamandiri'");
									$cekhasil = mysqli_num_rows($query);
									if ($cekhasil > 0) {
										$data = mysqli_fetch_array($query);
										$namafile = $data['namafile'];
									} else {
										$namafile = '../uploads/noimage.gif';
									}
									?>
									<br />
									<?php
									$ext = substr($namafile, -3);
									if ($ext == "pdf") {
									?>
										<div><iframe src="<?php echo $namafile; ?>" width="80%" height="500px"></iframe></div>
									<?php
									} else {
									?>
										<div><img src="<?php echo $namafile; ?>" width="80%" /></div>
									<?php
									}
									?>
								</div>

								<!-- kesanggupan karantina mandiri -->
								<div class="tab-pane fade" id="custom-tabs-one-karantinamandiri" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
									<b>Lampiran 5 - Surat Pernyataan Kesanggupan Mengikuti Protokol Kesehatan</b>
									<br />
									Scan Surat Pernyataan Kesanggupan Mengikuti Protokol Kesehatan <a href="http://saintek.uin-malang.ac.id/wfh/doc/Lampiran5.docx"><b>Download Form Lampiran 5</b></a>
									<br />
									<br />
									<form action="ajaxupload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
										<input type="file" name="image" class="form-control" />
										<small style="color:blue"><i>*) Ukuran file maksimal 1MB format PDF / JPG</i></small>
										<br />
										<br />
										<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
										<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
										<button class="btn btn-block btn-primary btn-upload" name="upload" value="kesanggupanprotokol"><i class="fa fa-arrow-up"></i> Upload Surat Pernyataan</button>
									</form>
									<br />
									<?php
									$query = mysqli_query($dbsurat, "SELECT  * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='kesanggupanprotokol'");
									$cekhasil = mysqli_num_rows($query);
									if ($cekhasil > 0) {
										$data = mysqli_fetch_array($query);
										$namafile = $data['namafile'];
									} else {
										$namafile = '../uploads/noimage.gif';
									}
									?>
									<br />
									<?php
									$ext = substr($namafile, -3);
									if ($ext == "pdf") {
									?>
										<div><iframe src="<?php echo $namafile; ?>" width="80%" height="500px"></iframe></div>
									<?php
									} else {
									?>
										<div><img src="<?php echo $namafile; ?>" width="80%" /></div>
									<?php
									}
									?>
								</div>

								<!-- kesanggupan mengawasi -->
								<div class="tab-pane fade" id="custom-tabs-one-kesanggupanmengawasi" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
									<b>Lampiran 6 - Surat Pernyataan Kesanggupan Mengawasi Mahasiswa Bimbingan Skripsi / Tugas Akhir</b>
									<br />
									<?php
									$query = mysqli_query($dbsurat, "SELECT  * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='kesanggupanmengawasi'");
									$cekhasil = mysqli_num_rows($query);
									if ($cekhasil > 0) {
										$data = mysqli_fetch_array($query);
										$namafile = $data['namafile'];
									} else {
										$namafile = '../uploads/noimage.gif';
									}
									?>
									<br />
									<?php
									$ext = substr($namafile, -3);
									if (strtolower($ext) == "pdf") {
									?>
										<div><iframe src="<?php echo $namafile; ?>" width="80%" height="500px"></iframe></div>
									<?php
									} else {
									?>
										<div><img src="<?php echo $namafile; ?>" width="80%" /></div>
									<?php
									}
									?>
									<br />
								</div>

								<!-- karantina mandiri malang -->
								<div class="tab-pane fade" id="custom-tabs-one-karantinamandirimlg" role="tabpanel" aria-labelledby="custom-tabs-one-settings-tab">
									<b>Lampiran 7 - Surat Pernyataan Kesanggupan Melaksanakan karantina Mandiri di Kota Malang</b>
									<br />
									Scan Surat Pernyataan Melaksanakan Karantina Mandiri di Kota Malang <a href="http://saintek.uin-malang.ac.id/wfh/doc/Lampiran7.docx" target="_blank"><b>Download Lampiran 7</b></a>
									<br />
									<br />
									<form action="ajaxupload.php" enctype="multipart/form-data" class="form-horizontal" method="post">
										<input type="file" name="image" class="form-control" />
										<small style="color:blue"><i>*) Ukuran file maksimal 1MB format PDF / JPG</i></small>
										<br />
										<br />
										<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
										<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
										<button class="btn btn-block btn-primary btn-upload" name="upload" value="karantinamandirimlg"><i class="fa fa-arrow-up"></i> Upload Surat Pernyataan</button>
									</form>
									<br />
									<?php
									$query = mysqli_query($dbsurat, "SELECT  * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='karantinamandirimlg'");
									$cekhasil = mysqli_num_rows($query);
									if ($cekhasil > 0) {
										$data = mysqli_fetch_array($query);
										$namafile = $data['namafile'];
									} else {
										$namafile = '../uploads/noimage.gif';
									}
									?>
									<br />
									<?php
									$ext = substr($namafile, -3);
									if ($ext == "pdf") {
									?>
										<div><iframe src="<?php echo $namafile; ?>" width="80%" height="500px"></iframe></div>
									<?php
									} else {
									?>
										<div><img src="<?php echo $namafile; ?>" width="80%" /></div>
									<?php
									}
									?>
								</div>
							</div>
						</div>
						<!-- /.card -->
					</div>
				</div>

				<div class="content">
					<div class="container-fluid">
					</div>
					<!-- /.form group -->



				</div><!-- /.container-fluid -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

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