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
$status = $_SESSION['status'];
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
							<h3>Pengajuan Surat Observasi</h3>
						</div>
					</div>
					<div class="alert alert-warning alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>PERHATIAN!!</strong> Cukup ketua kelompok yang mengajukan
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- ambil data mahasiswa dari database -->
			<?php
			$id = $_SESSION['iduser'];
			$datamhs = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode='$id'");
			$row = mysqli_fetch_array($datamhs);
			$nim = $row['kode'];
			$nama = $row['nama'];
			?>

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<form role="form" method="post" action="observasi-anggotatambah.php">
						<div class="form-group">
							<label>NIM</label>
							<input type="number" name="nim" placeholder="NIM" autocomplete="none" />
							<button type="submit" class="btn-sm btn-success"> <i class="fa fa-user"></i> Tambah</button>
						</div>
					</form>
					<div class="box">
						<div class="box-body">
							<br>
							<table class="table table-bordered" id="tabel">
								<thead>
									<tr>
										<th>NO</th>
										<th>NIM</th>
										<th>NAMA</th>
										<th>NO. TELEPON</th>
										<th>AKSI</th>
									</tr>
								</thead>
								<tbody>
									<!-- memasukkan pengusul -->
									<?php
									$qcari = mysqli_query($dbsurat, "SELECT * FROM observasianggota WHERE nimanggota = '$nim'");
									$data = mysqli_num_rows($qcari);
									if ($data == 0) {
										$qtambah = "INSERT INTO observasianggota (nimketua, nimanggota, nama, telepon) 
															VALUES('" . $nim . "','" . $nim . "','" . $nama . "','" . $telp . "')";
										$sql =  mysqli_query($dbsurat, $qtambah);
									}
									?>
									<!--baca status -->
									<?php
									if (isset($_GET['ket'])) {
										$status = mysqli_real_escape_string($dbsurat, $_GET['ket']);
										if ($status == 'nodata') {
									?>
											<div class="alert alert-danger alert-dismissible fade show">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<strong>ERROR!</strong> Data tidak ditemukan.
											</div>
										<?php
										} elseif ($status == 'terdaftar') {
										?>
											<div class="alert alert-danger alert-dismissible fade show">
												<button type="button" class="close" data-dismiss="alert">&times;</button>
												<strong>ERROR!</strong> Mahasiswa telah terdaftar di kelompok lain.
											</div>
									<?php
										}
									}
									?>
									<?php
									$dataanggota = mysqli_query($dbsurat, "SELECT * FROM observasianggota WHERE nimketua='$id'");
									$no = 1;
									$hasil = mysqli_num_rows($dataanggota);
									while ($q = mysqli_fetch_array($dataanggota)) {
										$nimanggota = $q['nimanggota'];
										$namaanggota = $q['nama'];
										$telepon = $q['telepon'];
									?>
										<tr>
											<td><?= $no++; ?></td>
											<?php $q['id']; ?>
											<td><?= $nimanggota; ?></td>
											<td><?= $namaanggota; ?></td>
											<td>
												<form action="observasi-anggotaubahtelepon.php" method="POST">
													<input type="number" name="telepon" value="<?= $telepon; ?>" required>
													<input type="hidden" name="nimanggota" value="<?= $nimanggota; ?>">
													<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-save"></i> Simpan</button>
												</form>
												<small><i>Klik simpan setelah memasukkan no telepom</i></small>
											</td>
											<td>
												<a class="btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="observasi-anggotahapus.php?nimanggota=<?php echo $q['nimanggota']; ?>"><i class="fa fa-trash-alt"></i></a>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<br />
					<form role="form" method="post" action="observasi-simpan.php">
						<input type="hidden" name="nim" value="<?php echo $nim ?>"></input>
						Dalam rangka mengaplikasikan teori selama perkuliahan
						<br />
						Mata kuliah <input type="text" class="form-control" name="matakuliah" required></input>
						<br />
						Dosen pembina
						<div class="search-box">
							<input type="text" autocomplete="off" placeholder="cari dosen" name="dosen" required></input>
							<div class="result"></div>
						</div>
						<br />
						<br />
						Dengan ini mohon dibuatkan surat ijin observasi data di <br />
						Instansi <input type="text" class="form-control" name="instansi" placeholder="nama instansi" required></input>
						Alamat <textarea class="form-control" rows="3" name="alamat" placeholder="alamat instansi" required></textarea>
						<!-- Date range -->
						<div class="form-group">
							<label>Tanggal pelaksanaan</label>
							<input type="date" id="tglpelaksanaan" name="tanggal" required>
							<!-- /.input group -->
						</div>
						<!-- /.form group -->
						<input type="hidden" name="id" value="<?= $id; ?>"></input>
						<input type="hidden" name="nim" value="<?= $nim; ?>"></input>
						<input type="hidden" name="nama" value="<?= $nama; ?>"></input>
						<button type="submit" class="btn btn-success"> <i class="fa fa-file-upload"></i> Ajukan</button>
					</form>

				</div><!-- /.container-fluid -->
			</div>
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