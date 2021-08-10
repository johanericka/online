<?php
session_start();
require('../system/dbconn.php');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);

//hapus file sertifikat
$sql = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim'");
while ($data = mysqli_fetch_array($sql)) {
	$bukti = $data['bukti'];
	unlink($bukti);
}

//hapus pengajuan sertifikat
$sql = mysqli_query($dbsurat, "DELETE FROM skpi_prestasipenghargaan WHERE nim='$nim'");
//hapus pengajuan SKPI
$sql = mysqli_query($dbsurat, "DELETE FROM skpi WHERE nim='$nim'");
header("location:index.php");
