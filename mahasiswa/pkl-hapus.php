<?php
session_start();
require('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
//delete file upload
$query4 = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE no = '$nodata'");
$data = mysqli_fetch_array($query4);
$namafile = $data['lampiran'];
$namafile2 = $data['buktivaksin'];
unlink($namafile);
unlink($namafile2);
//delete record
$query2 = mysqli_query($dbsurat, "DELETE FROM pklanggota WHERE nimketua = '$nim'");
$query3 = mysqli_query($dbsurat, "DELETE FROM pkl WHERE no = '$nodata'");

header("location:index.php");
