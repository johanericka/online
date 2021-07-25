<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$aktivitas = mysqli_real_escape_string($dbsurat, $_POST['aktivitas']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$aktivitas = mysqli_real_escape_string($dbsurat, $_POST['aktivitas']);
$indonesia = mysqli_real_escape_string($dbsurat, $_POST['indonesia']);
$english = mysqli_real_escape_string($dbsurat, $_POST['english']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);
$bukti = urlencode($_POST['bukti']);

//cari kode dosen dari nama dosen
$sql1 = mysqli_query($dbsurat, "select kode from useraccount2 where nama = '$dosen'");
$row = mysqli_fetch_row($sql1);
$kddosen = $row[0];

$qsimpan = mysqli_query($dbsurat, "INSERT INTO skpi_prestasipenghargaan (nim, nama, jurusan, aktivitas, indonesia, english,bukti) VALUES ('$nim','$nama','$jurusan','$aktivitas','$indonesia','$english','$bukti')");

if ($qsimpan) {
	header("location:skpi-isi.php");
} else {
	echo "error " . mysqli_error($dbsurat);
}
