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
							<h3>Pengajuan Surat Keterangan</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- ambil data mahasiswa dari database -->
			<?php
			$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
			$datamhs = mysqli_query($dbsurat, "select * from suket where id='$nodata'");
			$row = mysqli_fetch_array($datamhs);
			$nim = $row['nim'];
			$nama = $row['nama'];
			$jurusan = $row['jurusan'];
			$jenissurat = $row['jenissurat'];
			$validasidosen = $row['validasidosen'];
			$validasijurusan = $row['validasijurusan'];
			$validasifakultas = $row['validasifakultas'];
			$keperluan = $row['keperluan'];
			$keterangan = $row['keterangan'];
			?>

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					Saya yang bertanda tangan di bawah ini <br />
					NIM <br />
					<input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly /></input>
					Nama <br />
					<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" readonly /></input>
					Jurusan <br />
					<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan ?>" readonly /></input>
					<br />
					Mengajukan permohonan <br />
					<input type="text" class="form-control" name="jenissurat" value="<?php echo $jenissurat ?>" readonly /></input>
					<br />
					<!-- tampilka pakta integritas -->
					<?php
					$query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='khs'");
					$cekhasil = mysqli_num_rows($query);
					if ($cekhasil > 0) {
						$data = mysqli_fetch_array($query);
						$namafile = $data['namafile'];
					} else {
						$namafile = '../uploads/noimage.gif';
					}
					?>
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
					<br />
					<div class="form-group">
						<label>Untuk Keperluan</label>
						<textarea class="form-control" rows="3" placeholder="" name="keperluan" readonly><?php echo $keperluan ?></textarea>
					</div>
					<?php
					if ($validasidosen > 1 or $validasifakultas > 1 or $validasijurusan > 1) {
					?>
						<div class="form-group">
							<label>Alasan Penolakan</label>
							<textarea class="form-control" rows="3" placeholder="" name="keperluan" readonly><?php echo $keterangan ?></textarea>
						</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>

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