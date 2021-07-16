<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);

//cek kapasitas lab
$sql3 = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE namalab='$namalab'");
$dlab = mysqli_fetch_array($sql3);
$kapasitas = $dlab['kapasitas'];
if ($kapasitas > 0) {



	//update status validasi dosen pembimbing
	$sql = mysqli_query($dbsurat, "UPDATE ijinlab
					SET tglvalidasi1 = '$tgl', 
					validasi1 = '1'
					WHERE no = '$nodata'");

	//update kapasitas lab
	$sql2 = mysqli_query($dbsurat, "UPDATE laboratorium
					SET kapasitas = kapasitas-1 
					WHERE namalab = '$namalab'");

	header("location:index.php");
} else {
	header("location:ijinlab-dosbing-tampil.php?nodata=$nodata&pesan=penuh");
}
