<?php
session_start();
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$keterangan = mysqli_real_escape_string($dbsurat, $_POST['keterangan']);

//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE wfh
					SET tglverifikasiprodi = '$tgl', 
					verifikasiprodi = '2',
                    keterangan='$keterangan'
					WHERE no = '$nodata'");
header("location:index.php");
