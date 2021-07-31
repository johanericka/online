<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$bulan = date('m');
$tahun = date('Y');
$nosurat = $nodata . ".O/FST.2/KP.01.4/" . $bulan . "/" . $tahun . "";
//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE wfh
					SET tglverifikasifakultas = '$tgl', 
					verifikasifakultas = '1',
					keterangan = '$nosurat'
					WHERE no = '$nodata'");

header("location:index.php");
