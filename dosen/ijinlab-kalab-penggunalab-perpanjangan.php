<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$tglmulai = mysqli_real_escape_string($dbsurat, $_POST['tglmulai']);
$tglselesai = mysqli_real_escape_string($dbsurat, $_POST['tglselesai']);

echo "No Data = " . $nodata . "<br/>";
echo "tglmulai = " . $tglmulai . "<br/>";
echo "tglselesai = " . $tglselesai . "<br/>";

//update waktu penggunaan lab
$query1 = mysqli_query($dbsurat, "UPDATE ijinlab 
																	SET tglmulai = '$tglmulai',
																			tglselesai = '$tglselesai'
																	WHERE no = '$nodata'");
header("location:ijinlab-kalab-penggunalab-detail.php?nodata=$nodata");
