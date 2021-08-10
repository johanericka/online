<?php
session_start();
require_once('../system/dbconn.php');
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);

date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$bulan = date('m');
$tahun = date('Y');
$nosurat = "B-" . $nodata . ".O/FST.01/TL.00/" . $bulan . "/" . $tahun . "";

//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE ijinpenelitian
					SET tglvalidasi3 = '$tgl', 
					validasi3 = '1',
					keterangan = '$nosurat',
					statussurat=1
					WHERE no = '$nodata' AND validator3='$nip'");

header("location:index.php");
