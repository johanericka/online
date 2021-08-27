<?php
session_start();
require('../system/dbconn.php');
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);

$sql = mysqli_query($dbsurat, "DELETE FROM pejabat WHERE no='$nodata'");

header("location:pejabat-tampil.php");
