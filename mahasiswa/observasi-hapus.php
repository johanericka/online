<?php

require_once('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_GET['nim']);
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);

echo $nim;
echo $nodata;

$query = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE id='$nodata' AND nim='$nim'");
$data = mysqli_fetch_array($query);
$nimketua = $data['nim'];

//hapus anggota
$sql = mysqli_query($dbsurat, "DELETE FROM observasianggota WHERE nimketua='$nimketua'");
//hapus ketua
$sql2 = mysqli_query($dbsurat, "DELETE FROM observasi WHERE id='$nodata'");

header("location:index.php");
