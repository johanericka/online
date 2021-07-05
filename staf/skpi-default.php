<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$def = $_POST['def'];
//echo "No. Data = " . $nodata . "<br/>";
//echo "Centang = " . $def . "<br/>";

$qupdate = mysqli_query($dbsurat, "UPDATE skpi_cpl 
									SET def='" . $def . "'
									WHERE no='" . $nodata . "'");

header("location:skpi-isi.php");
