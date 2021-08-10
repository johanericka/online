<?php
session_start();
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = $_SESSION['nip'];

$sql2 = mysqli_query($dbsurat, "DELETE FROM pengambilandata WHERE id='$nodata' AND nim='$nim'");

header("location:index.php");
