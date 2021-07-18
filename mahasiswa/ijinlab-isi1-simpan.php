<?php
require('../system/dbconn.php');
date_default_timezone_set("Asia/Jakarta");

$tanggal = date('Y-m-d H:i:s');
$nama =  mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['prodi']);
$ttl = mysqli_real_escape_string($dbsurat, $_POST['ttl']);
$alamatasal = mysqli_real_escape_string($dbsurat, $_POST['alamatasal']);
$alamatmalang = mysqli_real_escape_string($dbsurat, $_POST['alamatmalang']);
$nohp = mysqli_real_escape_string($dbsurat, $_POST['nohp']);
$nohportu = mysqli_real_escape_string($dbsurat, $_POST['nohportu']);
$riwayatpenyakit = mysqli_real_escape_string($dbsurat, $_POST['riwayatpenyakit']);
$posisi = mysqli_real_escape_string($dbsurat, $_POST['posisi']);
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);
$tglmulai = mysqli_real_escape_string($dbsurat, $_POST['tglmulai']);
$tglselesai = mysqli_real_escape_string($dbsurat, $_POST['tglselesai']);

//hitung jumlah hari
$jmlhari = (strtotime($tglselesai) - strtotime($tglmulai)) / 60 / 60 / 24;
if ($jmlhari > 30) {
    $tglselesai = date('Y-m-d', strtotime($tglmulai . " +1 month"));
}

//masukin data
$stmt = $dbsurat->prepare("INSERT INTO ijinlab (tanggal, nim, nama, ttl, alamatasal, alamatmalang, nohp, nohportu, riwayatpenyakit, posisi, prodi, namalab, dosen,tglmulai,tglselesai) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssssssss", $tanggal, $nim, $nama, $ttl, $alamatasal, $alamatmalang, $nohp, $nohportu, $riwayatpenyakit, $posisi, $prodi, $namalab, $dosen, $tglmulai, $tglselesai);
$stmt->execute();

header("location:ijinlab-isi2.php");
