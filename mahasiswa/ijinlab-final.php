<?php
session_start();
require("../system/dbconn.php");

$nim = $nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

$stmt = $dbsurat->prepare("SELECT * FROM ijinlab WHERE no=?");
$stmt->bind_param("i", $nodata);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$dosen = $dhasil['dosen'];
$prodi = $dhasil['prodi'];

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
$level = 2;
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=? AND level=?");
$stmt->bind_param("si", $jabatan, $level);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd1 = $dhasil['nip'];


//update pengajuan masukkan data dosen, kaprodi & wd-1
$status = 0;
$stmt = $dbsurat->prepare("UPDATE ijinlab SET tanggal=?, validator1=?, validator2=?, validator3=?,statuspengajuan=? WHERE no=?");
$stmt->bind_param("ssssii", $tanggal, $nipdosen, $nipkaprodi, $nipwd1, $status, $nodata);
$stmt->execute();

header("location:index.php");
