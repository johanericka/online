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
	  $lokasi="coming soon ...";
	?>
	
	<!-- akses ke database -->
	<?php require_once('../system/dbconn.php'); ?>
	
	
	<!-- cek session -->
	<?php 
	session_start();
	if($_SESSION['role']!="mahasiswa"){
		header("location:../index.php?pesan=noaccess");
	}
	?>
	
	<?php
	  $iduser = mysqli_real_escape_string($dbsurat,$_SESSION['iduser']);
	  $nim = mysqli_real_escape_string($dbsurat,$_SESSION['nim']);
		$nama = mysqli_real_escape_string($dbsurat,$_SESSION['nama']);
		$jurusan = mysqli_real_escape_string($dbsurat,$_SESSION['jurusan']);
		$status = mysqli_real_escape_string($dbsurat,$_SESSION['status']);
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
				<img src="../system/uin-malang-logo.png"
						 alt="../../system Logo"
						 class="brand-image img-circle elevation-3"
						 style="opacity: .8">
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
			
			<!-- dapatkan no surat -->
			<?php
				$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE nim='$nim' AND validatordosen is null");
				$data = mysqli_fetch_array($query);
					$nodata = $data['no'];
			?>
			
			<!-- Main content -->
			<section class="content">
				<div class="col-12 col-sm-6 col-lg-12">
					<div class="card card-success card-tabs">
						<b>Lampiran 1 - Screenshot hasil screening bebas COVID-19</b>
						<br/>
						Upload Hasil Pemeriksaan Screening Bebas COVID-19 <a href="http://kedokteran.uin-malang.ac.id/konsuldokter/formulir" target="_blank"><b>Isi form disini</b></a>
						<br/>
						<form action="ajaxupload.php" enctype="multipart/form-data" class="form-horizontal" method="post">										
							<input type="file" name="image" class="form-control" />
							<small style="color:blue"><i>*) Ukuran file maksimal 1MB format PDF / JPG</i></small>
							<br/>
							<br/>
							<input type="hidden" name="nim" value="<?php echo $nim; ?>" />
							<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
							<button class="btn btn-block btn-primary btn-upload" name="upload" value="screeningcovid"><i class="fa fa-arrow-up"></i> Upload Hasil Screening COVID-19</button>
						</form>
						<br/>
						<?php
							$query = mysqli_query($dbsurat,"SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='screeningcovid'");
							$cekhasil = mysqli_num_rows($query);
							if ($cekhasil > 0){
								$data = mysqli_fetch_array($query);
									$namafile = $data['namafile'];
							}else{
								$namafile = '../uploads/noimage.gif';
							}
						?>
						<?php
							$ext = substr($namafile,-3);
							if($ext == "pdf"){
						?>
							<div><iframe src="<?php echo $namafile; ?>" width="80%" height="500px" ></iframe></div>
						<?php
							}else{
						?>
							<div><img src="<?php echo $namafile; ?>" width="50%" height="80%" ></div>
						<?php
							}
						?>
						<br/>
						<a href="lab-isi.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali </a>
						<?php 
							if($cekhasil > 0){
						?>
							<a href="lab-isi-lamp4.php" class="btn btn-success"><i class="fa fa-arrow-right"></i> Berikutnya </a>
						<?php
							}else{
						?>
							<a href="lab-isi-lamp4.php" class="btn btn-success disabled"><i class="fa fa-arrow-right"></i> Berikutnya </a>
						<?php
							}
						?>
					</div>
				</div>
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
    function tgl_indo($tanggal){
        $bulan = array (
        1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
	?>
	
	<!-- timer untuk alert -->
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 1000);
	</script>
	
</html>
