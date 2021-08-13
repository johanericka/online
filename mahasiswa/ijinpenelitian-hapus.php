<?php
session_start();
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = $_SESSION['nip'];

//hapus data
$sql2 = mysqli_query($dbsurat, "DELETE FROM ijinpenelitian WHERE no='$nodata' and nim='$nim'");

mysqli_close($dbsurat);
header("location:index.php");
