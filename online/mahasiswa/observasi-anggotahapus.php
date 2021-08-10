<?php
session_start();
require_once('../system/dbconn.php');

$nim = $_SESSION['nip'];
$nimanggota = mysqli_real_escape_string($dbsurat, $_GET['nimanggota']);

$qhapus = mysqli_query($dbsurat, "DELETE FROM observasianggota WHERE nimanggota ='$nimanggota' AND nimketua='$nim'");

header("location:index.php");
