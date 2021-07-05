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
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
// ambil data dari record
$datasurat = mysqli_query($dbsurat, "select * from observasi where id='$nodata'");
$rowsurat = mysqli_fetch_array($datasurat);
$nosurat = $rowsurat['keterangan'];
$nim = $rowsurat['nim'];
$jurusan = $rowsurat['jurusan'];
$matakuliah = $rowsurat['matakuliah'];
$namadosen = $rowsurat['namadosen'];
$instansi = $rowsurat['instansi'];
$alamat = $rowsurat['alamat'];
$tglpelaksanaan = date('Y-m-d', strtotime($rowsurat['tglpelaksanaan']));
$tglvalidasifakultas = $rowsurat['tglvalidasifakultas'];
$validatorfakultas = $rowsurat['validatorfakultas'];
$validasifakultas = $rowsurat['validasifakultas'];
$tglsurat = date('Y-m-d', strtotime($tglvalidasifakultas));


//data wd
$datawd = mysqli_query($dbsurat, "select * from pejabat where iddosen='$validatorfakultas'");
$rowwd = mysqli_fetch_array($datawd);
$iddosen = $rowwd['iddosen'];
$nip = $rowwd['nip'];
$namawd = $rowwd['nama'];
$jabatan = $rowwd['jabatan'];

//buat qrcode
$tgl = date('Y-m-d');
$jam = date('H-i-s');
include "../system/phpqrcode/qrlib.php";
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
$codeContents = $actual_link;
$namafile = $nim . "_" . $tgl . "_" . $jam;
QRcode::png($codeContents, "../qrcode/$namafile.png", "L", 4, 4);
?>

<body>
	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
		<tbody>
			<td colspan="5" align="center"><img src="../system/kopsurat.jpg" width="100%" /></td>
		</tbody>
	</table>
	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
		<tbody>
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="2">&nbsp;</td>
				<td style="text-align:right">Malang, <?php echo tgl_indo($tglsurat); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Nomor </td>
				<td>: <?php echo $nosurat; ?></td>
				<td>&nbsp;</td>
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
				<td>: Izin Observasi</td>
				<td></td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>
	<font face="Times" size="12">
		<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
			<tbody>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Yth. <?php echo $instansi; ?></td>
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
					<td colspan="3">Sehubungan dengan tugas mata kuliah <?php echo $matakuliah; ?> mahasiswa jurusan <?php echo $jurusan; ?> Fakultas Sains dan Teknologi UIN Maulana Malik Ibrahim Malang dengan nama - nama sebagai berikut :</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td align="center">NIM</td>
					<td align="center">Nama</td>
					<td align="center">Dosen Pembimbing</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				// data peserta observasi
				$dataanggota = mysqli_query($dbsurat, "select * from observasianggota where nimketua='$nim'");
				while ($rowanggota = mysqli_fetch_row($dataanggota)) {
					$nimanggota = $rowanggota[2];
					$namaanggota = $rowanggota[3];
				?>
					<tr>
						<td>&nbsp;</td>
						<td align="center"><?php echo $nimanggota; ?></td>
						<td align="left"><?php echo $namaanggota; ?></td>
						<td align="center"><?php echo $namadosen; ?></td>
						<td>&nbsp;</td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Maka kami mohon Bapak/Ibu berkenan memberikan izin pada mahasiswa tersebut untuk melakukan observasi di <?php echo $instansi; ?> dengan waktu pelaksanaan pada tanggal <?php echo tgl_indo($tglpelaksanaan); ?> - Selesai.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Demikian permohonan ini, atas perhatiannya disampaikan terimakasih.</td>
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
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="text-align:center">Malang, <?php echo tgl_indo($tglsurat); ?></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:center"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td style="text-align:center">a.n Dekan</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:center">
						<small><i>Scan QRCode ini </i></small><br />
						<img src="../qrcode/<?php echo $namafile; ?>.png" width="80" /><br />
						<small><i>untuk verifikasi surat</i></small>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<?php
					if ($validasifakultas == 1) {
					?>
						<td style="text-align:center"><img src="../ttd/antonprasetyo.jpg" width="300" /></td>
					<?php
					}
					?>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="text-align:center"></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<!--<td style="text-align:center"><u><//?php echo $namawd; ?></u></td>-->
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<!--<td style="text-align:center">NIP. <//?php echo $nip; ?></td>-->
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
			</tbody>
	</font>
	</table>
</body>

<?php
function tgl_indo($tanggal)
{
	$bulan = array(
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

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>

</html>