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
	
	<?php
		$nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
		$datamhs = mysqli_query($dbsurat,"SELECT * FROM cetakkhs WHERE id='$nodata'");
		$row = mysqli_fetch_array($datamhs);
			$nosurat = $row['id'];
			$nama = $row[4];
			$nim = $row['nim'];
			$jurusan = $row['jurusan'];
			$semester = $row['semester'];
			$tahunakademik = $row['tahunakademik'];
			$keperluan = $row['keperluan'];
			$alasan = $row['alasan'];
			$validasifakultas = $row['validasifakultas'];
			$tglvalidasifakultas = $row['tglvalidasifakultas'];
			$validatorfakultas = $row['validatorfakultas'];
			if ($semester == 1){
				$smt = 'Ganjil';
			}else{
				$smt = 'Genap';
			};
			$tgl = date('Y-m-d', strtotime($tglvalidasifakultas));
			$keterangan = $row['keterangan'];

		//data wd
		$datawd = mysqli_query($dbsurat,"select * from pejabat where iddosen='$validatorfakultas'");
		$rowwd = mysqli_fetch_array($datawd);
			$idwd = $rowwd['iddosen'];
			$nipwd = $rowwd['nip'];
			$namawd = $rowwd['nama'];
			$jabatanwd = $rowwd['jabatanwd'];
		
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
		<tbody>
			<tr>
				<td></td>
				<td colspan="3" align="center"><b>SURAT KETERANGAN</b></td>
			</tr>
			<tr>
				<td></td>
				<td colspan="3" align="center"><b>Nomor : <?php echo $keterangan; ?></b></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td colspan="3">Yang bertanda tangan dibawah ini :</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Nama</td>
				<td>:</td>
				<td><?php echo $namawd; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>NIP</td>
				<td>:</td>
				<td><?php echo $nipwd; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Jabatan</td>
				<td>:</td>
				<td><?php echo $jabatanwd; ?> Fakultas Sains dan Teknologi</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>Universitas Islam Negeri Maulana Malik Ibrahim Malang</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Dengan ini menerangkan bahwa :</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Nama</td>
				<td>:</td>
				<td><?php echo $nama; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>NIM</td>
				<td>:</td>
				<td><?php echo $nim; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Semester</td>
				<td>:</td>
				<td><?php echo $semester; ?></td>
			</tr>
			<tr>	
				<td>&nbsp;</td>
				<td>Jurusan</td>
				<td>:</td>
				<td><?php echo $jurusan; ?></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">bahwa mahasiswa tersebut mengajukan permohonan untuk cetak ulang KHS semester <?php echo $smt; ?> Tahun Ajaran <?php echo $tahunakademik; ?> dikarenakan <?php echo $alasan; ?>.</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Sehubungan dengan hal ini, kami mohon dikeluarkan/dicetak kembali KHS tersebut sebagai persyaratan <?php echo $keperluan; ?>.</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagai mestinya.</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
			</tr>
			
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
							<td style="text-align:center">a.n Dekan</td>
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