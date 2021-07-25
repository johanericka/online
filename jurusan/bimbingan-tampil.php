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
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
	if($_SESSION['role']!="kajur"){
		if($_SESSION['role']!="koorpkl"){
			header("location:../index.php?pesan=noaccess");
		}
	}
	?>
	
	<?php
		$iduser = $_SESSION['iduser'];
	  $nip = $_SESSION['nip'];
		$nama = $_SESSION['nama'];
		$status = $_SESSION['status'];
		$jurusan = $_SESSION['jurusan'];
		$jabatan = $_SESSION['role'];
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
			<a href="" class="brand-link">
				<img src="../system/uin-malang-logo.png"
						 alt="UIN Malang"
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
						<!--
						<li class="nav-item">
							<a href="bimbingan-tampil.php" class="nav-link">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Mahasiswa Bimbingan
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
							<a href="notifikasi-isi.php" class="nav-link">
								<i class="nav-icon fas fa-bullhorn"></i>
								<p>
									Kirim Notifikasi
									<span class="right badge badge-danger"></span>
								</p>
							</a>
						</li>
						-->
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
									<a href="http://saintek.uin-malang.ac.id/wfh/doc/SE1889-2020.PDF" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>SE Rektor UIN Malang</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="http://saintek.uin-malang.ac.id/wfh/doc/panduandosen.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>Panduan Pengajuan WFH</p>
									</a>
								</li>
								<!--
								<li class="nav-item">
									<a href="http://saintek.uin-malang.ac.id/wfh/doc/panduankajur.pdf" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>Panduan Verifikasi FH</p>
									</a>
								</li>
								-->
							</ul>
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
							<h3></h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- ijin lab-->
			<section class="content">
				<!-- Default box -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Daftar Mahasiswa Pengguna Laboratorium </h3>
						<!-- card minimize -->
						<div class="card-tools">
							<!-- This will cause the card to maximize when clicked 
							<button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>-->
							<!-- This will cause the card to collapse when clicked -->
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
							<!-- This will cause the card to be removed when clicked
							<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button> -->
						</div>
					</div>
					<!-- /.card-header -->
					<?php $no = 1; ?>
					<div class="card-body p-0">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%" style="text-align:center">No</th>
									<th width="10%"style="text-align:center">NIM</th>
									<th style="text-align:center">Nama</th>
									<th style="text-align:center">Laboratorium</th>
									<th width="10%" colspan="2" style="text-align:center">Aksi</th>
                </tr>
                </thead>
                <tbody>
								
								<!-- ijin lab -->
								<?php
									$query = mysqli_query($dbsurat,"select * from ijinlab where validatordosen='$iduser' AND validasifakultas=1");
									$jmldata = mysqli_num_rows($query);
									while($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$namalab = $data['namalab'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $nim; ?></td>
										<td><?php echo $nama; ?></td>
										<td><?php echo $namalab; ?></td>
										<td>
										<a class="btn btn-info btn-sm" href="lab-tampil2.php?nodata=<?php echo $nodata; ?>">
											<i class="fas fa-search">
											</i>
											Lihat
										</a>
										</td>
									</tr>
								<?php
									$no++;
									}
								?>	
								<!-- /.ijin lab -->
								
                </tbody>
              </table>
            </div>
					</div>
				</div>
			</section>


		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- footer -->
		<?php include '../system/footerdsn.html' ?>
	<!-- /.footer -->
	<!-- jQuery -->
	<script src="../system/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../system/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../system/dist/js/demo.js"></script>
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
	
</html>
