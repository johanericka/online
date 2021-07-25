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
session_start();
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$iduser = $_SESSION['iduser'];
$nim = $_SESSION['nim'];
$nama = $_SESSION['nama'];
$status = $_SESSION['status'];
$jurusan = $_SESSION['jurusan'];
$jabatan = $_SESSION['role'];
?>

<?php
$datasurat = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE id='$nodata'");
$rowsurat = mysqli_fetch_array($datasurat);
$nosurat = $rowsurat['keterangan'];
$nim = $rowsurat['nim'];
$kdjurusan = $rowsurat['kdjurusan'];
$instansi = $rowsurat['instansi'];
$tempatpkl = $rowsurat['tempatpkl'];
$alamat = $rowsurat['alamat'];
$tglmulai = date('Y-m-d', strtotime($rowsurat['tglmulai']));
$tglselesai = date('Y-m-d', strtotime($rowsurat['tglselesai']));
$idkoordinator = $rowsurat['validatorkoor'];
$tglvalidasifakultas = $rowsurat['tglvalidasifakultas'];
$validatorfakultas = $rowsurat['validatorfakultas'];
$validasifakultas = $rowsurat['validasifakultas'];
$tglsurat = date('Y-m-d', strtotime($tglvalidasifakultas));

//data jurusan
$datajurusan = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
$rowjurusan = mysqli_fetch_array($datajurusan);
$jurusan = $rowjurusan['jurusan'];

//data koordinator PKL jurusan
$datakoor = mysqli_query($dbsurat, "select nama from pejabat where iddosen='$idkoordinator'");
$rowkoor = mysqli_fetch_row($datakoor);
$koordinator = $rowkoor[0];

//data wd
$datawd = mysqli_query($dbsurat, "select * from pejabat where iddosen='$validatorfakultas'");
$rowwd = mysqli_fetch_array($datawd);
$idwd = $rowwd['iddosen'];
$nipwd = $rowwd['nip'];
$namawd = $rowwd['nama'];
$jabatan = $rowwd['jabatan'];

//buat qrcode
$tgl = date('Y-m-d');
$jam = date('H-m-i');
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
				<td>Nomor </td>
				<td>: <?php echo $nosurat; ?></td>
				<td style="text-align:right">Malang, <?php echo tgl_indo($tglsurat); ?></td>
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
				<td>: Izin PKL / Magang</td>
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
				<td colspan="3">Dengan hormat,</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Sehubungan dengan persiapan pelaksanaan Praktek Kerja Lapangan (PKL) / Magang Mahasiswa Program Studi <?php echo $jurusan; ?> Fakultas Sains dan Teknologi UIN Maulana Malik Ibrahim Malang, maka dengan ini kami mengajukan permohonan untuk menerima penempatan mahasiswa kami di <?php echo $instansi; ?> pada <?php echo $tempatpkl ?> dengan waktu pelaksanaan mulai tanggal <?php echo tgl_indo($tglmulai); ?> sampai dengan tanggal <?php echo tgl_indo($tglselesai); ?>. </td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Nama - nama mahasiswa tersebut adalah :</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
	</table>

	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="1">
		<tbody>
			<tr>
				<td width="20%" align="center">NIM</td>
				<td width="50%" align="center">Nama</td>
				<td width="30%" align="center">No. Telp</td>
			</tr>
			<?php
			// data peserta observasi
			$dataanggota = mysqli_query($dbsurat, "select * from pklanggota where nimketua='$nim'");
			$jmlanggota = mysqli_num_rows($dataanggota);
			while ($rowanggota = mysqli_fetch_array($dataanggota)) {
				$nimanggota = $rowanggota['nimanggota'];
				$namaanggota = $rowanggota['nama'];
				$telepon = $rowanggota['telepon'];
			?>
				<tr>
					<td width="20%" align="center"><?php echo $nimanggota; ?></td>
					<td width="50%" align="left"><?php echo $namaanggota; ?></td>
					<td width="30%" align="center"><?php echo $telepon; ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
		<tbody>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Koordinator PKL / Magang Program Studi <?php echo $jurusan ?> <?php echo $koordinator; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="3">Demikian permohonan kami, atas kesediaannya disampaikan terima kasih.</td>
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
				<td style="text-align:center">Malang, <?php echo tgl_indo($tglsurat); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="text-align:center"></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="text-align:center">a.n. Dekan</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="text-align:center"><small><i>Scan QRCode ini </i><br />
						<img src="../qrcode/<?php echo $namafile; ?>.png" width="80" /><br />
						<small><i>untuk verifikasi surat</i></small>
				</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<?php
				if ($validasifakultas == 1) {
				?>
					<td style="text-align:center"><img src="../ttd/imamtazi.jpg" width="400" /></td>
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
				<td>&nbsp;</td>
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
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
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