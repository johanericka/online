<?php
session_start();
require_once('../system/dbconn.php');
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");

$tgl = date('Y-m-d H:i:s');
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);

//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE ijinpenelitian
					SET tglvalidasi2 = '$tgl', 
					validasi2 = '1'
					WHERE no = '$nodata' AND validator2='$nip'");

header("location:index.php");
