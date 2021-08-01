<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['hakakses'] != "tendik") {
	header("location:../index.php?pesan=noaccess");
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
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="../system/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- date time picker -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>
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
							<h3>Pengajuan Izin <i>Work From Home</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<div class="content">
					<div class="container-fluid">
						<form role="form" method="post" action="wfh-simpan.php">
							<input type="hidden" class="form-control" name="iduser" value="<?= $iduser; ?>" readonly /></input>
							<b>Nama</b> <br />
							<input type="text" class="form-control" name="nama" value="<?= $nama; ?>" readonly /></input>
							<b>NIP / ID SIAKAD</b><br />
							<input type="text" class="form-control" name="nip" value="<?= $nip; ?>" readonly /></input>
							<b>Jabatan</b> <br />
							<input type="text" class="form-control" name="jabatan" value="<?= strtoupper($jabatan); ?>" readonly /></input>
							<b>Program Studi</b> <br />
							<input type="text" class="form-control" name="prodi" value="<?= $prodi; ?>" readonly /></input>
							<input type="hidden" class="form-control" name="fakultas" value="<?= $fakultas; ?>" readonly /></input>
							<br />
							<b>Rencana Kerja WFH hari-1</b><br>
							Tanggal
							<input type="date" id="tgl1" name="tgl1" class="form-control" value="<?= date('Y-m-d', strtotime('+1 day')); ?>" required>
							Kegiatan
							<textarea class="form-control" rows="3" id="kegiatan1" name="kegiatan1" placeholder="uraian kegiatan" required></textarea>
							<br />
							<b>Rencana Kerja WFH hari-2</b><br>
							Tanggal
							<input type="date" id="tgl2" name="tgl2" class="form-control">
							Kegiatan
							<textarea class="form-control" rows="3" id="kegiatan2" name="kegiatan2" placeholder="uraian kegiatan"></textarea>
							<br />
							<b>Rencana Kerja WFH hari-3</b><br>
							Tanggal
							<input type="date" id="tgl3" name="tgl3" class="form-control">
							Kegiatan
							<textarea class="form-control" rows="3" id="kegiatan3" name="kegiatan3" placeholder="uraian kegiatan"></textarea>
							<br />
							<b>Rencana Kerja WFH hari-4</b><br>
							Tanggal
							<input type="date" id="tgl4" name="tgl4" class="form-control">
							Kegiatan
							<textarea class="form-control" rows="3" id="kegiatan4" name="kegiatan4" placeholder="uraian kegiatan"></textarea>
							<br />
							<b>Rencana Kerja WFH hari-5</b><br>
							Tanggal
							<input type="date" id="tgl5" name="tgl5" class="form-control">
							Kegiatan
							<textarea class="form-control" rows="3" id="kegiatan5" name="kegiatan5" placeholder="uraian kegiatan"></textarea>
							<br />
							<button type="submit" class="btn btn-success btn-block" onclick="return confirm('Dengan ini saya menyatakan kebenaran data pada form ini')"> <i class="fa fa-save"></i> Ajukan</button>
						</form>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="../system/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
</body>

<!-- disable sat-sun on date picker -->
<script type="text/javascript">
	$('.datepicker').datepicker({
		daysOfWeekDisabled: [0, 6]
	});
</script>

</html>