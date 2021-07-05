<html>
	<head>
    <link rel="stylesheet" href="../system/surat.css">
	</head>
	
	<script>
		window.print();
	</script>
	
	<!-- connect to db -->
	<?php require_once('../system/dbconn.php'); ?>
	<!-- ./db -->
	
	<!-- session -->
	<?php 
	//session_start();
	//if($_SESSION['status']!="login"){
	//	header("location:../login.php?pesan=belum_login");
	//}
	?>
	<!-- /session -->
	
	<?php
		$nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
		// ambil data dari record
		$datasurat = mysqli_query($dbsurat,"select * from pengambilandata where id='$nodata'");
		$rowsurat = mysqli_fetch_row($datasurat);
			$nim = $rowsurat[3];
			$nosurat = $rowsurat[20];
			$kdjurusan = $rowsurat[2];
			$nama = $rowsurat[4];
			$judulskripsi = $rowsurat[5];
			$dosbing = $rowsurat[6];
			$instansi = $rowsurat[7];
			$alamat = $rowsurat[8];
			$tglpelaksanaan = date('Y-m-d', strtotime($rowsurat[9]));
			$data = $rowsurat[10];
			$validatorfakultas = $rowsurat[18];
			$tglsurat = date('Y-m-d', strtotime($rowsurat[19]));
			$keterangan = $rowsurat[20];
			$tglvalidasifakultas = $rowsurat[19];
			$validasifakultas = $rowsurat[17];
			$tgl = date('Y-m-d', strtotime($tglvalidasifakultas));
		
		//data jurusan
		$datajurusan = mysqli_query($dbsiakad, "select jur_nama from jurusan where jur_kode_baru = '$kdjurusan'");
		$rowjurusan = mysqli_fetch_row($datajurusan);
			$jurusan = $rowjurusan[0];
		
		//data wd
		$datawd = mysqli_query($dbsurat,"select * from pejabat where iddosen='$validatorfakultas'");
		$rowwd = mysqli_fetch_array($datawd);
			$iddosen = $rowwd['iddosen'];
			$nipwd = $rowwd['nip'];
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

	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
		<thead>
			<tr>
				<td></td>
				<td width="20%"></td>
				<td colspan="2"></td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<tr>
					<td>&nbsp;</td>
					<td>Nomor </td>
					<td colspan="2">: <?php echo $keterangan; ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Lampiran </td>
					<td colspan="2">: -</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Hal </td>
					<td colspan="2">: Permohonan Data </td>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Yth. Pimpinan <?php echo $instansi; ?></td>
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
					<td colspan="3">Maka kami mohon Bapak/Ibu berkenan memberikan izin pada mahasiswa tersebut untuk melakukan penelitian dan mendapatkan data <?php echo $data; ?> di <?php echo $instansi; ?> dengan waktu pelaksanaan pada tanggal <?php echo tgl_indo($tglpelaksanaan); ?>.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Demikian permohonan ini, atas perhatian dan kerjasamanya disampaikan terimakasih.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
		</table>
			
			<!-- table bawah -->
			<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
				<tbody>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="text-align:center">Malang, <?php echo tgl_indo($tgl); ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style="text-align:center">a.n Dekan</td>
							<td>&nbsp;</td>
						</tr>
											<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td style="text-align:center"><?php echo $jabatan; ?></td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<?php 
								if ($validasifakultas == 1) {
							?>
							<td style="text-align:center"><img src="../ttd/ttd<?php echo $validatorfakultas; ?>.png" width="80"/></td>
							<?php
								}
							?>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="text-align:center"><u><?php echo $namawd; ?></u></td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="text-align:center"><small><i>Scan QRCode ini </i></td>
						<td>&nbsp;</td>
						<td style="text-align:center">NIP. <?php echo $nipwd; ?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="text-align:center"><img src="../qrcode/<?php echo $namafile; ?>.png" width="80"/></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td style="text-align:center"><small><i>untuk verifikasi surat</i></small></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
				</tbody>
			</table>
	
			
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