<?php
session_start();
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$bulan = date('m');
$tahun = date('Y');
$nosurat = "B-" . $nodata . ".O/FST.3/PP.06/" . $bulan . "/" . $tahun . "";

$sql = mysqli_query($dbsurat, "UPDATE pkl
					SET tglvalidasi3 = '$tgl', 
					validasi3 = '1',
					keterangan = '$nosurat',
					statussurat = 1
					WHERE no = '$nodata' AND validator3='$nip'");

header("location:index.php");
