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
	
	<?php
		session_start();
	  $iduser = $_SESSION['iduser'];
	  $nip = $_SESSION['nip'];
		$nama = $_SESSION['nama'];
		$jurusan = $_SESSION['jurusan'];
		$status = $_SESSION['status'];
	?>
	
	<!-- cek session -->
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
							<h3>Pengajuan Surat Keterangan</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- ambil data mahasiswa dari database -->
			<?php
			  $nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
				$datamhs = mysqli_query($dbsurat,"select * from suket where id='$nodata'");
				$row = mysqli_fetch_array($datamhs);
					$nim = $row['nim'];
					$nama = $row['nama'];
					$jurusan = $row['jurusan'];
					$jenissurat = $row['jenissurat'];
					$keperluan = $row['keperluan'];
			?>
			
			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					Saya yang bertanda tangan di bawah ini <br/>
						NIM <br/>
						<input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly/></input>
						Nama <br/>
						<input type="text" class="form-control" name="nama" value="<?php echo $nama ?>" readonly/></input>
						Jurusan <br/>
						<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan ?>" readonly/></input>
						<br/>
						Mengajukan permohonan	<br/>
						<input type="text" class="form-control" name="jenissurat" value="<?php echo $jenissurat ?>" readonly/></input>
						<br/>
						<!-- tampilkan KHS -->
						<?php
							$query = mysqli_query($dbsurat,"SELECT * FROM upload WHERE nim='$nim' AND nodata = '$nodata' AND keterangan='khs'");
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
							<div><img src="<?php echo $namafile; ?>" width="80%" /></div>
						<?php
							}
						?>
						<!-- /tampilkan khs -->
						<br/>
						<div class="form-group">
							<label>Untuk Keperluan</label>
							<textarea class="form-control" rows="3" placeholder="" name="keperluan" readonly><?php echo $keperluan ?></textarea>
						</div>
						<form role="form" method="POST">
							<br/>
							<br/>
							<input type="hidden" name="nim" value="<?php echo $nim; ?>"></input>
							<input type="hidden" name="koorjurusan" value="<?php echo $iduser; ?>" />
							<input type="hidden" name="nodata" value="<?php echo $nodata; ?>" />
							<button name ="aksi" value="setujui" type="submit" formaction="datasurat-tampil.php" class="btn btn-success"> <i class="fa fa-arrow-left"></i> Kembali</button>
						</form>
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
