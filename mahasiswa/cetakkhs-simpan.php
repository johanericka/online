<?php
session_start();
require_once('../system/dbconn.php');
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$semester = mysqli_real_escape_string($dbsurat, $_POST['semester']);
$tahunakademik = mysqli_real_escape_string($dbsurat, $_POST['tahunakademik']);
$keperluan = mysqli_real_escape_string($dbsurat, $_POST['keperluan']);
$alasan = mysqli_real_escape_string($dbsurat, $_POST['alasan']);
$alasanbelumdiambil = mysqli_real_escape_string($dbsurat, $_POST['alasanbelumdiambil']);

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
$stmt = $dbsurat->prepare("INSERT INTO cetakkhs (tanggal, nim, nama, prodi, semester, tahunakademik, keperluan, alasan, alasanbelumdiambil, validator2, validator3) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssss", $tanggal, $nim, $nama, $prodi, $semester, $tahunakademik, $keperluan, $alasan, $alasanbelumdiambil, $nipkaprodi, $nipwd1);
$stmt->execute();

//header("location:index.php");
