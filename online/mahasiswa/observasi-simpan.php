<?php
session_start();
require('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);

//cari nama dosen
$sql = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE nim='$nim' and statussurat=-1");
$dsql = mysqli_fetch_array($sql);
$dosen = $dsql['dosen'];

//cari nip dosen
$stmt = $dbsurat->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $dosen);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipdosen = $dhasil['nip'];

//cari nip kajur
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan='kajur'");
$stmt->bind_param("s", $prodi);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkaprodi = $dhasil['nip'];

//cari nip wd-1
$jabatan = 'wakildekan';
$level = 4;
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=? AND level=?");
$stmt->bind_param("si", $jabatan, $level);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd = $dhasil['nip'];

$statussurat = 0;

$qupdate = mysqli_query($dbsurat, "UPDATE observasi SET validator1='$nipdosen', validator2='$nipkaprodi', validator3='$nipwd', statussurat='0' WHERE nim='$nim' and statussurat=-1");
if ($qupdate) {
	echo "sukses";
} else {
	echo "gagal";
}

/*
$stmt = $dbsurat->prepare("UPDATE pkl 
                                SET validator1=?,
                                    validator2=?,
                                    validator3=?,
                                    statussurat=? 
                                WHERE no=?");
$stmt->bind_param("sssii", $nipkoor, $nipkaprodi, $nipwd, $statussurat, $nodata);
$stmt->execute();
*/
header("location:index.php");
