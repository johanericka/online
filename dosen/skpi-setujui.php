<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$iduser = mysqli_real_escape_string($dbsurat, $_POST['iduser']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$kemampuankerja = $_POST['kemampuankerja'];
$penguasaanpengetahuan = $_POST['penguasaanpengetahuan'];
$SikapKhusus = $_POST['SikapKhusus'];
$opsicpl = $_POST['cpl'];
$kemampuantambahan_ind = mysqli_real_escape_string($dbsurat, $_POST['kemampuantambahan_ind']);
$kemampuantambahan_eng = mysqli_real_escape_string($dbsurat, $_POST['kemampuantambahan_eng']);
$tgl = date('y-m-d');

//dosen pembimbing
$kddosen = $iduser;
echo "Kode Dosen = " . $iduser . "<br/>";

//cari kajur
$sql2 = mysqli_query($dbsurat, "SELECT * FROM pejabat WHERE level = 5 AND jurusan = '$jurusan'");
$row2 = mysqli_fetch_array($sql2);
$kdkajur = $row2['iddosen'];
$namakajur = $row2['nama'];
//echo "Kode Kajur = " . $kdkajur . "<br/>";

//cari wd1
$qwd1 = mysqli_query($dbsurat, "SELECT * FROM pejabat WHERE level = 2 AND jurusan = 'SAINTEK'");
$data = mysqli_fetch_array($qwd1);
$kdwd = $data['iddosen'];
echo "Kode WD = " . $kdwd . "<br/>";

echo "Kemampuan kerja = " . $kemampuankerja . "<br/>";
foreach ($kemampuankerja as $kerja) {
	$qcpl = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='" . $kerja . "' ");
	$data = mysqli_fetch_array($qcpl);
	$cpl = $data[2];
	$indonesia = $data[3];
	$english = $data[4];
	$qsimpan = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
}

echo "penguasaanpengetahuan = " . $penguasaanpengetahuan . "<br/>";
foreach ($penguasaanpengetahuan as $pengetahuan) {
	$qcpl2 = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='" . $pengetahuan . "' ");
	$data2 = mysqli_fetch_array($qcpl2);
	$cpl = $data2[2];
	$indonesia = $data2[3];
	$english = $data2[4];
	$qsimpan2 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
}

echo "SikapKhusus = " . $SikapKhusus . "<br/>";
foreach ($SikapKhusus as $khusus) {
	$qcpl3 = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='" . $khusus . "' ");
	$data3 = mysqli_fetch_array($qcpl3);
	$cpl = $data3[2];
	$indonesia = $data3[3];
	$english = $data3[4];
	$qsimpan3 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
}

//kemampuan tambahan
if (!empty($kemampuantambahan_ind)) {
	$qsimpan4 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																				('$nim','$nama','$jurusan','$opsicpl','$kemampuantambahan_ind','$kemampuantambahan_eng',1,'$kddosen','$tgl','$kdkajur','$kdwd')");
}

//setujui sertifikat
$qsimpan5 = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan 
																		SET verifikasi1=1,
																				tglverifikasi1='$tgl'
																		WHERE nim='$nim'");

//cari email kajur
$sql3 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$kdkajur'");
$ceksql3 = mysqli_num_rows($sql3);
if ($ceksql3 > 0) {
	$data3 = mysqli_fetch_array($sql3);
	$email = $data3['email'];
	$kirimemail = $data3['kirimemail'];

	if ($kirimemail > 0) {
		$subject = "Notifikasi Pengajuan Surat Keterangan Pendamping Ijazah";
		$pesan = "Yth. " . $namakajur . "
								<br/>
								<br/>
								Terdapat pengajuan <b>Surat Keterangan Pendamping Ijazah</b> atas nama " . $nama . ".
								<br/>
								Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
								<br/>
								<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";

		//kirim email
		sendmail($email, $nama, $subject, $pesan);
	}
}

//kembali ke dashboard
header("location:index.php");
?>

<!-- tanggal indonesia -->
<?php
function tgl_indo($tanggal)
{
	$bulan = array(
		1 =>   'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
?>