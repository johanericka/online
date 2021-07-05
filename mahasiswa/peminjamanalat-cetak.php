<html>
	<head>
    <link rel="stylesheet" href="../system/surat.css">
	</head>
		
	<script>
		window.print();
	</script>
	
	<!-- connect to db -->
	<?php require_once('../system/dbconn.php'); ?>
	
	<?php
		$nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
		$nim = mysqli_real_escape_string($dbsurat,$_GET['nim']);
		// ambil data dari record
		$datasurat = mysqli_query($dbsurat,"select * from peminjamanalat where id='$nodata'");
		$rowsurat = mysqli_fetch_array($datasurat);
			$nosurat = $rowsurat['id'];
			$nim = $rowsurat['nim'];
			$kdjurusan = $rowsurat['jurusan'];
			$nama = $rowsurat['nama'];
			$judulskripsi = $rowsurat['judulskripsi'];
			$dosbing = $rowsurat['dosbing'];
			$pimpinaninstansi = $rowsurat['pimpinaninstansi'];
			$instansi = $rowsurat['instansi'];
			$alamat = $rowsurat['alamat'];
			$namaalat = $rowsurat['namaalat'];
			$jumlahalat = $rowsurat['jumlahalat'];
			$tanggalpeminjamanmulai = date('Y-m-d', strtotime($rowsurat['tglpeminjamanmulai']));
			$tanggalpeminjamanakhir = date('Y-m-d', strtotime($rowsurat['tglpeminjamanakhir']));
			$tglsurat = date('Y-m-d', strtotime($rowsurat['tglvalidasifakultas']));
			$validatorfakultas = $rowsurat['validatorfakultas'];
			$validasifakultas = $rowsurat['validasifakultas'];
			$keterangan = $rowsurat['keterangan'];
		
		//data jurusan
		$datajurusan = mysqli_query($dbsiakad, "select jur_nama from jurusan where jur_kode_baru = '$kdjurusan'");
		$rowjurusan = mysqli_fetch_row($datajurusan);
			$jurusan = $rowjurusan[0];
		
		//data wd
		$datawd = mysqli_query($dbsurat,"select * from pejabat where iddosen='$validatorfakultas'");
		$rowwd = mysqli_fetch_array($datawd);
			$iddosen = $rowwd['iddosen'];
			$nip = $rowwd['nip'];
			$namawd = $rowwd['nama'];
			$jabatan = $rowwd['jabatan'];
		
		//buat qrcode
		include "../system/phpqrcode/qrlib.php"; 
		$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		//echo $actual_link;
		$codeContents = $actual_link;
		$namafile = $nim."_".$tgl."_".$jam;
		QRcode::png($codeContents,"../qrcode/$namafile.png",L,4,4);
		
	?>

	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
		<tbody>
			<td colspan="5" align="center"><img src="../system/kopsurat.jpg" width="100%" /></td>
		</tbody>
	</table>
	
	<body>
		<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td colspan="2">&nbsp;</td>
					<td style="text-align:right">Malang, <?php echo tgl_indo($tglsurat); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nomor </td>
					<td colspan="2">: <?php echo $keterangan; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Lampiran </td>
					<td>: -</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Hal </td>
					<td colspan="2">: Izin Sewa / Peminjaman Alat </td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Yth. <?php echo $pimpinaninstansi; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3"><?php echo $instansi; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3"><?php echo $alamat; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Dengan hormat,</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Sehubungan dengan penelitian mahasiswa Jurusan <?php echo $jurusan; ?> Fakultas Sains dan Teknologi UIN Maulana Malik Ibrahim Malang atas nama:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
				<td>&nbsp;</td>
				<td>Nama</td>
				<td colspan="2">: <?php echo $nama; ?></td>
				<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>NIM</td>
					<td colspan="2">: <?php echo $nim; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Judul</td>
					<td colspan="2">: <?php echo $judulskripsi; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Dosen Pembimbing</td>
					<td colspan="2">: <?php echo $dosbing; ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Maka kami mohon Bapak/Ibu berkenan memberikan izin pada mahasiswa tersebut untuk dapatnya meminjam / menyewa alat <?php echo $namaalat; ?> <?php echo $jumlahalat; ?> di <?php echo $instansi; ?>. </td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Tanggal Peminjaman : <?php echo tgl_indo($tanggalpeminjamanmulai); ?> – <?php echo tgl_indo($tanggalpeminjamanakhir); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Demikian permohonan ini, atas kerjasamanya disampaikan terimakasih.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="center" colspan="2"><small><i>Scan QRcode ini</i></small></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="center" colspan="2"><img src="../qrcode/<?php echo $namafile; ?>.png" width="80"/></td>
					<?php
					  if ($validasifakultas ==1) {
					?>
					<td align="right"><img src="../ttd/antonprasetyo.jpg" width="300"/></td>
					<?php
						}
					?>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="center" colspan="2"><small><i>Untuk verifikasi surat</i></small></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
	</body>
	
	<?php
		function tgl_indo($tanggal){
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			
			// variabel pecahkan 0 = tahun
			// variabel pecahkan 1 = bulan
			// variabel pecahkan 2 = tanggal

			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}
		
	?>
</html>