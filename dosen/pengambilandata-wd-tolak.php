<?php
session_start();
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$keterangan = mysqli_real_escape_string($dbsurat, $_POST['keterangan']);

//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE pengambilandata
					SET tglvalidasi3 = '$tgl', 
					validasi3 = '2',
                    keterangan='$keterangan',
                    statussurat=2
					WHERE no = '$nodata' AND validator3='$nip'");

header("location:index.php");
