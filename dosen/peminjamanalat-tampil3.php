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
	if($_SESSION['role']!="Dosen"){
			if($_SESSION['role']!="koorpkl"){
			header("location:../index.php?pesan=noaccess");			
		}
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
								<i class="nav-icon fas fa-envelope"></i>
								<p>
									Pengajuan Surat
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<!--
								<li class="nav-item">
									<a href="lab-isi.php" class="nav-link">
										<i class="nav-icon fa fa-flask"></i>
										<p>
											Ijin Layanan Lab.
											<span class="right badge badge-danger"></span>
										</p>
									</a>
								</li>
								-->
							</ul>
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
							<h3>Pengajuan Surat Ijin Peminjaman Alat</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- ambil data dari database-->
			<?php
				$nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
				$query = mysqli_query($dbsurat,"SELECT * FROM peminjamanalat WHERE id = $nodata");
				$data = mysqli_fetch_array($query);
					$nim = $data['nim'];
					$nama = $data['nama'];
					$judulskripsi = $data['judulskripsi'];
					$dosbing = $data['dosbing'];
					$pimpinaninstansi = $data['pimpinaninstansi'];
					$instansi = $data['instansi'];
					$alamat = $data['alamat'];
					$namaalat = $data['namaalat'];
					$jumlahalat = $data['jumlahalat'];
					$tanggalmulai = $data['tglpeminjamanmulai'];
					$tanggalselesai = $data['tglpeminjamanakhir'];
			?>
			
			<!-- Main content -->
			<section class="content">
				<div class="col-12 col-sm-6 col-lg-12">
					<div class="card card-success card-tabs">
						<form role="FORM" method="POST" >
							Dalam rangka menyelesaikan skripsi / penelitian saya <br/>
							<label>NIM </label>
							<input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly/>
							<br/>
							<label>Nama </label>
							<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" readonly/>
							<br/>
							<label>Judul Skripsi / penelitian </label>
							<textarea class="form-control" rows="3" name="judulskripsi" placeholder="judul skripsi / penelitian" readonly><?php echo $judulskripsi; ?></textarea>
							<br/>
							<label>Dosen Pembimbing </label>
							<input type="text" class="form-control" name="nama" value="<?php echo $dosbing; ?>" readonly/>
							<label><i>Maka kami mohon dibuatkan surat ijin peminjaman alat kepada </i></label><br>
							<label>Pimpinan Instansi</label>
							<input type="text" class="form-control" name="pimpinaninstansi" value="<?php echo $pimpinaninstansi; ?>" readonly/>
							<br/>
							<label>Nama Instansi</label>
							<input type="text" class="form-control" name="instansi" value="<?php echo $instansi; ?>" readonly/>
							<br/>
							<label>Alamat</label>
							<textarea class="form-control" rows="3" name="alamat" readonly> <?php echo $alamat ?></textarea>
							<br/>
							<label>Nama & spesifikasi alat</label>
							<textarea class="form-control" rows="3" name="namaalat" readonly><?php echo $namaalat; ?></textarea>
							<br/>
							<label>Jumlah alat</label>
							<input type="number" class="form-control" name="jumlahalat" value="<?php echo $jumlahalat; ?>" readonly/>
							<br/>
							<label>Waktu peminjaman</label>
							<div class="form-group">
								Mulai peminjaman
								<input type="text" id="tglpeminjamanmulai" name="tanggalmulai" value="<?php echo $tanggalmulai; ?>" readonly/>
								<br/>
								Akhir peminjaman
								<input type="text" id="tglpeminjamanakhir" name="tanggalakhir" value="<?php echo $tanggalselesai; ?>" readonly/>
								<br/>
							</div>
							<br/>
							<br/>
							<input type="hidden" name="nodata" value=<?php echo $nodata; ?> />
							<input type="hidden" name="nim" value=<?php echo $nim; ?> />
							<button name ="aksi" value="setujui" type="submit" formaction="datasurat-tampil.php" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Kembali</button>
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

	<!-- alert upload file -->
	<?php
		if(isset($_GET['error'])){
			if ($_GET['error']==0){
			?>
			<div class="alert alert-info alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Info : </strong> File berhasil di upload.
			</div>
			<?php
			}else if($_GET['error'] == 1){
			?>
			<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>ERROR : </strong> ukuran file maksimal 1MB.
			</div>
			<?php
			}else if($_GET['error'] == 2){
			?>
			<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>ERROR : </strong> ketika upload file.
			</div>
			<?php
			}else if($_GET['error'] == 3){
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
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 1000);
	</script>
	
	<!-- cari dosen -->
	<script src="../system/js/jquery-1.12.4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.search-box input[type="text"]').on("keyup input", function(){
					/* Get input value on change */
					var inputVal = $(this).val();
					var resultDropdown = $(this).siblings(".result");
					if(inputVal.length){
							$.get("cari-proses.php", {term: inputVal}).done(function(data){
									// Display the returned data in browser
									resultDropdown.html(data);
							});
					} else{
							resultDropdown.empty();
					}
			});
			// Set search input value on click of result item
			$(document).on("click", ".result p", function(){
					$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
					$(this).parent(".result").empty();
			});
	});
	</script>
	
</html>
