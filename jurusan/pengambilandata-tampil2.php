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
	  $iduser = $_SESSION['iduser'];
	  $nip = $_SESSION['nip'];
		$nama = $_SESSION['nama'];
		$jurusan = $_SESSION['jurusan'];
		$status = $_SESSION['status'];
	?>
	
	<?php 
	//if($_SESSION['role']="mahasiswa"){
	//	header("location:../index.php?pesan=noaccess");
	//}
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
						<a href="#" class="d-block">NIP : <?php echo $nim; ?></a>
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
							<h3>Pengajuan Surat Ijin Penelitian</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- ambil data dari database-->
			<?php
				$nodata = $_GET['nodata'];
				$datamhs = mysqli_query($dbsurat,"SELECT * FROM pengambilandata WHERE id='$nodata'");
				$row = mysqli_fetch_array($datamhs);
					$nim = $row['nim'];
					$nama = $row['nama'];
					$judulskripsi = $row['judulskripsi'];
					$dosbing = $row['dosbing'];
					$instansi = $row['instansi'];
					$alamat = $row['alamat'];
					$tglpelaksanaan = $row['tglpelaksanaan'];
					$tglselesai = $row['tglselesai'];
					$data = $row['data'];
					$keterangan = $row['keterangan'];
			?>
			
			<!-- Main content -->
			<section class="content">
				<div class="col-12 col-sm-6 col-lg-12">
					<div class="card card-success card-tabs">
						<form role="FORM" method="POST" >
							Dalam rangka menyelesaikan skripsi / penelitian saya <br/>
							NIM <br/>
							<input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly/></input>
							Nama <br/>
							<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" readonly/></input>
							Judul Skripsi / penelitian <br/>
							<textarea class="form-control" rows="3" name="judulskripsi" readonly/><?php echo $judulskripsi; ?></textarea>
							<br/>
							Dosen Pembimbing <br/>
							<input type="text" class="form-control" name="dosbing" value="<?php echo $dosbing ?>" readonly/></input>
							Maka kami mohon dibuatkan surat ijin pengambilan data / sample di  <br>
							<label>Instansi</label> 
							<input type="text" class="form-control" name="instansi" value="<?php echo $instansi; ?>" readonly /></input>
							<label>Alamat</label> 
							<textarea class="form-control" rows="3" name="alamat" readonly /><?php echo $alamat; ?></textarea>
							<label>Tanggal Pelaksanaan</label><br/>
							<input type="text" class="form-control" name="tglpelaksanaan" value="<?php echo $tglpelaksanaan; ?>" readonly /></input>
							<label>Data / sample :</label> 
							<textarea class="form-control" rows="3" name="data" readonly /><?php echo $data; ?></textarea>
							
							Demikian Permohonan saya, atas perkenanya disampaikan terima kasih<br/>
							<strong>Wassalamu’alaikum Wr. Wb</strong><br/>
							<br/>
								<?php
									$respon = $_GET['respon'];
									if ($respon == "kosong"){
								?>
								<div class="alert alert-danger alert-dismissible fade show">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									<strong>ERROR!</strong> Alasan penolakan harus diisi
								</div>
								<?php
									}
								?>
							<font color="red">Alasan Penolakan (*)</font> 
							<textarea class="form-control" rows="3" name="keterangan"/></textarea>
							<i>(*) Wajib diisi apabila permohonan di tolak</i>
							<br/>
							<br/>
							<input type="hidden" name="nodata" value=<?php echo $nodata; ?>></input>
							<input type="hidden" name="nim" value=<?php echo $nim ; ?>></input>
							<button name ="aksi" value="setujui" type="submit" formaction="pengambilandata-setujui2.php" class="btn btn-success"> <i class="fa fa-check"></i> Setujui</button>
							<button name ="aksi" value="tolak" type="submit" formaction="pengambilandata-tolak2.php?nim=<?php echo $nim; ?>" class="btn btn-danger"> <i class="fa fa-times"></i> Tolak</button>
						</form>
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

	<!-- timer untuk alert -->
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 1000);
	</script>
	
</html>
