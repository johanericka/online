<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SAINTEK Online | Mahasiswa</title>
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
$lokasi = "coming soon ...";
?>

<!-- akses ke database -->
<?php require_once('../system/dbconn.php'); ?>


<!-- cek session -->
<?php
session_start();
if ($_SESSION['hakakses'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}
?>

<?php
$iduser = mysqli_real_escape_string($dbsurat, $_SESSION['iduser']);
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$status = mysqli_real_escape_string($dbsurat, $_SESSION['status']);
$jurusan = mysqli_real_escape_string($dbsurat, $_SESSION['jurusan']);
$jabatan = mysqli_real_escape_string($dbsurat, $_SESSION['role']);
$role = mysqli_real_escape_string($dbsurat, $_SESSION['role']);
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
				<img src="../system/uin-malang-logo.png" alt="UIN Malang" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">UIN Malang</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional)-->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="info">
						<a href="#" class="d-block"><?php echo $nama; ?></a>
						<a href="#" class="d-block">NIM : <?php echo $nim; ?></a>
						<a href="#" class="d-block">Jurusan : <?php echo $jurusan; ?></a>
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
								<i class="nav-icon fa fa-envelope"></i>
								<p>
									Pengajuan Surat
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<!-- ijin penggunaan lab -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim' AND keterangan IS NULL");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="lab-isi1.php" class="nav-link">
											<i class="nav-icon fas fa-flask"></i>
											<p>
												Ijin Penggunaan Lab.
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>
								<!-- surat keterangan -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM suket WHERE nim='$nim' AND keterangan IS NULL");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="suket-isi.php" class="nav-link">
											<i class="nav-icon fas fa-id-card"></i>
											<p>
												Surat Keterangan
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>
								<!-- surat pengantar PKL -->
								<?php
								$qpkl = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota='$iduser'");
								$dpkl = mysqli_fetch_array($qpkl);
								$nimketua = $dpkl['nimketua'];

								$qpkl2 = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE nim='$nimketua' AND validasifakultas=0");
								$jpkl2 = mysqli_num_rows($qpkl2);
								if ($jpkl2 == 0) {
								?>
									<li class="nav-item">
										<a href="pkl-isilampiran.php" class="nav-link">
											<i class="nav-icon fas fa-users"></i>
											<p>
												Surat Pengantar PKL
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>

								<!-- surat permohonan cetak KHS -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM cetakkhs WHERE nim='$nim' AND keterangan IS NULL");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="cetakkhs-isi.php" class="nav-link">
											<i class="nav-icon fa fa-file"></i>
											<p>
												Surat Keterangan Cetak KHS
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>

								<!-- surat ijin penelitian -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE nim='$nim' AND keterangan IS NULL");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="ijinpenelitian-isi.php" class="nav-link">
											<i class="nav-icon fa fa-search"></i>
											<p>
												Ijin Penelitian
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>

								<!-- surat ijin observasi -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM observasianggota WHERE nimanggota='$iduser'");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata > 0) {
									$dobservasi = mysqli_fetch_array($query);
									$nimketua = $dobservasi['nimketua'];

									$qobservasi = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE nim='$nimketua' AND validasifakultas=0");
									$jobservasi = mysqli_num_rows($qobservasi);
									if ($jobservasi == 0) {
								?>
										<li class="nav-item">
											<a href="observasi-isi.php" class="nav-link">
												<i class="nav-icon fa fa-edit"></i>
												<p>
													Ijin Observasi
													<span class="right badge badge-danger"></span>
												</p>
											</a>
										</li>
									<?php
									}
								} else {
									?>
									<li class="nav-item">
										<a href="observasi-isi.php" class="nav-link">
											<i class="nav-icon fa fa-edit"></i>
											<p>
												Ijin Observasi
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>

								<!-- permohonan peminjaman alat -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE nim='$nim' AND keterangan IS NULL");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="peminjamanalat-isi.php" class="nav-link">
											<i class="nav-icon fa fa-wrench"></i>
											<p>
												Peminjaman Alat
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>

								<!-- permohonan pengambilan data -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE nim='$nim' AND keterangan IS NULL");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="pengambilandata-isi.php" class="nav-link">
											<i class="nav-icon fa fa-table"></i>
											<p>
												Pengambilan Data
												<span class="right badge badge-danger"></span>
											</p>
										</a>
									</li>
								<?php
								}
								?>

								<!-- permohonan SKPI -->
								<?php
								$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim' AND verifikasi3=0 ");
								$cekdata = mysqli_num_rows($query);
								if ($cekdata == 0) {
								?>
									<li class="nav-item">
										<a href="skpi-isi.php" class="nav-link">
											<i class="nav-icon fas fa-graduation-cap"></i>
											<p>
												Pengajuan SKPI
											</p>
										</a>
									</li>
								<?php
								}
								?>

							</ul>
						</li>

						<li class="nav-item has-treeview menu-close">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-file-pdf"></i>
								<p>
									Dokumen
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<!--
								<li class="nav-item">
									<a href="https://saintek.uin-malang.ac.id/wfh/doc/SOPIjinLayananLaboratorium.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>SOP Ijin Layanan Lab.</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="https://saintek.uin-malang.ac.id/wfh/doc/PemberitahuanKegiatanPKL.pdf" target="_blank" class="nav-link">
										<i class="far fa-file-pdf"></i>
										<p>Pemberitahuan Kegiatan PKL</p>
									</a>
								</li>
								-->
							</ul>
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
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="5%" style="text-align:center">No</th>
										<th style="text-align:center">Surat</th>
										<th style="text-align:center">Status</th>
										<th width="15%" colspan="2" style="text-align:center">Aksi</th>
									</tr>
								</thead>
								<tbody>

									<!-- ijin lab -->
									<?php
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$iduser'");
									$jmldata = mysqli_num_rows($query);
									while ($data = mysqli_fetch_array($query)) {
										$nodata = $data['no'];
										$tanggal = $data['tanggal'];
										$nim = $data['nim'];
										$nama = $data['nama'];
										$surat = 'Ijin Penggunaan Laboratorium';
										$validatordosen = $data['validatordosen'];
										$validasidosen = $data['validasidosen'];
										$tglvalidasidosen = tgl_indo($data['tglvalidasidosen']);
										$validasijurusan = $data['validasijurusan'];
										$validatorjurusan = $data['validatorjurusan'];
										$tglvalidasijurusan = tgl_indo($data['tglvalidasijurusan']);
										$validasifakultas = $data['validasifakultas'];
										$validatorfakultas = $data['validatorfakultas'];
										$tglvalidasifakultas = tgl_indo($data['tglvalidasifakultas']);
										$keterangan = $data['keterangan'];

									?>
										<tr>
											<td><?php echo $no; ?></td>
											<td><?php echo $surat; ?></td>
											<td>
												<!-- dosen pembimbing -->
												<?php
												echo $validatordosen;
												if ($validasidosen == 0) {
												?>
													Menunggu verifikasi Dosen Pembimbing <?= namadosen($dbsurat, $validatordosen); ?><br />
												<?php
												} elseif ($validasidosen == 1) {
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
												if ($validasijurusan == 0) {
												?>
													Menunggu verifikasi Ketua Program Studi <?= namadosen($dbsurat, $validatorjurusan); ?><br />
												<?php
												} elseif ($validasijurusan == 1) {
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
												if ($validasifakultas == 0) {
												?>
													Menunggu verifikasi Wakil Dekan Bidang Akademik <?= namadosen($dbsurat, $validatorfakultas); ?><br />
												<?php
												} elseif ($validasifakultas == 1) {
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
											<td>
												<?php
												if ($validasifakultas == 1) {
												?>
													<a class="btn btn-success btn-sm" href="lab-cetak.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-print">
														</i>
														Cetak Surat Ijin
													</a>
													<?php
												} else {
													if ($validasidosen > 1 or $validasijurusan > 1 or $validasifakultas > 1) {
													?>
														<a class="btn btn-danger btn-sm" href="lab-tampil2.php?nodata=<?php echo $nodata; ?>">
															<i class="fas fa-times">
															</i>
															Cek
														</a>
													<?php
													} else {
													?>
														<a class="btn btn-info btn-sm" href="lab-tampil2.php?nodata=<?php echo $nodata; ?>">
															<i class="fas fa-search">
															</i>
															Lihat
														</a>
												<?php
													}
												}
												?>
											</td>
											<td>
												<?php
												if ($validasifakultas != 1) {
												?>
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="lab-hapus.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-trash"></i> Hapus
													</a>
												<?php
												}
												?>
												<?php
												if ($validasifakultas == 1) {
												?>
													<a class="btn btn-success btn-sm" href="lab-cetakidcard.php?nodata=<?php echo $nodata; ?>">
														<i class="fas fa-print">
														</i>
														Cetak ID Card
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
									$query = mysqli_query($dbsurat, "SELECT * FROM pklanggota WHERE nimanggota = '$iduser'");
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
															Ditolak Dosen Koordinator PKL <?= namadosen($dbsurat, $validatorkoor); ?> dengan alasan <?= $keterangan; ?><br />
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
									$data = mysqli_query($dbsurat, "select * from suket where nim = '" . $iduser . "'");
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
											<?php if (isset($_SESSION['iduser'])) : ?>
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
									$data = mysqli_query($dbsurat, "select * from cetakkhs where nim = '$iduser'");
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
									$query = mysqli_query($dbsurat, "SELECT * FROM ijinpenelitian WHERE nim = '$iduser'");
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
									$query = mysqli_query($dbsurat, "SELECT * FROM peminjamanalat WHERE nim = '$iduser'");
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
									$query = mysqli_query($dbsurat, "SELECT * FROM pengambilandata WHERE nim = '$iduser'");
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
									$qobservasi = mysqli_query($dbsurat, "SELECT * FROM observasianggota where nimanggota='$iduser'");
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
									$query = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim = '$iduser'");
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
													<a class="btn btn-success" href="skpi-tampil.php?iduser=<?php echo $iduser; ?>">
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
													<a class="btn btn-danger btn-sm" onclick="return confirm('Yakin menghapus pengajuan ini ?')" href="skpi-hapus.php?iduser=<?php echo $iduser; ?>">
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
	<!-- AdminLTE App -->
	<script src="../system/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../system/dist/js/demo.js"></script>
</body>

<!-- tanggal indonesia -->
<?php
function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	);
	if (isset($tanggal)) {
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
	}
}
?>

<!-- namadosen -->
<?php
function namadosen($conn, $iddosen)
{
	require_once('../system/dbconn.php');
	$qdosen = mysqli_query($conn, "SELECT nama FROM useraccount2 WHERE kode=$iddosen");
	$ddosen = mysqli_fetch_array($qdosen);
	$nama = $ddosen['nama'];
	return $nama;
}

?>

</html>