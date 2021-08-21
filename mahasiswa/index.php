<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
require('../system/myfunc.php');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
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
		<?php require('sidebar.php'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-12">
							<h3>Dashboard </h3>
						</div>
					</div>
					<div class="alert alert-danger alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>PERHATIAN! </strong> segera Lengkapi data pada menu User Profile.
					</div>
				</div><!-- /.container-fluid -->
			</section>



			<!-- pengajuan surat mahasiswa -->
			<section class="content">
				<!-- Default box -->
				<div class="card card-warning">
					<div class="card-header">
						<h3 class="card-title">Pengajuan surat mahasiswa </h3>
						<!-- card minimize -->
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<?php $no = 1; ?>
					<div class="card-body p-0">
						<!-- /.card-header -->
						<div class="card-body">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="5%" style="text-align:center">No</th>
										<th style="text-align:center">Surat</th>
										<th style="text-align:center">Status</th>
										<th width="15%" style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<!-- ijin lab -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim'");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$tanggal = $data['tanggal'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Penggunaan Laboratorium';
										$validator0 = $data['validator0'];
										$validasi0 = $data['validasi0'];
										$tglvalidasi0 = tgl_indo($data['tglvalidasi0']);
										$validator1 = $data['validator1'];
										$validasi1 = $data['validasi1'];
										$tglvalidasi1 = tgl_indo($data['tglvalidasi1']);
										$validasi2 = $data['validasi2'];
										$validator2 = $data['validator2'];
										$tglvalidasi2 = tgl_indo($data['tglvalidasi2']);
										$validasi3 = $data['validasi3'];
										$validator3 = $data['validator3'];
										$tglvalidasi3 = tgl_indo($data['tglvalidasi3']);
										$keterangan = $data['keterangan'];
										$statussurat = $data['statuspengajuan'];

									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<!-- data belum lengkap -->
												<?php
												if ($statussurat == -1) {
												?>
													<p style="color:red">Data belum lengkap</p>
												<?php
												} else {
												?>
													<!-- dosen pembimbing -->
													<?php
													if ($validasi0 == 0) {
													?>
														Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validator0); ?><br />
													<?php
													} elseif ($validasi0 == 1) {
													?>
														Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validator0); ?> <br />
													<?php
													} else {
													?>
														Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validator0); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
													<?php
													};
													?>
													<!-- kepala lab -->
													<?php
													if ($validasi1 == 0) {
													?>
														Menunggu verifikasi Kepala Lab. <?= namadosen($dbsurat, $validator1); ?><br />
													<?php
													} elseif ($validasi1 == 1) {
													?>
														Telah disetujui Kepala Lab. <?= namadosen($dbsurat, $validator1); ?> <br />
													<?php
													} else {
													?>
														Ditolak Kepala Lab. <?= namadosen($dbsurat, $validator1); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
													<?php
													};
													?>
													<!-- ketua jurusan -->
													<?php
													if ($validasi2 == 0) {
													?>
														Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
													<?php
													} elseif ($validasi2 == 1) {
													?>
														Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
													<?php
													};
													?>
													<!-- WD-1 -->
													<?php
													if ($validasi3 == 0) {
													?>
														Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?><br />
													<?php
													} elseif ($validasi3 == 1) {
													?>
														Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b></b><br />
												<?php
													}
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == -1) {
												?>
													<a class="btn btn-info btn-sm" href="ijinlab-isi2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-file"></i>
														Lengkapi
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="ijinlab-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												} elseif ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="ijinlab-cetak.php?nodata=<?php echo $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i>
														Cetak
													</a>
												<?php
												} elseif ($statussurat == 0) {
												?>
													<a class="btn btn-secondary btn-sm" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="ijinlab-hapus.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="ijinlab-hapus.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												}
												?>
											</td>
										</tr>
										<!-- /ijin lab -->

									<?php
										$no++;
									}
									?>

									<!-- Ijin PKL -->
									<?php
									$query1 = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota = '$nim'");
									$jquery1 = mysqli_num_rows($query1);
									if ($jquery1 > 0) {
										$dquery1 = mysqli_fetch_array($query1);
										$nimketuapkl = $dquery1['nimketua'];
									} else {
										$nimketuapkl = $nim;
									}

									$query2 = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE nim = '$nimketuapkl'");
									while ($q = mysqli_fetch_array($query2)) {
										$nodata = $q['no'];
										$nimketua = $q['nim'];
										$namaketua =  $q['nama'];
										$validasi1 = $q['validasi1'];
										$validator1 = $q['validator1'];
										$tglvalidasi1 = $q['tglvalidasi1'];
										$validasi2 = $q['validasi2'];
										$validator2 = $q['validator2'];
										$tglvalidasi2 = $q['tglvalidasi2'];
										$validasi3 = $q['validasi3'];
										$validator3 = $q['validator3'];
										$tglvalidasi3 = $q['tglvalidasi3'];
										$keterangan = $q['keterangan'];
										$statussurat = $q['statussurat'];
									?>

										<tr>
											<td><?php echo $no++; ?></td>
											<td>Surat Pengantar PKL <br />
											</td>
											<td>
												<?php
												if ($statussurat == -1) {
												?>
													<p style="color:red">Data belum lengkap</p>
												<?php
												} else {
												?>
													<!-- koordinator PKL -->
													<?php
													if ($validasi1 == 0) {
													?>
														Menunggu verifikasi Dosen Koordinator PKL <?= namadosen($dbsurat, $validator1); ?><br />
													<?php
													} elseif ($validasi1 == 1) {
													?>
														Telah disetujui Dosen Koordinator PKL <?= namadosen($dbsurat, $validator1); ?> <br />
													<?php
													} else {
													?>
														Ditolak Dosen Koordinator PKL <?= namadosen($dbsurat, $validatovalidator1rkoor); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
													<?php
													};
													?>
													<!-- ketua jurusan -->
													<?php
													if ($validasi2 == 0) {
													?>
														Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
													<?php
													} elseif ($validasi2 == 1) {
													?>
														Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
													<?php
													};
													?>
													<!-- WD-1 -->
													<?php
													if ($validasi3 == 0) {
													?>
														Menunggu verifikasi Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?><br />
													<?php
													} elseif ($validasi3 == 1) {
													?>
														Telah disetujui Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
												<?php
													}
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == -1) {
												?>
													<a class="btn btn-info btn-sm" href="pkl-isianggota.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-file"></i> Lengkapi
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="pkl-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												} elseif ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="pkl-cetak.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-print"></i>
														Cetak
													</a>
												<?php
												} elseif ($statussurat == 0) {
												?>
													<a class="btn btn-secondary btn-sm" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="pkl-hapus.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="pkl-hapus.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /Ijin PKL -->

									<!-- Surat Keterangan -->
									<?php
									$data = mysqli_query($dbsurat, "SELECT * FROM suket WHERE nim='$nim'");
									$cek = mysqli_num_rows($data);
									while ($q = mysqli_fetch_array($data)) {
										$nodata = $q['no'];
										$nim = $q['nim'];
										$validasi1 = $q['validasi1'];
										$validator1 = $q['validator1'];
										$validasi2 = $q['validasi2'];
										$validator2 = $q['validator2'];
										$validasi3 = $q['validasi3'];
										$validator3 = $q['validator3'];
										$keterangan = $q['keterangan'];
										$statussurat = $q['statussurat'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $q['jenissurat']; ?></td>
											<td>
												<!-- dosen wali -->
												<?php
												if ($validator1 <> '') {
													if ($validasi1 == 0) {
												?>
														Menunggu verifikasi Dosen Wali <?= namadosen($dbsurat, $validator1); ?><br />
													<?php
													} elseif ($validasi1 == 1) {
													?>
														Telah disetujui Dosen Wali <?= namadosen($dbsurat, $validator1); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Dosen Wali <?= namadosen($dbsurat, $validator1); ?> dengan alasan <b style="color:red"> <?= $keterangan; ?></b><br />
												<?php
													}
												};
												?>

												<!-- ketua jurusan -->
												<?php
												if ($validasi2 == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
												<?php
												} elseif ($validasi2 == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <b style="color:red"> <?= $keterangan; ?></b><br />
												<?php
												};
												?>
												<!-- WD-3 -->
												<?php
												if ($validasi3 == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?><br />
												<?php
												} elseif ($validasi3 == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?> dengan alasan <b style="color:red"> <?= $keterangan; ?></b><br />
												<?php
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="suket-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i> Cetak
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="suket-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												} else {
												?>
													<a class="btn btn-secondary btn-sm" onclick="return alert('Harap menunggu proses verifikasi')" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="suket-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /surat keterangan -->

									<!-- Permohonan Cetak KHS -->
									<?php
									$data = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE nim = '$nim'");
									$cek = mysqli_num_rows($data);
									while ($q = mysqli_fetch_array($data)) {
										$nodata = $q['no'];
										$validasi2 = $q['validasi2'];
										$validator2 = $q['validator2'];
										$tglvalidasi2 = $q['tglvalidasi2'];
										$validasi3 = $q['validasi3'];
										$validator3 = $q['validator3'];
										$tglvalidasi3 = $q['tglvalidasi3'];
										$statussurat = $q['statussurat'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Permohonan Cetak KHS"; ?></td>
											<td>
												<!-- ketua jurusan -->
												<?php
												if ($validasi2 == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
												<?php
												} elseif ($validasi2 == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($validasi3 == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?><br />
												<?php
												} elseif ($validasi3 == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="cetakkhs-cetak.php?nodata='.$nodata.'" target="_blank">
														<i class="fas fa-print"></i> Cetak
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="cetakkhs-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												} else {
												?>
													<a class="btn btn-secondary btn-sm" onclick="return alert('Harap menunggu proses verifikasi')" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="cetakkhs-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /Permohonan Cetak KHS -->

									<!-- ijin penelitian -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE nim = '$nim'");
									$cek = mysqli_num_rows($query);
									while ($q = mysqli_fetch_array($query)) {
										$nodata = $q['no'];
										$validasi1 = $q['validasi1'];
										$validator1 = $q['validator1'];
										$tglvalidasi1 = $q['tglvalidasi1'];
										$validasi2 = $q['validasi2'];
										$validator2 = $q['validator2'];
										$tglvalidasi3 = $q['tglvalidasi3'];
										$validasi3 = $q['validasi3'];
										$validator3 = $q['validator3'];
										$tglvalidasi3 = $q['tglvalidasi3'];
										$statussurat = $q['statussurat'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Permohonan Ijin Penelitian"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($validasi1 == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?><br />
												<?php
												} elseif ($validasi1 == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($validasi2 == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
												<?php
												} elseif ($validasi1 == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($validasi3 == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?><br />
												<?php
												} elseif ($validasi3 == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="ijinpenelitian-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i> Cetak
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="ijinpenelitian-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												} else {
												?>
													<a class="btn btn-secondary btn-sm" onclick="return alert('Harap menunggu proses verifikasi')" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="ijinpenelitian-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /ijin penelitian -->

									<!-- peminjaman alat -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE nim = '$nim'");
									while ($q = mysqli_fetch_array($query)) {
										$nodata = $q['no'];
										$nim = $q['nim'];
										$validasi1 = $q['validasi1'];
										$validator1 = $q['validator1'];
										$tglvalidasi1 = $q['tglvalidasi1'];
										$validasi2 = $q['validasi2'];
										$validator2 = $q['validator2'];
										$tglvalidasi2 = $q['tglvalidasi2'];
										$validasi3 = $q['validasi3'];
										$validator3 = $q['validator3'];
										$tglvalidasi3 = $q['tglvalidasi3'];
										$keterangan = $q['keterangan'];
										$statussurat = $q['statussurat'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Permohonan Peminjaman Alat"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($validasi1 == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?><br />
												<?php
												} elseif ($validasi1 == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($validasi2 == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
												<?php
												} elseif ($validasi2 == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($validasi3 == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?><br />
												<?php
												} elseif ($validasi3 == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="peminjamanalat-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i> Cetak
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="peminjamanalat-hapus.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												} else {
												?>
													<a class="btn btn-secondary btn-sm" onclick="return alert('Harap menunggu proses verifikasi')" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="peminjamanalat-hapus.php?nodata=<?= $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /peminjaman alat -->

									<!-- pengambilan data -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE nim = '$nim'");
									while ($q = mysqli_fetch_array($query)) {
										$nodata = $q['no'];
										$nim = $q['nim'];
										$validasi1 = $q['validasi1'];
										$validator1 = $q['validator1'];
										$tglvalidasi1 = $q['tglvalidasi1'];
										$validasi2 = $q['validasi2'];
										$validator2 = $q['validator2'];
										$tglvalidasi2 = $q['tglvalidasi2'];
										$validasi3 = $q['validasi3'];
										$validator3 = $q['validator3'];
										$tglvalidasi3 = $q['tglvalidasi3'];
										$statussurat = $q['statussurat'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Ijin Pengambilan Data"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($validasi1 == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?><br />
												<?php
												} elseif ($validasi1 == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($validasi2 == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
												<?php
												} elseif ($validasi2 == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($validasi3 == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?><br />
												<?php
												} elseif ($validasi3 == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validator3); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td>
												<?php
												if ($statussurat == 1) {
												?>
													<a class="btn btn-success btn-sm" href="pengambilandata-cetak.php?nodata=<?= $nodata; ?>" target="_blank">
														<i class="fas fa-print"></i> Cetak
													</a>
												<?php
												} elseif ($statussurat == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="peminjamanalat-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												} else {
												?>
													<a class="btn btn-secondary btn-sm" onclick="return alert('Harap menunggu proses verifikasi')" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="peminjamanalat-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /pengambilan data -->

									<!-- Ijin observasi -->
									<?php
									$query1 = mysqli_query($dbsurat, "SELECT * FROM observasianggota WHERE nimanggota = '$nim'");
									$jquery1 = mysqli_num_rows($query1);
									if ($jquery1 > 0) {
										while ($dquery1 = mysqli_fetch_array($query1)) {
											$nimketuaobservasi = $dquery1['nimketua'];
											$query2 = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE nim = '$nimketuaobservasi'");
											while ($q = mysqli_fetch_array($query2)) {
												$nodata = $q['no'];
												$nimketua = $q['nim'];
												$namaketua =  $q['nama'];
												$validasi1 = $q['validasi1'];
												$validator1 = $q['validator1'];
												$tglvalidasi1 = $q['tglvalidasi1'];
												$validasi2 = $q['validasi2'];
												$validator2 = $q['validator2'];
												$tglvalidasi2 = $q['tglvalidasi2'];
												$validasi3 = $q['validasi3'];
												$validator3 = $q['validator3'];
												$tglvalidasi3 = $q['tglvalidasi3'];
												$keterangan = $q['keterangan'];
												$statussurat = $q['statussurat'];
									?>

												<tr>
													<td><?php echo $no++; ?></td>
													<td>Surat Pengantar Observasi <br />
														Ketua <?= $namaketua; ?>
													</td>
													<td>
														<?php
														if ($statussurat == -1) {
														?>
															<p style="color:red">Data belum lengkap</p>
														<?php
														} else {
														?>
															<!-- dosen -->
															<?php
															if ($validasi1 == 0) {
															?>
																Menunggu verifikasi Dosen Matakuliah <?= namadosen($dbsurat, $validator1); ?><br />
															<?php
															} elseif ($validasi1 == 1) {
															?>
																Telah disetujui Dosen Matakuliah <?= namadosen($dbsurat, $validator1); ?> <br />
															<?php
															} else {
															?>
																Ditolak Dosen Matakuliah <?= namadosen($dbsurat, $validatovalidator1rkoor); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
															<?php
															};
															?>
															<!-- ketua jurusan -->
															<?php
															if ($validasi2 == 0) {
															?>
																Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?><br />
															<?php
															} elseif ($validasi2 == 1) {
															?>
																Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> <br />
															<?php
															} else {
															?>
																Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validator2); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
															<?php
															};
															?>
															<!-- WD-1 -->
															<?php
															if ($validasi3 == 0) {
															?>
																Menunggu verifikasi Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?><br />
															<?php
															} elseif ($validasi3 == 1) {
															?>
																Telah disetujui Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?> <br />
															<?php
															} else {
															?>
																Ditolak oleh Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validator3); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
														<?php
															}
														};
														?>
													</td>
													<td>
														<?php
														if ($statussurat == -1) {
														?>
															<a class="btn btn-info btn-sm" href="observasi-isianggota.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-file"></i>
																Lengkapi
															</a>
														<?php
														} elseif ($statussurat == 1) {
														?>
															<a class="btn btn-success btn-sm" href="observasi-cetak.php?nodata=<?php echo $nodata; ?>" target="_blank">
																<i class="fas fa-print"></i>
																Cetak
															</a>
														<?php
														} elseif ($statussurat == 0) {
														?>
															<a class="btn btn-secondary btn-sm" disabled>
																<i class="fas fa-spinner"></i> Proses
															</a>
															<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="observasi-hapus.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-trash"></i> Batalkan
															</a>
														<?php
														} elseif ($statussurat == 2) {
														?>
															<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="observasi-hapus.php?nodata=<?php echo $nodata; ?>">
																<i class="fas fa-trash"></i> Hapus
															</a>
														<?php
														}
														?>
													</td>
												</tr>
									<?php
											}
										}
									}
									?>
									<!-- /Ijin observasi -->

									<!-- SKPI -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim = '$nim'");
									while ($q = mysqli_fetch_array($query)) {
										$nodata = $q['no'];
										$verifikasi1 = $q['verifikasi1'];
										$verifikator1 = $q['verifikator1'];
										$tglverifikasi1 = $q['tglverifikasi1'];
										$verifikasi2 = $q['verifikasi2'];
										$verifikator2 = $q['verifikator2'];
										$tglverifikasi2 = $q['tglverifikasi2'];
										$verifikasi3 = $q['verifikasi3'];
										$verifikator3 = $q['verifikator3'];
										$tglverifikasi3 = $q['tglverifikasi3'];
										$keterangan = $q['keterangan'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Surat Keterangan Pendamping Ijazah"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($verifikasi1 == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $verifikator1); ?><br />
												<?php
												} elseif ($verifikasi1 == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $verifikator1); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $verifikator1); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($verifikasi2 == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $verifikator2); ?><br />
												<?php
												} elseif ($verifikasi2 == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $verifikator2); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $verifikator2); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($verifikasi3 == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $verifikator3); ?><br />
												<?php
												} elseif ($verifikasi3 == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $verifikator3); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $verifikator3); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<?php
												if ($verifikasi3 == 1) {
												?>
													<b><i>Pengajuan SKPI anda telah disetujui dan akan di proses di SIAKAD. Silahkan hubungi administrasi Program Studi untuk informasi lebih lanjut. </i></b>
												<?php
												}
												?>
											</td>
											<td>
												<?php
												if ($verifikasi3 == 1) {
												?>
													<a class="btn btn-success btn-sm" href="https://siakad.uin-malang.ac.id" target="_blank">
														<i class="fas fa-graduation-cap"></i>
														SIAKAD
													</a>
												<?php
												} elseif ($verifikasi1 == 2 or $verifikasi2 == 2 or $verifikasi3 == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="observasi-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												} else {
												?>
													<a class="btn btn-secondary btn-sm" onclick="return alert('harap menunggu proses')" disabled>
														<i class="fas fa-spinner"></i> Proses
													</a>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="observasi-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Batalkan
													</a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php
									}
									?>
									<!-- /SKPI -->

								</tbody>
							</table>
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

</html>