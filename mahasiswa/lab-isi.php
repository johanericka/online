<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SAINTEK Online</title>
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
	header("location:../index.php?pesan=noaccess");
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
									<a href="http://saintek.uin-malang.ac.id/online/doc/SOPIjinLayananLaboratorium.pdf" target="_blank" class="nav-link">
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

			<!-- cek apakah ada data yang sudah tersimpan-->
			<?php
			$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim' and validasifakultas = 0");
			$cek = mysqli_num_rows($query);
			if ($cek > 0) {
				$data = mysqli_fetch_array($query);
				$nodata = $data['no'];
				$namamahasiswa = $data['nama'];
				$ttl = $data['ttl'];
				$alamat_asal = $data['alamatasal'];
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
			} else {
				// ambil data mahasiswa dari database
				$query = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode = '$nim'");
				$data = mysqli_fetch_array($query);
				$namamahasiswa = $data['nama'];
			}
			?>

			<!-- Main content -->
			<section class="content">
				<div class="col-12 col-sm-6 col-lg-12">
					<div class="card card-success card-tabs">
						<b style="color:green">Lampiran Dokumen Persyaratan Ijin Penggunaan Laboratorium</b>
						<p style="color:green"><a href="http://kedokteran.uin-malang.ac.id/konsuldokter/formulir" target="_blank"><b>Lampiran 1</b></a> Mengisi Form screening Bebas Covid-19 Universitas di laman: http://kedokteran.uin-malang.ac.id/konsuldokter/Formulir dan mencetak hasil pemeriksaan (print screen hasil pemeriksaan) </p>
						<p style="color:green"><a href="http://saintek.uin-malang.ac.id/online/doc/Lampiran4.docx"><b>Lampiran 4</b></a> Surat pernyataan melaksanakan karantina mandiri di rumah masing-masing sebelum bekerja di laboratorium selama 14 hari berturut-turut </p>
						<p style="color:green"><a href="http://saintek.uin-malang.ac.id/online/doc/Lampiran5.docx"><b>Lampiran 5</b></a> Surat pernyataan kesanggupan menerapkan protokol kesehatan</p>
						<p style="color:green"><a href="http://saintek.uin-malang.ac.id/online/doc/Lampiran7.docx" target="_blank"><b>Lampiran 7</b></a> Jika hasil verifikasi Satgas Covid-19 Fakultas merekomendasikan karantina mandiri setelah tiba di Malang maka mahasiswa wajib mengisi form kesediaan karantina mandiri selama 14 hari di Malang sebelum bekerja di laboratorium</p>
						<br />
						<form role="form" method="POST" action="lab-simpan.php">
							<label>Nama </label><br />
							<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly /></input>
							<br />
							<label>NIM </label> <br />
							<input type="number" class="form-control" name="nim" value="<?php echo $nim; ?>" readonly /></input>
							<br />
							<label>Tempat / Tgl. Lahir </label><small style="color:blue"><i> wajib di isi </i></small><br />
							<input type="text" class="form-control" name="ttl" required></input>
							<br />
							<label>Alamat Asal </label><small style="color:blue"><i> wajib di isi </i></small><br />
							<textarea class="form-control" rows="3" id="alamatasal" name="alamatasal" placeholder="Tuliskan alamat asal anda" required><?php echo $alamat_asal; ?></textarea>
							<br />
							<label>Alamat Di Malang </label><small style="color:blue"><i> wajib di isi </i></small><br />
							<textarea class="form-control" rows="3" id="alamatmalang" name="alamatmalang" placeholder="Tuliskan alamat tempat tinggal anda di Malang. Tuliskan TIDAK ADA apabila tidak tinggal di Malang" required></textarea>
							<br />
							<label>No. HP </label><small style="color:blue"><i> wajib di isi </i></small><br />
							<input type="number" class="form-control" name="nohp" required></input>
							<br />
							<label>No. HP Orang Tua / Wali </label><small style="color:blue"><i> wajib di isi </i></small><br />
							<input type="number" class="form-control" name="nohportu" required></input>
							<br />
							<label>Riwayat Penyakit </label><small style="color:blue"><i> wajib di isi </i></small><br />
							<textarea class="form-control" rows="3" id="riwayatpenyakit" name="riwayatpenyakit" placeholder="Tuliskan riwayat penyakit yang pernah / sedang diderita disini. Tuliskan TIDAK ADA  apabila tidak pernah menderita penyakit." required></textarea>
							<br />
							<label>Posisi saat mendaftar </label><small style="color:blue"><i> wajib di pilih </i></small><br />
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
							<br />
							<label><i>Maka kami mohon dibuatkan surat ijin penggunaan laboratorium di : </i></label>
							<br />
							<br />
							<label>Program Studi </label><br />
							<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly /></input>
							<br />
							<label>Nama Laboratorium </label><small style="color:blue"><i> wajib di pilih </i></small><br />
							<select name="namalab">
								<?php
								$sql = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE jurusan = '$jurusan'");
								$jmldata = mysqli_num_rows($sql);
								echo "Jumlah data = " . $jmldata;
								while ($data = mysqli_fetch_array($sql)) {
									if ($data['kapasitas'] > 0) {
								?>
										<option value="<?php echo $data['namalab']; ?>"><?php echo $data['namalab']; ?></option>;
								<?php
									}
								}
								?>
							</select>
							<br />
							<small style="color:red"><i>Apabila nama lab. tidak ada berarti kapasitas lab. sudah penuh. Silahkan coba kembali esok hari.</i></small>
							<br />
							<br />
							<label>Dosen Pembimbing </label><small style="color:blue"><i> pilih dari daftar </i></small><br />
							<div class="search-box">
								<input type="text" autocomplete="off" placeholder="cari dosen" name="dosen" value="<?php echo $dosen; ?>" required></input>
								<div class="result"></div>
							</div>
							<br />
							<label>Waktu Penggunaan </label><small style="color:blue"><i> wajib di isi </i></small>
							<div class="form-group">
								Mulai
								<input type="date" id="tglmulai" name="tglmulai" value="<?php echo $tglmulai; ?>" required>
								<br />
								Selesai
								<input type="date" id="tglselesai" name="tglselesai" value="<?php echo $tglselesai; ?>" required>
								<br />
								<small style="color:red"><i>*) Maksimal 1 bulan </i></small>
							</div>
							<br />
							<br />
							<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
							<button type="submit" class="btn btn-success"> <i class="fa fa-arrow-right"></i> Selanjutnya</button>
						</form>
						<br />
						<br />
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