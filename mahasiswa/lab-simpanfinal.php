<?php
require_once('../system/dbconn.php');
include('../system/phpmailer/sendmail.php');

session_start();
if ($_SESSION['role'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nim']);
$jurusan = mysqli_real_escape_string($dbsurat, $_SESSION['jurusan']);

// dapatkan no surat
$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE nim='$nim' AND validatordosen is null");
$data = mysqli_fetch_array($query);
$nodata = $data['no'];
$nama = mysqli_real_escape_string($dbsurat, $data['nama']);
$dosen = mysqli_real_escape_string($dbsurat, $data['dosen']);
$tglsurat = $data['tanggal'];

//dapatkan nama dosen
/*
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE no = '$nodata'");
	$data = mysqli_fetch_array($query);
		$dosen = $data['dosen'];
	*/

//cari kode dosen dari nama dosen
$sql1 = mysqli_query($dbsurat, "SELECT kode FROM useraccount2 WHERE nama = '$dosen'");
$row = mysqli_fetch_row($sql1);
$kddosen = $row[0];
echo "Nama Dosen = " . $dosen;
echo "Kode Dosen = " . $kddosen;

//cari kaprodi
$sql2 = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE jurusan ='$jurusan' and level=5");
$data = mysqli_fetch_row($sql2);
$kdkaprodi = $data[0];

//cari wd-1
$sql3 = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level=2");
$data = mysqli_fetch_row($sql3);
$kdwd = $data[0];


//cari email dosen pembimbing
$sql5 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$kddosen'");
$ceksql5 = mysqli_num_rows($sql5);
if ($ceksql5 > 0) {
	$data5 = mysqli_fetch_array($sql5);
	$emaildosen = $data5['email'];
	$kirimemaildosen = $data5['kirimemail'];
	if ($kirimemaildosen == 1) {
		$subject = "Notifikasi Pengajuan Ijin Penggunaan Lab.";
		$pesan = "Yth. " . $dosen . "
									<br/>
									<br/>
									Terdapat pengajuan Ijin Penggunaan Laboratorium atas nama " . $nama . ".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
		sendmail($emaildosen, $dosen, $subject, $pesan);
	}
}


//cari email user
$sql4 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$nim'");
$ceksql4 = mysqli_num_rows($sql4);
//apabila ada email user
if ($ceksql4 > 0) {
	$data4 = mysqli_fetch_array($sql4);
	$emailuser = $data4['email'];
	$kirimemailuser = $data4['kirimemail'];
	if ($kirimemailuser > 0) {
		$subject = "Notifikasi Pengajuan Ijin Penggunaan Lab.";
		$pesan = "Yth. " . $nama . "
									<br/>
									<br/>
									Pengajuan Ijin Penggunaan Laboratorium anda sedang menunggu verifikasi dosen pembimbing.
									<br/>
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
		sendmail($emailuser, $nama, $subject, $pesan);
	}
}


//updata data
$sql = "UPDATE ijinlab SET
						validatordosen = '$kddosen',
						validatorjurusan = '$kdkaprodi',
						validatorfakultas = '$kdwd'
					WHERE nim = '$nim' AND no = '$nodata'";
if (mysqli_query($dbsurat, $sql)) {
	header("location:index.php");
} else {
	echo "error " . $mysqli_error($dbsurat);
	//header("location:index.php");
}
