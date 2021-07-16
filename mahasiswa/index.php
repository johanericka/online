<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}
require('../system/dbconn.php');
require('../system/myfunc.php');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$jurusan = mysqli_real_escape_string($dbsurat, $_SESSION['jurusan']);
$hakakses = mysqli_real_escape_string($dbsurat, $_SESSION['hakakses']);
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
						<div class="col-sm-6">
							<h3></h3>
						</div>
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
										$statuspengajuan = $data['statuspengajuan'];

									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<!-- data belum lengkap -->
												<?php
												if ($statuspengajuan == -1) {
												?>
													<p style="color:red">Data belum lengkap</p>
												<?php
												} else {
												?>
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
														Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validator1); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
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
												if ($statuspengajuan == -1) {
												?>
													<a class="btn btn-info btn-sm" href="ijinlab-isi2.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-file"></i>
														Lengkapi
													</a>
												<?php
												} elseif ($statuspengajuan == 1) {
												?>
													<a class="btn btn-success btn-sm" href="lab-cetak.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-print"></i>
														Cetak
													</a>
												<?php
												} elseif ($statuspengajuan == 0) {
												?>
													<a class="btn btn-secondary btn-sm" disabled>
														<i class="fas fa-spinner"></i>
														Dalam proses
													</a>
												<?php
												} elseif ($statuspengajuan == 2) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="lab-hapus.php?nodata=<?php echo $nodata; ?>">
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
									$query = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota = '$nim'");
									$dquery = mysqli_num_rows($query);
									if ($dquery > 0) {
										while ($data = mysqli_fetch_array($query)) {
											$nimketua = $data['nimketua'];

											$query2 = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE nim = '$nimketua'");
											while ($q = mysqli_fetch_array($query2)) {
												$nodata = $q['id'];
												$nim = $q['nim'];
												$nama =  $q['nama'];
												$valkoor = $q['validasikoordinator'];
												$validatorkoor = $q['validatorkoor'];
												$tglvalkoor = $q['tglvalidasikoordinator'];
												$valjur = $q['validasijurusan'];
												$validatorjurusan = $q['validatorjurusan'];
												$tglvaljur = $q['tglvalidasijurusan'];
												$valfak = $q['validasifakultas'];
												$validatorfakultas = $q['validatorfakultas'];
												$tglvalfak = $q['tglvalidasifakultas'];
												$keterangan = $q['keterangan'];
									?>

												<tr>
													<td><?php echo $no++; ?></td>
													<td>Surat Pengantar PKL <br />
														Ketua <?= $nama; ?>
													</td>
													<td>
														<!-- koordinator PKL -->
														<?php
														if ($valkoor == 0) {
														?>
															Menunggu verifikasi Dosen Koordinator PKL <?= namadosen($dbsurat, $validatorkoor); ?><br />
														<?php
														} elseif ($valkoor == 1) {
														?>
															Telah disetujui Dosen Koordinator PKL <?= namadosen($dbsurat, $validatorkoor); ?> <br />
														<?php
														} else {
														?>
															Ditolak Dosen Koordinator PKL <?= namadosen($dbsurat, $validatorkoor); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
														<?php
														};
														?>
														<!-- ketua jurusan -->
														<?php
														if ($valjur == 0) {
														?>
															Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
														<?php
														} elseif ($valjur == 1) {
														?>
															Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
														<?php
														} else {
														?>
															Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
														<?php
														};
														?>
														<!-- WD-1 -->
														<?php
														if ($valfak == 0) {
														?>
															Menunggu verifikasi Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validatorfakultas); ?><br />
														<?php
														} elseif ($valfak == 1) {
														?>
															Telah disetujui Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
														<?php
														} else {
														?>
															Ditolak oleh Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
														<?php
														};
														?>
													</td>
													<td colspan="2">
														<?php
														if ($valkoor == 1 and $valjur == 1 and $valfak == 1) {
															echo '<a class="btn btn-success btn-sm" href="pkl-cetak.php?nodata=' . $nodata . '" target="_blank"> <i class="fas fa-print"></i> Cetak</a>';
														}
														?>
														<?php
														if ($valkoor == 2 or $valjur == 2 or $valfak == 2) {
														?>
															<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="pkl-hapus.php?nodata=<?= $nodata; ?>&nim=<?= $nim; ?>">
																<i class="fas fa-trash-alt"></i>
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
									<!-- /Ijin PKL -->

									<!-- Surat Keterangan -->
									<?php
									$data = mysqli_query($dbsurat, "select * from suket where nim = '" . $nim . "'");
									$cek = mysqli_num_rows($data);
									while ($q = mysqli_fetch_array($data)) {
										$nodata = $q['id'];
										$nim = $q['nim'];
										$valdos = $q['validasidosen'];
										$validatordosen = $q['validatordosen'];
										$tglvaldos = $q['tglvalidasidosen'];
										$valjur = $q['validasijurusan'];
										$validatorjurusan = $q['validatorjurusan'];
										$tglvaljur = $q['tglvalidasijurusan'];
										$valfak = $q['validasifakultas'];
										$validatorfakultas = $q['validatorfakultas'];
										$tglvalfak = $q['tglvalidasifakultas'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $q['jenissurat']; ?></td>
											<?php if (isset($_SESSION['nim'])) : ?>
												<td>
													<!-- dosen pembimbing -->
													<?php
													if ($valdos == 0) {
													?>
														Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?><br />
													<?php
													} elseif ($valdos == 1) {
													?>
														Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> <br />
													<?php
													} else {
													?>
														Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> dengan alasan <b style="color:red"><?= $keterangan; ?></b><br />
													<?php
													};
													?>
													<!-- ketua jurusan -->
													<?php
													if ($valjur == 0) {
													?>
														Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
													<?php
													} elseif ($valjur == 1) {
													?>
														Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <?= $keterangan; ?><br />
													<?php
													};
													?>
													<!-- WD-1 -->
													<?php
													if ($valfak == 0) {
													?>
														Menunggu verifikasi Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validatorfakultas); ?><br />
													<?php
													} elseif ($valfak == 1) {
													?>
														Telah disetujui Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Wakil Dekan Bidang Kemahasiswaan <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <?= $keterangan; ?><br />
													<?php
													};
													?>
												</td>
												<td colspan="2">
													<?php
													if ($valfak == 1) {
														echo '<a class="btn btn-success btn-sm" href="suket-cetak.php?nodata=' . $nodata . '" target="_blank"> <i class="fas fa-print"></i> Cetak</a>';
													} elseif ($valdos > 1 or $valjur > 1 or $valfak > 1) {
														echo '<a class="btn btn-danger btn-sm" href="suket-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-times"></i> Cek</a>';
													} else {
														echo '<a class="btn btn-info btn-sm" href="suket-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-search"></i> Lihat</a>';
													}
													?>
													<?php
													if ($valdos > 1 or $valjur > 1 or $valfak > 1) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="suket-hapus.php?nodata=<?php echo $nodata; ?>">
															<i class="fas fa-trash"></i>
														</a>
													<?php
													}
													?>
												</td>
											<?php endif; ?>
										</tr>
									<?php
									}
									?>
									<!-- /surat keterangan -->

									<!-- Permohonan Cetak KHS -->
									<?php
									$data = mysqli_query($dbsurat, "select * from cetakkhs where nim = '$nim'");
									$cek = mysqli_num_rows($data);
									while ($q = mysqli_fetch_array($data)) {
										$nodata = $q['id'];
										$nim = $q['nim'];
										$valjur = $q['validasijurusan'];
										$validatorjurusan = $q['validasijurusan'];
										$tglvaljur = $q['tglvalidasijurusan'];
										$valfak = $q['validasifakultas'];
										$validatorfakultas = $q['validatorfakultas'];
										$tglvalfak = $q['tglvalidasifakultas'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Permohonan Cetak KHS"; ?></td>
											<td>
												<!-- ketua jurusan -->
												<?php
												if ($valjur == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
												<?php
												} elseif ($valjur == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($valfak == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?><br />
												<?php
												} elseif ($valfak == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td colspan="2">
												<?php
												if ($valjur == 1 and $valfak == 1) {
													echo '<a class="btn btn-success btn-sm" href="cetakkhs-cetak.php?nodata=' . $nodata . '"> <i class="fas fa-print"></i> Cetak</a>';
												} elseif ($valjur > 1 or $valfak > 1) {
													echo '<a class="btn btn-danger btn-sm" href="cetakkhs-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-times"></i> Cek</a>';
												} else {
													echo '<a class="btn btn-info btn-sm" href="cetakkhs-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-search"></i> Lihat</a>';
												}
												?>
												<?php
												if ($valfak != 1) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="cetakkhs-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i>
														Hapus
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
										$nodata = $q['id'];
										$nim = $q['nim'];
										$valdos = $q['validasidosen'];
										$validatordosen = $q['validatordosen'];
										$tglvaldos = $q['tglvalidasidosen'];
										$valjur = $q['validasijurusan'];
										$validatorjurusan = $q['validatorjurusan'];
										$tglvaljur = $q['tglvalidasijurusan'];
										$valfak = $q['validasifakultas'];
										$validatorfakultas = $q['validatorfakultas'];
										$tglvalfak = $q['tglvalidasifakultas'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Permohonan Ijin Penelitian"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($valdos == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?><br />
												<?php
												} elseif ($valdos == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($valjur == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
												<?php
												} elseif ($valjur == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($valfak == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?><br />
												<?php
												} elseif ($valfak == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td colspan="2">
												<?php
												if ($valfak == 1) {
													echo '<a class="btn btn-success btn-sm" href="ijinpenelitian-cetak.php?nodata=' . $nodata . '"> <i class="fas fa-print"></i> Cetak</a>';
												} elseif ($valjur > 1 or $valfak > 1) {
													echo '<a class="btn btn-danger btn-sm" href="ijinpenelitian-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-times"></i> Cek</a>';
												} else {
													echo '<a class="btn btn-info btn-sm" href="ijinpenelitian-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-search"></i> Lihat</a>';
												}
												?>
												<?php
												if ($valfak != 1) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="ijinpenelitian-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i>
														Hapus
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
										$nodata = $q['id'];
										$nim = $q['nim'];
										$valdos = $q['validasidosen'];
										$validatordosen = $q['validatordosen'];
										$tglvaldos = $q['tglvalidasidosen'];
										$valjur = $q['validasijurusan'];
										$validatorjurusan = $q['validatorjurusan'];
										$tglvaljur = $q['tglvalidasijurusan'];
										$valfak = $q['validasifakultas'];
										$validatorfakultas = $q['validatorfakultas'];
										$tglvalfak = $q['tglvalidasifakultas'];
										$keterangan = $q['keterangan'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Permohonan Peminjaman Alat"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($valdos == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?><br />
												<?php
												} elseif ($valdos == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($valjur == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
												<?php
												} elseif ($valjur == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($valfak == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?><br />
												<?php
												} elseif ($valfak == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td colspan="2">
												<?php
												if ($valjur == 1 and $valfak == 1) {
													echo '<a class="btn btn-success btn-sm" href="peminjamanalat-cetak.php?nodata=' . $nodata . '"> <i class="fas fa-print"></i> Cetak</a>';
												} elseif ($valjur > 1 or $valfak > 1) {
													echo '<a class="btn btn-danger btn-sm" href="peminjamanalat-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-times"></i> Cek</a>';
												} else {
													echo '<a class="btn btn-info btn-sm" href="peminjamanalat-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-search"></i> Lihat</a>';
												}
												?>
												<?php
												if ($valfak != 1) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="peminjamanalat-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i>
														Hapus
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
										$nodata = $q['id'];
										$nim = $q['nim'];
										$valdos = $q['validasidosen'];
										$validatordosen = $q['validatordosen'];
										$tglvaldos = $q['tglvalidasidosen'];
										$valjur = $q['validasijurusan'];
										$validatorjurusan = $q['validatorjurusan'];
										$tglvaljur = $q['tglvalidasijurusan'];
										$valfak = $q['validasifakultas'];
										$validatorfakultas = $q['validatorfakultas'];
										$tglvalfak = $q['tglvalidasifakultas'];
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo "Ijin Pengambilan Data"; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												if ($valdos == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?><br />
												<?php
												} elseif ($valdos == 1) {
												?>
													Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> <br />
												<?php
												} else {
												?>
													Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- ketua jurusan -->
												<?php
												if ($valjur == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
												<?php
												} elseif ($valjur == 1) {
												?>
													Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
												<!-- WD-1 -->
												<?php
												if ($valfak == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?><br />
												<?php
												} elseif ($valfak == 1) {
												?>
													Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
												<?php
												} else {
												?>
													Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <?= $keterangan; ?><br />
												<?php
												};
												?>
											</td>
											<td colspan="2">
												<?php
												if ($valjur == 1 and $valfak == 1) {
													echo '<a class="btn btn-success btn-sm" href="pengambilandata-cetak.php?nodata=' . $nodata . '"> <i class="fas fa-print"></i> Cetak</a>';
												} elseif ($valjur > 1 or $valfak > 1) {
													echo '<a class="btn btn-danger btn-sm" href="pengambilandata-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-times"></i> Cek</a>';
												} else {
													echo '<a class="btn btn-info btn-sm" href="pengambilandata-tampil.php?nodata=' . $nodata . '"> <i class="fas fa-search"></i> Lihat</a>';
												}
												?>
												<?php
												if ($valfak != 1) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="pengambilandata-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i>
														Hapus
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

									<!-- ijin observasi -->
									<?php
									$qobservasi = mysqli_query($dbsurat, "SELECT * FROM observasianggota where nimanggota='$nim'");
									$jobservasi = mysqli_num_rows($qobservasi);
									if ($jobservasi > 0) {
										$dobservasi = mysqli_fetch_array($qobservasi);
										$nimketua = $dobservasi['nimketua'];

										$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE nim = '$nimketua'");
										while ($q = mysqli_fetch_array($query)) {
											$nodata = $q['id'];
											$nim = $q['nim'];
											$nama = $q['nama'];
											$valdos = $q['validasidosen'];
											$validatordosen = $q['validatordosen'];
											$tglvaldos = $q['tglvalidasidosen'];
											$valjur = $q['validasijurusan'];
											$validatorjurusan = $q['validatorjurusan'];
											$tglvaljur = $q['tglvalidasijurusan'];
											$valfak = $q['validasifakultas'];
											$validatorfakultas = $q['validatorfakultas'];
											$tglvalfak = $q['tglvalidasifakultas'];
											$keterangan = $q['keterangan'];
									?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo "Ijin Observasi"; ?>
													<br />
													Ketua Kelompok <?= $nama; ?>
												</td>
												<td>
													<!-- dosen pembimbing -->
													<?php
													if ($valdos == 0) {
													?>
														Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?><br />
													<?php
													} elseif ($valdos == 1) {
													?>
														Telah disetujui Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> <br />
													<?php
													} else {
													?>
														Ditolak Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?> dengan alasan <?= $keterangan; ?><br />
													<?php
													};
													?>
													<!-- ketua jurusan -->
													<?php
													if ($valjur == 0) {
													?>
														Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
													<?php
													} elseif ($valjur == 1) {
													?>
														Telah disetujui Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?> dengan alasan <?= $keterangan; ?><br />
													<?php
													};
													?>
													<!-- WD-1 -->
													<?php
													if ($valfak == 0) {
													?>
														Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?><br />
													<?php
													} elseif ($valfak == 1) {
													?>
														Telah disetujui Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> <br />
													<?php
													} else {
													?>
														Ditolak oleh Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?> dengan alasan <?= $keterangan; ?><br />
													<?php
													};
													?>
												</td>
												<td colspan="2">
													<?php
													if ($valdos == 1 and $valjur == 1 and $valfak == 1) {
														echo '<a class="btn btn-success btn-sm" href="observasi-cetak.php?nodata=' . $nodata . '"> <i class="fas fa-print"></i> Cetak</a>';
													}
													?>
													<?php
													if ($valfak == 2) {
													?>
														<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="observasi-hapus.php?nodata=<?= $nodata; ?>&nim=<?= $nim; ?>">
															<i class="fas fa-trash"></i>
														</a>
													<?php
													}
													?>
												</td>
											</tr>
									<?php
										}
									}
									?>
									<!-- /ijin observasi -->

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
													<b><i>Pengajuan SKPI anda telah disetujui. Silahkan hubungi administrasi Program Studi untuk informasi lebih lanjut. </i></b>
												<?php
												}
												?>
											</td>
											<td>
												<?php
												if ($verifikasi3 == 1) {
												?>
													<a class="btn btn-success" href="skpi-tampil.php?nim=<?php echo $nim; ?>">
														<i class="fas fa-eye"></i>
													</a>
												<?php
												}
												?>
											</td>
											<td>
												<?php
												if ($verifikasi3 <> 1) {
												?>
													<!-- hapus -->
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="skpi-hapus.php?nim=<?php echo $nim; ?>">
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