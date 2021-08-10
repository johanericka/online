<?php
session_start();
require_once('../system/dbconn.php');

$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$cpl = mysqli_real_escape_string($dbsurat, $_POST['cpl']);
$indonesia = mysqli_real_escape_string($dbsurat, $_POST['indonesia']);
$english = mysqli_real_escape_string($dbsurat, $_POST['english']);
$def = $_POST['def'];

if (empty($indonesia) or empty($english)) {
	header("location:skpi-isi.php?pesan=gagal");
} else {
	$qsimpan = mysqli_query($dbsurat, "INSERT INTO skpi_cpl (jurusan, cpl, indonesia, english,def) VALUES ('$jurusan','$cpl','$indonesia','$english',$def)");

	if ($qsimpan) {
		header("location:skpi-isi.php");
	} else {
		echo "error " . mysqli_error($dbsurat);
	}
}
