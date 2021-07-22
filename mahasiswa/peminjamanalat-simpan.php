<?php
session_start();
require_once('../system/dbconn.php');
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$judulskripsi = mysqli_real_escape_string($dbsurat, $_POST['judulskripsi']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);
$pimpinaninstansi = mysqli_real_escape_string($dbsurat, $_POST['pimpinaninstansi']);
$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$namaalat = mysqli_real_escape_string($dbsurat, $_POST['namaalat']);
$jumlahalat = mysqli_real_escape_string($dbsurat, $_POST['jumlahalat']);
$tglmulai = mysqli_real_escape_string($dbsurat, $_POST['tglmulai']);
$tglselesai = mysqli_real_escape_string($dbsurat, $_POST['tglselesai']);

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

//masukin data
$stmt = $dbsurat->prepare("INSERT INTO peminjamanalat (tanggal, nim, nama, prodi, judulskripsi, dosen, pimpinaninstansi, instansi, alamat, namaalat, jumlahalat,tglmulai,tglselesai,validator1,validator2,validator3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssssssssss", $tanggal, $nim, $nama, $prodi, $judulskripsi, $dosen, $pimpinaninstansi, $instansi, $alamat, $namaalat, $jumlahalat, $tglmulai, $tglselesai, $nipdosen, $nipkaprodi, $nipwd1);
$stmt->execute();

header("location:index.php");
