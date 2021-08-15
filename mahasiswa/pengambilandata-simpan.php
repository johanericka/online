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
$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$tglpelaksanaan = mysqli_real_escape_string($dbsurat, $_POST['tglpelaksanaan']);
$datadiperlukan = mysqli_real_escape_string($dbsurat, $_POST['datadiperlukan']);

//cari nip dosen
$stmt = $dbsurat->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $dosen);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipdosen = $dhasil['nip'];

//cari nip kajur
$kdjabatan = 'kaprodi';
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan=?");
$stmt->bind_param("ss", $prodi, $kdjabatan);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkaprodi = $dhasil['nip'];

//cari nip wd-1
$jabatan = 'wadek1';
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=?");
$stmt->bind_param("s", $jabatan);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd1 = $dhasil['nip'];

//masukin data
$stmt = $dbsurat->prepare("INSERT INTO pengambilandata (tanggal, nim, nama, prodi, judulskripsi, dosen, instansi, alamat, tglpelaksanaan,datadiperlukan,validator1,validator2,validator3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssssss", $tanggal, $nim, $nama, $prodi, $judulskripsi, $dosen, $instansi, $alamat, $tglpelaksanaan, $datadiperlukan, $nipdosen, $nipkaprodi, $nipwd1);
$stmt->execute();

header("location:index.php");
