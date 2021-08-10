<?php
session_start();
require('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);

$query2 = mysqli_query($dbsurat, "DELETE FROM observasianggota WHERE nimketua = '$nim'");
$query3 = mysqli_query($dbsurat, "DELETE FROM observasi WHERE nim = '$nim'");

header("location:index.php");
