<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);

//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE ijinpenelitian
					SET tglvalidasi1 = '$tgl', 
					validasi1 = '1'
					WHERE no = '$nodata'");

header("location:index.php");
