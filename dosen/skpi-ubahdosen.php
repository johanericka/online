<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);

if (empty($dosen)) {
	header("location:skpi-rekap.php?pesan=gagal");
}

//cari kode dosen dari nama dosen
$sql1 = mysqli_query($dbsurat, "SELECT kode FROM useraccount2 WHERE nama = '$dosen'");
if (mysqli_num_rows($sql1) == 0) {
	header("location:skpi-rekap.php?pesan=gagal");
} else {
	$row = mysqli_fetch_row($sql1);
	$kddosen = $row[0];
};

//cari kajur
$sql2 = mysqli_query($dbsurat, "select iddosen from pejabat where level = 5 and jurusan = '$jurusan'");
$row2 = mysqli_fetch_row($sql2);
$kdkajur = $row2[0];

//cari wd1
$sql = mysqli_query($dbsurat, "select iddosen from pejabat where level = 2 and jurusan = 'SAINTEK'");
$data = mysqli_fetch_row($sql);
$kdwd = $data[0];
/*
	echo "Nama = ".$nama."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "jurusan = ".$jurusan."<br/>";
	echo "dosen = ".$dosen."<br/>";
	echo "KD Dosen = ".$kddosen."<br/>";
	echo "KD Kajur = ".$kdkajur."<br/>";
	echo "KD WD = ".$kdwd."<br/>";
	*/

$qcari = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim'");
$cekdata = mysqli_num_rows($qcari);
if ($cekdata > 0) {
	$qsimpan = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan SET 
																		verifikator1='$kddosen',
																		verifikator2='$kdkajur',
																		verifikator3='$kdwd'
																		WHERE nim='$nim'");

	//cari email dosen wali
	$sql3 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$kddosen'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0) {
		$data3 = mysqli_fetch_array($sql3);
		$email = $data3['email'];
		$kirimemail = $data3['kirimemail'];

		if ($kirimemail > 0) {
			$subject = "Notifikasi Pengajuan Surat Keterangan Pendamping Ijazah";
			$pesan = "Yth. " . $dosen . "
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
}
header("location:skpi-rekap.php");
