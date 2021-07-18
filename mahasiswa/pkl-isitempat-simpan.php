<?php
session_start();
require_once('../system/dbconn.php');

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$tempatpkl = mysqli_real_escape_string($dbsurat, $_POST['tempatpkl']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$tglmulai = $_POST['tglmulai'];
$tglselesai = $_POST['tglselesai'];

//masukin data
$stmt = $dbsurat->prepare("INSERT INTO pkl (tanggal, prodi, nim, nama, instansi, tempatpkl, alamat, tglmulai, tglselesai) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssss", $tanggal, $prodi, $nim, $nama, $instansi, $tempatpkl, $alamat, $tglmulai, $tglselesai);
$stmt->execute();

header("location:pkl-isianggota.php");
