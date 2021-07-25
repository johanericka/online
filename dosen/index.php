<?php
session_start();
$user = $_SESSION['user'];
$nip = $_SESSION['nip'];
$nama = $_SESSION['nama'];
$prodi = $_SESSION['prodi'];
$hakakses = $_SESSION['hakakses'];
$jabatan = $_SESSION['jabatan'];
if ($_SESSION['hakakses'] != "dosen") {
	header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
require('../system/myfunc.php');
?>

<?php
/*
//cek apabila ada data user kurang lengkap lempar ke update profile
$stmt = $dbsurat->prepare('SELECT * FROM pengguna WHERE nip=?');
$stmt->bind_param('s', $nip);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nohp = $dhasil['nohp'];
$email = $dhasil['email'];
if ($nohp == null or $email == null) {
	header("location:userprofile-tampil.php");
}
*/
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SAINTEK Digital Services</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../system/plugins/fontawesome-free/css/all.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="../system/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="../system/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="../system/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../system/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<?php
		require('navbar.php');
		?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php
		require('sidebar.php');
		?>
		<!-- ./Main Sidebar Container -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h3>Dashboard</h3>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			<?php
			if (isset($_GET['pesan'])) {
				if ($_GET['pesan'] == "success") {
			?>
					<div class="alert alert-success alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>UPDATE</strong> data berhasil
					</div>
			<?php
				}
			}
			?>
			<!-- pengajuan surat mahasiswa -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Default box -->
							<div class="card card-warning">
								<div class="card-header">
									<h3 class="card-title">Pengajuan Surat Mahasiswa </h3>
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
										<table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th width="5%" style="text-align:center">No</th>
													<th width="10%" style="text-align:center">NIM</th>
													<th style="text-align:center">Nama</th>
													<th style="text-align:center">Surat</th>
													<th width="15%" colspan="2" style="text-align:center">Aksi</th>
												</tr>
											</thead>
											<tbody>

												<!-- PKL Koordinator-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validator1='$nip' AND validasi1 = 0");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Pengantar PKL / Magang';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="pkl-koor-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /. PKL koordinator-->

												<!-- PKL as Kaprodi-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validator2='$nip' AND validasi2 = 0 AND validasi1=1");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Pengantar PKL / Magang';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="pkl-kaprodi-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /. PKL as kaprodi-->

												<!-- PKL as WD-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Pengantar PKL / Magang';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="pkl-wd-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /. PKL as WD-->

												<!-- ijin lab sebagai dosbing-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE validator1='$nip' AND validasi1 = 0");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Penggunaan Laboratorium';
													$verifikasi1 = $data['validasi1'];
													$verifikasi2 = $data['validasi2'];
													$verifikasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<?php
															if ($verifikasi1 == 0) {
															?>
																<a class="btn btn-info btn-sm" href="ijinlab-dosbing-tampil.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-search"></i>
																	Lihat
																</a>
															<?php
															};
															?>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.ijin lab sebagai dosbing -->

												<!-- ijin lab sebagai kaprodi-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE validator2='$nip' AND validasi2 = 0 AND validasi1=1");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Penggunaan Laboratorium';
													$verifikasi1 = $data['validasi1'];
													$verifikasi2 = $data['validasi2'];
													$verifikasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<?php
															if ($verifikasi2 == 0) {
															?>
																<a class="btn btn-info btn-sm" href="ijinlab-kaprodi-tampil.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-search"></i>
																	Lihat
																</a>
															<?php
															};
															?>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.ijin lab sebagai kaprodi -->

												<!-- ijin lab sebagai WD-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Penggunaan Laboratorium';
													$verifikasi1 = $data['validasi1'];
													$verifikasi2 = $data['validasi2'];
													$verifikasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<?php
															if ($verifikasi3 == 0) {
															?>
																<a class="btn btn-info btn-sm" href="ijinlab-wd-tampil.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-search"></i>
																	Lihat
																</a>
															<?php
															};
															?>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.ijin lab sebagai WD -->

												<!-- ijin penelitian as dosbing-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validator1='$nip' AND validasi1 = 0");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Penelitian';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="ijinpenelitian-dosen-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.ijin penelitian as dosbing-->

												<!-- ijin penelitian as kaprodi-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validator2='$nip' AND validasi2 = 0 AND validasi1=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Penelitian';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="ijinpenelitian-kaprodi-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.ijin penelitian as kaprodi-->

												<!-- ijin penelitian as WD-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Penelitian';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="ijinpenelitian-wd-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.ijin penelitian as WD-->

												<!-- peminjaman alat as dosen-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE validator1='$nip' AND validasi1 = 0");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Peminjaman Alat';
													$verifikasi1 = $data['validasi1'];
													$verifikasi2 = $data['validasi2'];
													$verifikasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="peminjamanalat-dosen-tampil.php?nodata=<?= $nodata; ?>">
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
												<!-- /peminjaman alat as dosen-->

												<!-- peminjaman alat as kaprodi-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE validator2='$nip' AND validasi2 = 0 AND validasi1=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Peminjaman Alat';
													$verifikasi1 = $data['validasi1'];
													$verifikasi2 = $data['validasi2'];
													$verifikasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="peminjamanalat-kaprodi-tampil.php?nodata=<?= $nodata; ?>">
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
												<!-- /peminjaman alat as kaprodi-->

												<!-- peminjaman alat as wd-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Peminjaman Alat';
													$verifikasi1 = $data['validasi1'];
													$verifikasi2 = $data['validasi2'];
													$verifikasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="peminjamanalat-wd-tampil.php?nodata=<?= $nodata; ?>">
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
												<!-- /peminjaman alat as wd-->

												<!-- Observasi as dosen-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validator1='$nip' AND validasi1 = 0");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Observasi';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="observasi-dosen-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
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
												<!-- /Observasi as dosen-->

												<!-- Observasi as kaprodi-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validator2='$nip' AND validasi2 = 0 AND validasi1=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Observasi';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="observasi-kaprodi-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
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
												<!-- /Observasi as kaprodi-->

												<!-- Observasi as WD-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Observasi';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="observasi-wd-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
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
												<!-- /Observasi as dosen-->

												<!-- pengambilan data as dosen -->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validator1='$nip' AND validasi1 = 0");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Pengambilan Data';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="pengambilandata-dosen-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
																<i class="fas fa-search"></i>
																Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /pengambilandata -->

												<!-- pengambilan data as kajur -->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validator2='$nip' AND validasi2 = 0 AND validasi1=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Pengambilan Data';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="pengambilandata-kaprodi-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
																<i class="fas fa-search"></i>
																Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /pengambilan data as kajur -->

												<!-- pengambilan data as wd -->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = 'Ijin Pengambilan Data';
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="pengambilandata-wd-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
																<i class="fas fa-search"></i>
																Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /pengambilan data as wd -->

												<!-- Surat Keterangan as dosen wali-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validator1='$nip' AND validasi1 = 0");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = $data['jenissurat'];
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="suket-dosen-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
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
												<!-- /Surat Keterangan as dosen wali-->

												<!-- Surat Keterangan as kaprodi-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validator2='$nip' AND validasi2 = 0");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = $data['jenissurat'];
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="suket-kaprodi-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
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
												<!-- /Surat Keterangan as kaprodi-->

												<!-- Surat Keterangan as WD-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$surat = $data['jenissurat'];
													$validasi1 = $data['validasi1'];
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php echo $nim; ?></td>
														<td><?php echo $nama; ?></td>
														<td><?php echo $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="suket-wd-tampil.php?nodata=<?php echo mysqli_real_escape_string($dbsurat, $nodata); ?>">
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
												<!-- /Surat Keterangan as WD-->

												<!-- SKPI as Dosen PA -->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE verifikator1='$nip'AND verifikasi1=0 GROUP BY nim");
												$jdata = mysqli_num_rows($query);
												if ($jdata > 0) {
													while ($data = mysqli_fetch_array($query)) {
														$nodata = $data['no'];
														$nim = $data['nim'];
														$nama = $data['nama'];
														$surat = "Surat Keterangan Pendamping Ijazah";
														$verifikasi1 = $data['verifikasi1'];
														$verifikasi2 = $data['verifikasi2'];
														$verifikasi3 = $data['verifikasi3'];
												?>
														<tr>
															<td><?php echo $no; ?></td>
															<td><?php echo $nim; ?></td>
															<td><?php echo $nama; ?></td>
															<td><?php echo $surat; ?></td>
															<td>
																<a class="btn btn-info btn-sm" href="skpi-dosen-tampil.php?nim=<?= mysqli_real_escape_string($dbsurat, $nim); ?>">
																	<i class="fas fa-search">
																	</i>
																	Lihat
																</a>
															</td>
														</tr>
												<?php
														$no++;
													}
												}
												?>
												<!-- /SKPI as Dosen PA -->

												<!-- SKPI as kaprodi -->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE verifikator2='$nip'AND verifikasi2=0 AND verifikasi1=1 GROUP BY nim");
												$jdata = mysqli_num_rows($query);
												if ($jdata > 0) {
													while ($data = mysqli_fetch_array($query)) {
														$nodata = $data['no'];
														$nim = $data['nim'];
														$nama = $data['nama'];
														$surat = "Surat Keterangan Pendamping Ijazah";
														$verifikasi1 = $data['verifikasi1'];
														$verifikasi2 = $data['verifikasi2'];
														$verifikasi3 = $data['verifikasi3'];
												?>
														<tr>
															<td><?php echo $no; ?></td>
															<td><?php echo $nim; ?></td>
															<td><?php echo $nama; ?></td>
															<td><?php echo $surat; ?></td>
															<td>
																<a class="btn btn-info btn-sm" href="skpi-kaprodi-tampil.php?nim=<?= mysqli_real_escape_string($dbsurat, $nim); ?>">
																	<i class="fas fa-search">
																	</i>
																	Lihat
																</a>
															</td>
														</tr>
												<?php
														$no++;
													}
												}
												?>
												<!-- /SKPI as kaprodi -->

												<!-- SKPI as WD -->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE verifikator3='$nip'AND verifikasi3=0 AND verifikasi2=1 GROUP BY nim");
												$jdata = mysqli_num_rows($query);
												if ($jdata > 0) {
													while ($data = mysqli_fetch_array($query)) {
														$nodata = $data['no'];
														$nim = $data['nim'];
														$nama = $data['nama'];
														$surat = "Surat Keterangan Pendamping Ijazah";
														$verifikasi1 = $data['verifikasi1'];
														$verifikasi2 = $data['verifikasi2'];
														$verifikasi3 = $data['verifikasi3'];
												?>
														<tr>
															<td><?php echo $no; ?></td>
															<td><?php echo $nim; ?></td>
															<td><?php echo $nama; ?></td>
															<td><?php echo $surat; ?></td>
															<td>
																<a class="btn btn-info btn-sm" href="skpi-wd-tampil.php?nim=<?= mysqli_real_escape_string($dbsurat, $nim); ?>">
																	<i class="fas fa-search">
																	</i>
																	Lihat
																</a>
															</td>
														</tr>
												<?php
														$no++;
													}
												}
												?>
												<!-- /SKPI as WD -->

												<!-- cetak KHS as kajur-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE validator2='$nip' AND validasi2 = 0");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$prodi = $data['prodi'];
													$surat = 'Permohonan Cetak KHS';
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?= $no; ?></td>
														<td><?= $nim; ?></td>
														<td><?= $nama; ?></td>
														<td><?= $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="cetakkhs-kaprodi-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.Cetak KHS as kajur-->

												<!-- cetak KHS as WD-->
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE validator3='$nip' AND validasi3 = 0 AND validasi2=1");
												$jmldata = mysqli_num_rows($query);
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$nim = $data['nim'];
													$nama = $data['nama'];
													$prodi = $data['prodi'];
													$surat = 'Permohonan Cetak KHS';
													$validasi2 = $data['validasi2'];
													$validasi3 = $data['validasi3'];
												?>
													<tr>
														<td><?= $no; ?></td>
														<td><?= $nim; ?></td>
														<td><?= $nama; ?></td>
														<td><?= $surat; ?></td>
														<td>
															<a class="btn btn-info btn-sm" href="cetakkhs-wd-tampil.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-search"></i> Lihat
															</a>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
												<!-- /.Cetak KHS as wd-->
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- data pengajuan pribadi -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Default box -->
							<div class="card card-primary">
								<div class="card-header">
									<h3 class="card-title">Rencana Kerja dan Surat Tugas <i>Work From Home</i></h3>
									<div class="card-tools">
										<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
									</div>
								</div>
								<!-- /.card-header -->
								<?php $no = 1; ?>
								<div class="card-body p-0">
									<!-- /.card-header -->
									<div class="card-body">
										<table id="example2" class="table table-bordered table-hover">
											<thead>
												<tr>
													<th width="5%">No</th>
													<th>Mulai WFH</th>
													<th>Akhir WFH</th>
													<th>Rencana Kerja</th>
													<th>Surat Tugas</th>
													<th>Keterangan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query = mysqli_query($dbsurat, "SELECT * FROM wfh WHERE nip='$nip' ORDER BY tglwfh1 DESC");
												while ($data = mysqli_fetch_array($query)) {
													$nodata = $data['no'];
													$tglwfh1 = $data['tglwfh1'];
													$tglwfh2 = $data['tglwfh2'];
													$tglwfh3 = $data['tglwfh3'];
													$tglwfh4 = $data['tglwfh4'];
													$tglwfh5 = $data['tglwfh5'];
													$verifikasiprodi = $data['verifikasiprodi'];
													$verifikasifakultas = $data['verifikasifakultas'];
													$keterangan = $data['keterangan'];
													if (date($tglwfh5) != 0) {
														$wfhselesai = $tglwfh5;
													} else {
														if (date($tglwfh4) != 0) {
															$wfhselesai = $tglwfh4;
														} else {
															if (date($tglwfh3) != 0) {
																$wfhselesai = $tglwfh3;
															} else {
																if (date($tglwfh2) != 0) {
																	$wfhselesai = $tglwfh2;
																}
															}
														}
													}
												?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><?php if (date($tglwfh1) != 0) {
																echo tgl_indo($tglwfh1);
															}  ?>
														</td>
														<td><?php
															if (isset($wfhselesai)) {
																echo tgl_indo($wfhselesai);
															}
															?>
														</td>
														<td>
															<?php
															if ($verifikasiprodi == 0) {
															?>
																<a class="btn btn-info btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-search">
																	</i>
																	<!--Lihat-->
																</a>
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi == 1) {
															?>
																<a class="btn btn-success btn-sm" href="wfh-cetakrk.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-print">
																	</i>
																	<!--Cetak-->
																</a>
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi == 2) {
															?>
																<a class="btn btn-danger btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-times">
																	</i>
																	<!--Cek-->
																</a>
															<?php
															};
															?>
														</td>
														<td>
															<?php
															if ($verifikasiprodi < 2 and $verifikasifakultas == 0) {
															?>
																<a class="btn btn-info btn-sm" href="wfh-tampil.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-search">
																	</i>
																	<!--Lihat-->
																</a>
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi < 2 and $verifikasifakultas == 1) {
															?>
																<a class="btn btn-success btn-sm" href="wfh-cetakst.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-print">
																	</i>
																	<!--Cetak-->
																</a>
															<?php
															};
															?>
															<?php
															if ($verifikasiprodi < 2 and $verifikasifakultas == 2) {
															?>
																<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="wfh-hapus.php?nodata=<?php echo $nodata; ?>">
																	<i class="fas fa-trash">
																	</i>
																</a>
															<?php
															};
															?>
														</td>
														<td>
															<?= $keterangan; ?>
														</td>
													</tr>
												<?php
													$no++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<!-- /.content-wrapper -->

		<!-- footer -->
		<?php
		include('footerdsn.php');
		?>
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
	<!-- DataTables  & Plugins -->
	<script src="../system/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="../system/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="../system/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../system/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="../system/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../system/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="../system/plugins/jszip/jszip.min.js"></script>
	<script src="../system/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="../system/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="../system/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="../system/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="../system/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../system/dist/js/demo.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
		});
	</script>
</body>

</html>