<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');

//update status validasi kaprodi
$sql = mysqli_query($dbsurat, "UPDATE wfh
					SET tglverifikasiprodi = '$tgl', 
					verifikasiprodi = '1'
					WHERE no = '$nodata'");

header("location:index.php");
