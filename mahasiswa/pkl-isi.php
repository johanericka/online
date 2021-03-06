<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../deauth.php");
}
require('../system/dbconn.php');
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
						<div class="col-sm-12">
							<h3>Pengajuan Surat Pengantar PKL / Magang</h3>
						</div>
					</div>
					<div class="alert alert-warning alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>PERHATIAN!!</strong> Cukup ketua kelompok yang mengajukan
					</div>
				</div>
			</section>

			<!-- Main content -->
			<?php
			$datamhs = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip='$nim'");
			// ambil data dari record
			$row = mysqli_fetch_array($datamhs);
			$nama = $row['nama'];
			?>
			<section>
				<div class="content">
					<div class="container-fluid">
						<form role="form" method="post" action="pkl-anggotatambah.php">
							<div class="form-group">
								<label style="color:red"><u>Siapkan Pakta Integritas PKL / Magang <a href="https://saintek.uin-malang.ac.id/online/doc/paktaintegritaspkl.docx" target="_blank"><b>Download disini </b></a></u></label>
								<br />
								<br />
								<label>Anggota PKL / Magang</label>
								<br />
								NIM
								<input type="number" name="nimanggota" autocomplete="none" />
								<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
								<button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Tambah</button>
							</div>
						</form>
						<div class="box">
							<div class="box-body">
								<table class="table table-bordered" id="tabel">
									<thead>
										<tr>
											<th>NO</th>
											<th>NIM</th>
											<th>NAMA</th>
											<th>TELEPON</th>
											<th>AKSI</th>
										</tr>
									</thead>
									<tbody>
										<!-- memasukkan pengusul -->
										<?php
										$qcari = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota = '$nim'");
										$data = mysqli_num_rows($qcari);
										if ($data == 0) {
											$qtambah = "insert into pklanggota (nimketua, nimanggota, nama) 
																		values('" . $nim . "','" . $nim . "','" . $nama . "')";
											$sql =  mysqli_query($dbsurat, $qtambah);
										}
										?>
										<!--baca status -->
										<?php
										if (isset($_GET['ket'])) {
											$status = mysqli_real_escape_string($dbsurat, $_GET['ket']);
											if ($status == 'notfound') {
										?>
												<div class="alert alert-danger alert-dismissible fade show">
													<button type="button" class="close" data-dismiss="alert">&times;</button>
													<strong>ERROR!</strong> Data tidak ditemukan.
												</div>
										<?php
											}
										}
										?>
										<?php
										$dataanggota = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimketua='$idmhs'");
										$no = 1;
										while ($q = mysqli_fetch_array($dataanggota)) {
											$id = $q['id'];
											$nimanggota = $q['nimanggota'];
											$nama = $q['nama'];
											$telepon = $q['telepon'];
										?>
											<tr>
												<td><?php echo $no++; ?></td>
												<?php $id; ?>
												<td><?= $nimanggota; ?></td>
												<td><?= $nama; ?></td>
												<td>
													<form action="pkl-anggotaubahtelepon.php" method="POST">
														<input type="number" name="telepon" value="<?= $telepon; ?>" required>
														<input type="hidden" name="nimanggota" value="<?= $nimanggota; ?>">
														<button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-save"></i> Simpan</button>
													</form>
												</td>
												<?php if (isset($_SESSION['iduser'])) : ?>
													<td>
														<a class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="pkl-anggotahapus.php?nimanggota=<?php echo $q['nimanggota']; ?>"><i class="fa fa-trash-alt"></i></a>
													</td>
												<?php endif; ?>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
						<br />
						<label>Dengan ini mendaftarkan diri sebagai perserta PKL / Magang di </label><br />
						<br />
						<?php
						if (isset($_GET['nodata'])) {
							$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
							$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE id='$nodata' and nim='$nim'");
							$data = mysqli_fetch_array($query);
							$instansi = $data['instansi'];
							$alamat = $data['alamat'];
							$tglmulai = $data['tglmulai'];
							$tglselesai = $data['tglselesai'];
							$tempatpkl = $data['tempatpkl'];
						}

						?>
						<form role="form" method="post" action="pkl-simpan.php">
							<input type="hidden" name="nim" value="<?php echo $nim; ?>"></input>
							<label>Instansi </label>
							<input type="text" class="form-control" name="instansi" placeholder="nama instansi" required /></input>
							<label>Tempat PKL / Magang </label>
							<input type="text" class="form-control" name="tempatpkl" placeholder="tempat PKL yang dituju" required></input>
							<label>Alamat </label>
							<input type="text" class="form-control" name="alamat" placeholder="alamat instansi" required></input>
							<br />
							<label>Tanggal</label>
							<div class="form-group">
								Mulai PKL / Magang
								<input type="date" id="tglmulai" name="tglmulai" required>
								Selesai PKL / Magang
								<input type="date" id="tglselesai" name="tglselesai" required>
							</div>
							<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
							<button type="submit" class="btn btn-success btn-block"> <i class="fa fa-file-upload"></i> Ajukan Surat</button>
						</form>
						<br />
						<br />
					</div>
				</div>

				<div class="content">
					<div class="container-fluid">
					</div>
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
	}, 2000);
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