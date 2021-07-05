<?php
session_start();
if ($_SESSION['role'] != "mahasiswa") {
	header("location:../index.php?pesan=noaccess");
}

require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_GET['nodata']);
$nim = mysqli_real_escape_string($dbsurat, $_GET['nim']);
//echo "NO DATA = " . $nodata;
//echo "NIM = " . $nim;

//$query = mysqli_query($dbsurat, "SELECT * FROM pkl WHERE id='$nodata' AND nim='$nim'");
//$data = mysqli_fetch_array($query);
//$nim = $data['nim'];
//echo "NIM = " . $nim;


$query2 = mysqli_query($dbsurat, "DELETE FROM pklanggota WHERE nimketua = '$nim'");
$query3 = mysqli_query($dbsurat, "DELETE FROM pkl WHERE nim = '$nim'");

$query4 = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim = '$nim' and keterangan='paktaintegritaspkl'");
$data = mysqli_fetch_array($query4);
$namafile = $data['namafile'];
unlink($namafile);
$query5 = mysqli_query($dbsurat, "DELETE FROM upload WHERE nim = '$nim' AND keterangan='paktaintegritaspkl'");

header("location:index.php");
