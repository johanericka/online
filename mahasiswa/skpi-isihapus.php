<?php
session_start();
require('../system/dbconn.php');
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);

$sql = mysqli_query($dbsurat, "DELETE FROM skpi_prestasipenghargaan WHERE no='$nodata' AND nim='$nim'");
header("location:skpi-isi.php");
