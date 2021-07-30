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
if ($jabatan == 'tendik') {
	$jabatan = 'Tenaga Kependidikan';
} elseif ($jabatan == 'wadek1' or $jabatan == 'wadek2' or $jabatan == 'wadek3') {
	$jabatan = 'Wakil Dekan';
} elseif ($jabatan == 'dekan') {
	$jabatan = 'Dekan';
} else {
	$jabatan = 'Dosen';
}


//cari nip kajur
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan='kajur'");
$stmt->bind_param("s", $prodi);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkaprodi = $dhasil['nip'];

//cari nip wd-2
$jabatanwd = 'wadek2';
$level = 3;
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=?");
$stmt->bind_param("i", $jabatanwd);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd = $dhasil['nip'];

echo $nipkaprodi . '<br/>';
echo $nipwd;

if ($prodi == 'Teknik Informatika') {
	$sql = "INSERT INTO wfh (prodi, tglsurat, iduser, nip, nama, jabatan, tglwfh1, kegiatan1, tglwfh2, kegiatan2,tglwfh3, kegiatan3, tglwfh4, kegiatan4,tglwfh5, kegiatan5,verifikatorprodi, verifikasiprodi, tglverifikasiprodi, verifikatorfakultas) 
			VALUES ('$prodi','$tglsurat','$nip','$nip','$nama','$jabatan','$tgl1','$kegiatan1','$tgl2','$kegiatan2','$tgl3','$kegiatan3','$tgl4','$kegiatan4','$tgl5','$kegiatan5','$nipkaprodi','1','$tglsurat','$nipwd')";
} else {
	$sql = "INSERT INTO wfh (prodi, tglsurat, iduser, nama, nip,jabatan, tglwfh1, kegiatan1, tglwfh2, kegiatan2,tglwfh3, kegiatan3, tglwfh4, kegiatan4,tglwfh5, kegiatan5,verifikatorjurusan, verifikatorprodi) 
			VALUES ('$prodi','$tglsurat','$nip','$nama','$nip','$jabatan','$tgl1','$kegiatan1','$tgl2','$kegiatan2','$tgl3','$kegiatan3','$tgl4','$kegiatan4','$tgl5','$kegiatan5','$nipkaprodi','$nipwd')";
}

if (mysqli_query($dbsurat, $sql)) {
	header("location:index.php");
} else {
	echo "error " . mysqli_error($dbsurat);
}
