<?php
session_start();
require('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);

$query2 = mysqli_query($dbsurat, "DELETE FROM pklanggota WHERE nimketua = '$nim'");
$query3 = mysqli_query($dbsurat, "DELETE FROM pkl WHERE nim = '$nim'");

$query4 = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE no = '$nodata'");
$data = mysqli_fetch_array($query4);
$namafile = $data['lampiran'];
unlink($namafile);

header("location:index.php");
