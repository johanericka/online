<?php
require_once('../system/dbconn.php');
session_start();
$nimanggota = mysqli_real_escape_string($dbsurat, $_POST['nimanggota']);
$telepon = mysqli_real_escape_string($dbsurat, $_POST['telepon']);
//echo "NIM Anggota = " . $nimanggota;
//echo "Telepon = " . $telepon;

$qubah = mysqli_query($dbsurat, "UPDATE pklanggota SET telepon = '$telepon' WHERE nimanggota ='$nimanggota'");

header("location:pkl-isi.php");
