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
	  $lokasi="coming soon ...";
	?>
	
	<!-- akses ke database -->
	<?php require_once('../system/dbconn.php'); ?>
	
	
	<!-- cek session -->
	<?php 
	session_start();
	if($_SESSION['role']!="dekan"){
		header("location:login.php?pesan=belum_login");
	}
	?>
	<?php
	  $nip = $_SESSION['nip'];
		$nama = $_SESSION['nama'];
		$status = $_SESSION['status'];
		$nodata = $_GET['nodata'];
		$iduser = $_SESSION['iduser'];
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
					$query = mysqli_query($dbsurat,"select * from wfh where no='$nodata'");
					$data = mysqli_fetch_array($query);
						$jurusan = $data['jurusan'];
						$nipstaf = $data['nip'];
						$namastaf = $data['nama'];
						$tglwfh1 = mysqli_real_escape_string($dbsurat, $data['tglwfh1']);
						$kegiatan1 = mysqli_real_escape_string($dbsurat, $data['kegiatan1']);
						$tglwfh2 = mysqli_real_escape_string($dbsurat, $data['tglwfh2']);
						$kegiatan2 = mysqli_real_escape_string($dbsurat, $data['kegiatan2']);
						$tglwfh3 = mysqli_real_escape_string($dbsurat, $data['tglwfh3']);
						$kegiatan3 = mysqli_real_escape_string($dbsurat, $data['kegiatan3']);
						$tglwfh4 = mysqli_real_escape_string($dbsurat, $data['tglwfh4']);
						$kegiatan4 = mysqli_real_escape_string($dbsurat, $data['kegiatan4']);
						$tglwfh5 = mysqli_real_escape_string($dbsurat, $data['tglwfh5']);
						$kegiatan5 = mysqli_real_escape_string($dbsurat, $data['kegiatan5']);
						$jabatan = $data['jabatan'];
				?>
				
				
				<div class="content">
					<div class="container-fluid">
						<form role="form" method="POST">
							Nama <br/>
							<input type="text" class="form-control" name="nama" value="<?php echo $namastaf; ?>" readonly/></input>
							NIP <br/>
							<input type="text" class="form-control" name="niptk" value="<?php echo $nipstaf; ?>" readonly/></input>
							Jabatan <br/>
							<input type="text" class="form-control" name="jabatan" value="<?php echo $jabatan; ?>" readonly/></input>
							<?php 
								if ($jurusan == "SAINTEK"){
									echo "Fakultas <br/>";
								}else{
									echo "Program Studi <br/>";
								};
							?>
							<input type="text" class="form-control" name="jurusan" value="<?php echo $jurusan; ?>" readonly/></input>
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
							if (isset($_GET['respon'])) {
								$respon = $_GET['respon'];
								if ($respon == "kosong") {
							?>
									<div class="alert alert-danger alert-dismissible fade show">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>ERROR!</strong> Alasan penolakan harus diisi
									</div>
							<?php
								}
							};
							?>
							<font color="red">Alasan Penolakan (*)</font>
							<textarea class="form-control" rows="3" name="keterangan"><?php echo $keterangan; ?></textarea>
							<i>(*) Wajib diisi apabila permohonan di tolak</i>
							<br />
							<br />
							<input type="hidden" name="nodata" value=<?php echo $nodata; ?>></input>
							<button name="aksi" value="setujui" type="submit" formaction="wfh-setujui.php" class="btn btn-success"> <i class="fa fa-check"></i> Setujui</button>
							<button name="aksi" value="tolak" type="submit" formaction="wfh-tolak.php?nodata=<?php echo $nodata; ?>" class="btn btn-danger"> <i class="fa fa-times"></i> Tolak</button>
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
    function tgl_indo($tanggal){
        $bulan = array (
        1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
	?>
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function(){
				$(this).remove(); 
			});
		}, 1000);
	</script>
</html>
