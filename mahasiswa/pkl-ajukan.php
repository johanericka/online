<?php
session_start();
require('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);

//cari nip koordinator pkl
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan='koorpkl'");
$stmt->bind_param("s", $prodi);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkoor = $dhasil['nip'];

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

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$statussurat = 0;
echo $nim . "<br/>";
echo $nipkoor . "<br/>";
echo $nipkaprodi . "<br/>";
echo $nipwd . "<br/>";
echo $nodata . "<br/>";
echo $statussurat . "<br/>";

$qupdate = mysqli_query($dbsurat, "UPDATE pkl SET validator1='$nipkoor', validator2='$nipkaprodi', validator3='$nipwd', statussurat='0' WHERE no='$nodata' AND nim='$nim'");
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
