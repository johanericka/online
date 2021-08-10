<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$bulan = date('m');
$tahun = date('Y');
$nosurat = "B-" . $nodata . ".O/FST.3/KM.01.2/" . $bulan . "/" . $tahun . "";
//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE suket
					SET tglvalidasi3 = '$tgl', 
					validasi3 = '1',
					keterangan = '$nosurat',
					statussurat = 1
					WHERE no = '$nodata'");

header("location:index.php");
