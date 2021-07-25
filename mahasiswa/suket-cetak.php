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

<!-- ambil data ijin lab dari tabel suket -->
<?php
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$datamhs = mysqli_query($dbsurat, "select * from suket where id='$nodata'");
$row = mysqli_fetch_array($datamhs);
$nosurat = $row['keterangan'];
$nim = $row['nim'];
$nama = $row['nama'];
$jurusan = $row['jurusan'];
$jenissurat = $row['jenissurat'];
$keperluan = $row['keperluan'];
$validatorfakultas = $row['validatorfakultas'];
$validasifakultas = $row['validasifakultas'];
$tglvalidasifakultas = $row['tglvalidasifakultas'];
$keterangan = $row['keterangan'];
$tgl = date('Y-m-d', strtotime($row[14]));
$jam = date('H-i-s');
$tahun = date('Y');
$bulan = date('m');



//data wd
$datawd = mysqli_query($dbsurat, "select * from pejabat where iddosen='$validatorfakultas'");
$rowwd = mysqli_fetch_array($datawd);
$idwd = $rowwd['iddosen'];
$nipwd = $rowwd['nip'];
$namawd = $rowwd['nama'];
$jabatanwd = $rowwd['jabatan'];

//buat qrcode
include "../system/phpqrcode/qrlib.php";
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $actual_link;
$tgl = date('Y-m-d');
$jam = date('H-m-s');
$codeContents = $actual_link;
$namafile = $nim . "-" . "suket" . $nodata;
QRcode::png($codeContents, "../qrcode/$namafile.png", "L", 4, 4);
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
			<?php if ($jenissurat == "Surat Keterangan Kelakuan Baik") {
				echo "<td colspan='3' align='center'><b>SURAT KETERANGAN</b></td>";
			} else {
				echo "<td colspan='3' align='center'><b>SURAT REKOMENDASI</b></td>";
			}
			?>
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
				<td colspan="3">: <?php echo $namawd; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>NIP</td>
				<td colspan="3">: <?php echo $nipwd; ?></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>Jabatan</td>
				<td colspan="3">: <?php echo $jabatanwd; ?></td>
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
			<?php if ($jenissurat == "Surat Keterangan Kelakuan Baik") {
			?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Dengan ini menerangkan bahwa :</td>
					<td>&nbsp;</td>
				</tr>
			<?php
			} else {
			?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="4">Dengan ini memberikan rekomendasi kepada mahasiswa di bawah ini :</td>
				</tr>
			<?php
			}
			?>
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
				<td>Jurusan</td>
				<td colspan="3">: <?php echo $jurusan; ?></td>
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
			<?php if ($jenissurat == "Surat Keterangan Rekomendasi") {
			?>
				<tr>
					<td>&nbsp;</td>
					<td colspan="4">yang bersangkutan merupakan mahasiswa di program studi <?php echo $jurusan; ?> Fakultas Sains dan Teknologi UIN Maulana Malik Ibrahim Malang, dan kami <b>rekomendasikan</b> untuk mengikuti pendaftaran <?php echo $keperluan; ?> </td>
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
					<td colspan="4">Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</td>
					<td>&nbsp;</td>
				</tr>
			<?php
			} else {
			?>
				<tr>
					<td>&nbsp;</td>
					<?php
					if ($bulan < 7) {
						$semester = "Genap";
						$tahuna = $tahun - 1;
						$tahunb = $tahun;
					} else {
						$semester = "Ganjil";
						$tahuna = $tahun;
						$tahunb = $tahun + 1;
					}
					?>
					<td colspan="4">Pada Semester <?php echo $semester; ?> Tahun Akademik <?php echo $tahuna . "/" . $tahunb; ?> adalah mahasiswa di Program Studi <?php echo $jurusan; ?> Fakultas Sains dan Teknologi UIN Maulana Malik Ibrahim Malang dan
						<?php
						if ($jenissurat == "Surat Keterangan Keringanan UKT") {
						?>
							telah memenuhi syarat administrasi untuk mendapatkan <b> KERINGANAN UKT semester <?php echo $semester ?> Tahun Akademik <?php echo $tahuna . "/" . $tahunb; ?></b>.</td>
				<?php
						} elseif ($jenissurat == "Surat Keterangan Penurunan UKT") {
				?>
					telah memenuhi syarat administrasi untuk mendapatkan <b> PENURUNAN UKT semester <?php echo $semester ?> Tahun Akademik <?php echo $tahuna . "/" . $tahunb; ?></b>.</td>
				<?php
						} elseif ($jenissurat == "Surat Keterangan Perpanjangan Waktu Pembayaran UKT") {
				?>
					telah memenuhi syarat administrasi untuk mendapatkan <b> PERPANJANGAN WAKTU PEMBAYARAN UKT semester <?php echo $semester ?> Tahun Akademik <?php echo $tahuna . "/" . $tahunb; ?></b>.</td>
				<?php
						} else {
				?>
					<b>memiliki perilaku baik dalam aktivitas akademik</b>.</td>
				<?php
						}
				?>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<?php
				if ($jenissurat == "Surat Keterangan Rekomendasi" or $jenissurat == "Surat Keterangan Kelakuan Baik") {
				?>
					<tr>
						<td>&nbsp;</td>
						<td colspan="4">Demikian Surat Keterangan ini dibuat dengan sebenarnya untuk dipergunakan sebagai persyaratan <?php echo $keperluan; ?>.</td>
					</tr>
				<?php
				} else {
				?>
					<tr>
						<td>&nbsp;</td>
						<td colspan="4">Demikian Surat Keterangan ini dibuat dengan sebenarnya.</td>
					</tr>
				<?php
				}
				?>
			<?php
			}
			?>
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
				<td style="text-align:center">a.n. Dekan</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="text-align:center"><small><i>Scan QRCode ini </i></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="text-align:center"><?php echo $jabatanwd; ?>,</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="text-align:center"><img src="../qrcode/<?php echo $namafile; ?>.png" width="80" /></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<?php
				if ($validasifakultas == 1) {
				?>
					<td style="text-align:center"><img src="../ttd/ttd<?php echo $validatorfakultas; ?>.png" width="100" /></td>
				<?php
				}
				?>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td style="text-align:center"><small><i>untuk verifikasi surat</i></small></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="text-align:center"><u><?php echo $namawd; ?></u></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="text-align:center">NIP. <?php echo $nipwd; ?></td>
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
?>

</html>