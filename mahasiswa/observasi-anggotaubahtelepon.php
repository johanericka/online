<?php
require_once('../system/dbconn.php');

$nimanggota = mysqli_real_escape_string($dbsurat, $_POST['nimanggota']);
$telepon = mysqli_real_escape_string($dbsurat, $_POST['telepon']);
//echo "NIM Anggota = " . $nimanggota;
//echo "Telepon = " . $telepon;

$qubah = mysqli_query($dbsurat, "UPDATE observasianggota SET telepon = '$telepon' WHERE nimanggota ='$nimanggota'");

header("location:observasi-isi.php");
