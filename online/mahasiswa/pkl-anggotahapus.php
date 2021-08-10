<?php
session_start();
require_once('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nimanggota = mysqli_real_escape_string($dbsurat, $_GET['nimanggota']);
$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$qhapus = mysqli_query($dbsurat, "DELETE FROM pklanggota WHERE nimketua = '$nim' AND nimanggota ='$nimanggota'");

header("location:pkl-isianggota.php?nodata=$nodata&ket=$ket");
