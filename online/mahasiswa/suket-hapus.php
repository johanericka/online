<?php
session_start();

require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = $_SESSION['nip'];

$qlampiran = mysqli_query($dbsurat, "SELECT * FROM suket WHERE no='$nodata' AND nim='$nim'");
$dlampiran = mysqli_fetch_array($qlampiran);
$lampiran = $dlampiran['lampiran'];
unlink($lampiran);

$query3 = mysqli_query($dbsurat, "DELETE FROM suket WHERE no = '$nodata' AND nim='$nim'");

header("location:index.php");
