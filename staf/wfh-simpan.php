<?php
session_start();
require_once('../system/dbconn.php');
//require_once('../system/phpmailer/sendmail.php');

$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$jabatan = mysqli_real_escape_string($dbsurat, $_SESSION['jabatan']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
date_default_timezone_set("Asia/Jakarta");
$tglsurat = date('Y-m-d H:i:s');
$tgl1 = mysqli_real_escape_string($dbsurat, $_POST['tgl1']);
$kegiatan1 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan1']);
$tgl2 = mysqli_real_escape_string($dbsurat, $_POST['tgl2']);
$kegiatan2 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan2']);
$tgl3 = mysqli_real_escape_string($dbsurat, $_POST['tgl3']);
$kegiatan3 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan3']);
$tgl4 = mysqli_real_escape_string($dbsurat, $_POST['tgl4']);
$kegiatan4 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan4']);
$tgl5 = mysqli_real_escape_string($dbsurat, $_POST['tgl5']);
$kegiatan5 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan5']);

//kaprodi keatas verifikasi wd2
if ($prodi == 'SAINTEK') {
	//tendik fakutlas yang ttd kabag
	$kdjabatan = 'kabag-aupk';
	$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan=?");
	$stmt->bind_param("ss", $prodi, $kdjabatan);
	$stmt->execute();
	$result = $stmt->get_result();
	$dhasil = $result->fetch_assoc();
	$nipkaprodi = $dhasil['nip'];
} else {
	//tendik fakutlas yang ttd kabag
	$kdjabatan = 'kaprodi';
	$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan=?");
	$stmt->bind_param("ss", $prodi, $kdjabatan);
	$stmt->execute();
	$result = $stmt->get_result();
	$dhasil = $result->fetch_assoc();
	$nipkaprodi = $dhasil['nip'];
}
//cari nip wd-2
$jabatanwd = 'wadek2';
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=?");
$stmt->bind_param("s", $jabatanwd);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd = $dhasil['nip'];




if ($jabatan == 'dosen') {
	$jabatan = 'Dosen';
} elseif ($jabatan == 'kaprodi') {
	$jabatan = 'Ketua Program Studi';
} elseif ($jabatan == 'wadek1') {
	$jabatan = 'Wakil Dekan bidang Akademik';
} elseif ($jabatan == 'wadek2') {
	$jabatan = 'Wakil Dekan bidang AUPK';
} elseif ($jabatan == 'wadek3') {
	$jabatan = 'Wakil Dekan bidang Kemahasiswaan';
} elseif ($jabatan == 'tendik') {
	$jabatan = 'Tenaga Kependidikan';
} elseif ($jabatan == 'kabag') {
	$jabatan = 'Kepala Bagian AUPK';
} elseif ($jabatan == 'kasubag') {
	$jabatan = 'Kepala Sub Bagian';
}

if ($prodi == 'Teknik Informatika') {
	$sql = "INSERT INTO wfh (prodi, tglsurat, iduser, nip, nama, jabatan, tglwfh1, kegiatan1, tglwfh2, kegiatan2,tglwfh3, kegiatan3, tglwfh4, kegiatan4,tglwfh5, kegiatan5,verifikatorprodi, verifikasiprodi, tglverifikasiprodi, verifikatorfakultas) 
			VALUES ('$prodi','$tglsurat','$nip','$nip','$nama','$jabatan','$tgl1','$kegiatan1','$tgl2','$kegiatan2','$tgl3','$kegiatan3','$tgl4','$kegiatan4','$tgl5','$kegiatan5','$nipkaprodi','1','$tglsurat','$nipwd')";
} else {
	$sql = "INSERT INTO wfh (prodi, tglsurat, iduser, nama, nip,jabatan, tglwfh1, kegiatan1, tglwfh2, kegiatan2,tglwfh3, kegiatan3, tglwfh4, kegiatan4,tglwfh5, kegiatan5,verifikatorprodi, verifikatorfakultas) 
			VALUES ('$prodi','$tglsurat','$nip','$nama','$nip','$jabatan','$tgl1','$kegiatan1','$tgl2','$kegiatan2','$tgl3','$kegiatan3','$tgl4','$kegiatan4','$tgl5','$kegiatan5','$nipkaprodi','$nipwd')";
}

if (mysqli_query($dbsurat, $sql)) {
	header("location:index.php");
} else {
	echo "error " . mysqli_error($dbsurat);
}
