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
if ($_SESSION['role'] != "kajur") {
	if ($_SESSION['role'] != "kabag") {
		header("location:../index.php?pesan=belum_login");
	}
}
?>

<?php
$nodata = $_GET['nodata'];
$iduser = $_SESSION['iduser'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$status = $_SESSION['status'];
$jurusan = $_SESSION['jurusan'];
$jabatan = $_SESSION['role'];
$fakultas = "Sains dan Teknologi";
if ($iduser == '55022') {
	$jurusan = "Teknik Informatika";
}
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
							<a href="wfh-isi.php" class="nav-link">
								<i class="nav-icon fas fa-envelope"></i>
								<p>
									Pengajuan WFH
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
							<h3>Pengajuan <i>Work From Home</i></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- get data pengajuan wfh -->
				<?php
				//get data wfh from table wfh
				$query = mysqli_query($dbsurat, "select * from wfh where no='$nodata'");
				$data = mysqli_fetch_array($query);
				$nama = $data['nama'];
				$nip = $data['nip'];
				$jurusan = $data['jurusan'];
				$tglwfh1 = $data['tglwfh1'];
				$kegiatan1 = $data['kegiatan1'];
				$tglwfh2 = $data['tglwfh2'];
				$kegiatan2 = $data['kegiatan2'];
				$tglwfh3 = $data['tglwfh3'];
				$kegiatan3 = $data['kegiatan3'];
				$tglwfh4 = $data['tglwfh4'];
				$kegiatan4 = $data['kegiatan4'];
				$tglwfh5 = $data['tglwfh5'];
				$kegiatan5 = $data['kegiatan5'];
				$verifikasijurusan = $data['verifikasijurusan'];
				$verifikasifakultas = $data['verifikasifakultas'];
				$keterangan = $data['keterangan'];
				$jabatan = $_SESSION['role'];
				?>


				<div class="content">
					<div class="container-fluid">
						<form role="form">
							Nama <br />
							<input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" readonly /></input>
							NIP <br />
							<input type="text" class="form-control" name="niptk" value="<?php echo $nip; ?>" readonly /></input>
							Jabatan <br />
							<?php
							if ($jabatan == "kabag") {
								$jabatanresmi = "Kepala Bagian";
							} else {
								$jabatanresmi = "Ketua Program Studi";
							}
							?>
							<input type="text" class="form-control" name="jabatan" value="<?php echo $jabatanresmi; ?>" readonly /></input>
							<?php
							if ($jabatan == "kabag") {
								echo "Fakultas <br/>";
							} else {
								echo "Program Studi <br/>";
							}
							?>
							<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly /></input>
							<input type="hidden" class="form-control" name="kdjurusan" value="<?php echo $kdjurusan; ?>" readonly /></input>
							<input type="hidden" class="form-control" name="kdfakultas" value="<?php echo $kdfakultas; ?>" readonly /></input>
							<br />
							<?php $no = 1; ?>
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Tanggal WFH</th>
										<th>Rencana Kerja</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if (date($tglwfh1) != 0) {
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo tgl_indo($tglwfh1); ?></td>
											<td><?php echo ($kegiatan1); ?></td>
										</tr>
									<?php
										$no++;
									}
									?>
									<?php
									if (date($tglwfh2) != 0) {
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo tgl_indo($tglwfh2); ?></td>
											<td><?php echo ($kegiatan2); ?></td>
										</tr>
									<?php
										$no++;
									}
									?>
									<?php
									if (date($tglwfh3) != 0) {
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo tgl_indo($tglwfh3); ?></td>
											<td><?php echo ($kegiatan3); ?></td>
										</tr>
									<?php
										$no++;
									}
									?>
									<?php
									if (date($tglwfh4) != 0) {
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo tgl_indo($tglwfh4); ?></td>
											<td><?php echo ($kegiatan4); ?></td>
										</tr>
									<?php
										$no++;
									}
									?>
									<?php
									if (date($tglwfh5) != 0) {
									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo tgl_indo($tglwfh5); ?></td>
											<td><?php echo ($kegiatan5); ?></td>
										</tr>
									<?php
										$no++;
									}
									?>
								</tbody>
							</table>

							<?php
							if ($verifikasijurusan == 2 or $verifikasifakultas == 2) {
							?>

								<font color="red">Alasan Penolakan (*)</font>
								<textarea class="form-control" rows="3" name="keterangan" autofocus readonly><?php echo $keterangan; ?></textarea>
								<i>(*) Alasan penolakan oleh atasan</i>
							<?php
							};
							?>
							<br />
							<br />
						</form>
					</div><!-- /.container-fluid -->
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- footer -->
		<?php include '../system/footerdsn.html' ?>
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

</html>