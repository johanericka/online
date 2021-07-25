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
			if($_SESSION['role']!="kabag"){
				header("location:../index.php?pesan=belum_login");
			}
		}
	?>
	<?php
		$iduser = $_SESSION['iduser'];
	  $nip = $_SESSION['nip'];
		$nama = $_SESSION['nama'];
		$status = $_SESSION['status'];
		$jurusan = $_SESSION['jurusan'];
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
							<a href="wfh-rekap.php" class="nav-link">
								<i class="nav-icon fa fa-check-square"></i>
								<p>
									Rekap. Pengajuan WFH
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
								<li class="nav-item">
									<a href="http://saintek.uin-malang.ac.id/wfh/doc/panduankajur.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>Panduan Verifikasi WFH</p>
									</a>
								</li>
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
							<h3>Pengajuan Rencana Kerja</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="card card-success">
					<div class="card-header">
						<h3 class="card-title">Rekap. Pengajuan Rencana Kerja WFH</h3>
					</div>
					<!-- /.card-header -->
					<?php $no = 1; ?>
					<div class="card-body p-0">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
									<!--<th>NIP</th>-->
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Status</th>
                </tr>
                </thead>
                <tbody>
								<?php
									$halperpage = 10;
									$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
									$mulai = ($page>1) ? ($page * $halperpage) - $halperpage : 0;
									$result = mysqli_query($dbsurat,"SELECT * FROM wfh where verifikatorjurusan='$iduser'");
									$total = mysqli_num_rows($result);
									$pages = ceil($total/$halperpage);            
									//$sql = mysqli_query($conn,"SELECT * FROM pengguna LIMIT $mulai, $halperpage");
									$query = mysqli_query($dbsurat,"select * from wfh where verifikatorjurusan='$iduser' order by tglsurat desc LIMIT $mulai, $halperpage");
									$no = $mulai+1;
											
									$jmldata = mysqli_num_rows($query);
									while($data = mysqli_fetch_array($query)) {
										$tglsurat = $data['tglsurat'];
										$jurusan = $data['jurusan'];
										$nipstaf = $data['nip'];
										$namastaf = $data['nama'];
										$jabatan = $data['jabatan'];
										$verifikasijurusan = $data['verifikasijurusan'];
										if($verifikasijurusan == 0){
											$status = "Menunggu verifikasi";
										}else{
											if($verifikasijurusan == 1 ){
												$status = "Disetujui";
											}else{
												$status = "Ditolak";
											}
										}
										$nosurat = $data['keterangan'];
								?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo tgl_indo($tglsurat); ?></td>
										<td><?php echo $namastaf; ?></td>
										<td><?php echo $jabatan; ?></td>
										<td><?php echo $status; ?></td>
									</tr>
								<?php
									$no++;
									}
								?>	
                </tbody>
              </table>
							<div class="card-footer text-right">
								<?php for ($i=1; $i<=$pages ; $i++){ ?>
								<a class="btn btn-info btn-md" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
								<?php } ?>
							</div> 
            </div>
            <!-- /.card-body -->
					</div>
					<!-- /.card -->
							<!-- /.content -->
				</div>
			</section>
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
