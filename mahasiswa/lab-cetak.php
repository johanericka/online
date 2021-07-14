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

<!-- ambil data ijin lab dari tabel ijinlab -->
<?php
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE no = '$nodata'");
$cek = mysqli_num_rows($query);
if ($cek > 0) {
	$data = mysqli_fetch_array($query);
	$nim = $data['nim'];
	$nama = $data['nama'];
	$ttl = $data['ttl'];
	$alamatasal = $data['alamatasal'];
	$alamatmalang = $data['alamatmalang'];
	$nohp = $data['nohp'];
	$nohportu = $data['nohportu'];
	$riwayatpenyakit = $data['riwayatpenyakit'];
	$posisi = $data['posisi'];
	$prodi = $data['prodi'];
	$namalab = $data['namalab'];
	$dosen = $data['dosen'];
	$tglmulai = $data['tglmulai'];
	$tglselesai = $data['tglselesai'];
	$validatorfakultas = $data['validatorfakultas'];
	$keterangan = $data['keterangan'];
	$tglvalidasifakultas = $data['tglvalidasifakultas'];
	$validasifakultas = $data['validasifakultas'];
}


//get data wd dekan
$datadekan = mysqli_query($dbsurat, "select * from pejabat where iddosen='$validatorfakultas'");
$rowdekan = mysqli_fetch_array($datadekan);
$iddekan = $rowdekan['iddosen'];
$nipdekan = $rowdekan['nip'];
$namadekan = $rowdekan['nama'];
$jabatandekan = $rowdekan['jabatan'];

//buat qrcode
include "../system/phpqrcode/qrlib.php";
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
$tgl = date('Y-m-d');
$jam = date('H-m-s');
$codeContents = $actual_link;
$namafile = $nim . "-" . "ijinlab" . $nodata;
QRcode::png($codeContents, "../qrcode/$namafile.png", 'L', 4, 4);
?>

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
			<td colspan="4" align="center">
				<h1>SURAT IJIN PENGGUNAAN LABORATORIUM</h1>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="4" align="center">
				<h2>Nomor : <?php echo $keterangan; ?></h2>
			</td>
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
<font face="Times" size="12">
	<!-- table data pegawai -->
	<table table style="width:80%; margin-left:auto;margin-right:auto;" cellspacing="0" border="0">
		<tbody>
			<tr>
				<th width="10%"></th>
				<th width="20%"></th>
				<th width="20%"></th>
				<th width="20%"></th>
				<th width="20%"></th>
				<th width="10%"></th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td colspan="4">Yang bertanda tangan di bawah ini :</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Nama</td>
				<td colspan="3">: <?php echo $namadekan; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>NIP</td>
				<td colspan="3">: <?php echo $nipdekan; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Jabatan</td>
				<td colspan="3">: <?php echo $jabatandekan . " Fakultas Sains dan Teknologi"; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td colspan="3"> Universitas Islam Negeri Maulana Malik Ibrahim Malang</td>
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
				<td colspan="4">Dengan ini Memberikan Ijin Penggunaan Layanan Laboratorium di lingkungan Fakultas Sains dan Teknologi UIN Maulana Malik Ibrahim Malang kepada Mahasiswa Penelitian Skripsi / Tugas Akhir atas nama : </td>
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
				<td>Nama</td>
				<td colspan="3">: <?php echo $nama; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>NIM</td>
				<td colspan="3">: <?php echo $nim; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Program Studi</td>
				<td colspan="3">: <?php echo $prodi; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Laboratorium</td>
				<td colspan="3">: <?php echo $namalab; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Penggunaan Laboratorium</td>
				<td colspan="3">: <?php echo tgl_indo($tglmulai); ?> s/d <?php echo tgl_indo($tglselesai); ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Dosen Pembimbing</td>
				<td colspan="3">: <?php echo $dosen; ?></td>
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
				<td style="text-align:center">Malang, <?php echo tgl_indo($tglvalidasifakultas); ?></td>
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
				<td style="text-align:center">Wakil Dekan Bidang Akademik</td>
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
					<td style="text-align:center"><img src="../ttd/ttd<?php echo $validatorfakultas; ?>.png" width="80" /></td>
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
				<td style="text-align:center"><u><?php echo $namadekan; ?></u></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="text-align:center"><small><i>Scan QRCode ini </i></td>
				<td>&nbsp;</td>
				<td style="text-align:center">NIP. <?php echo $nipdekan; ?></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="text-align:center"><img src="../qrcode/<?php echo $namafile; ?>.png" width="80" /></td>
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
</font>
</table>
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

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function semester($tanggal)
{
	$pecahkan = explode('-', $tanggal);
	if ($pecahkan[1] < 7) {
		return "Genap Tahun Akademik " . $pecahkan[0] . "/" . $pecahkan[0];
	} else {
		return "Ganjil Tahun Akademik " . $pecahkan[0] . "/" . $pecahkan[0];
	}
}
?>

</html>