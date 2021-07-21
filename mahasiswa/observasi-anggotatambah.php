<?php
session_start();
require_once('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nimanggota = mysqli_real_escape_string($dbsurat, $_POST['nimanggota']);
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);

if (empty($nimanggota)) {
	$ket = "notfound";
} else {
	$carianggota = mysqli_query($dbsurat, "SELECT nip, nama FROM pengguna WHERE nip='$nimanggota'");
	$hasil = mysqli_num_rows($carianggota);
	if ($hasil > 0) {
		$data = mysqli_fetch_array($carianggota);
		$nimanggota2 = $data['nip'];
		$namaanggota2 = $data['nama'];
		$sql = "INSERT INTO observasianggota (nimketua, nimanggota, nama) 
				values('$nim','$nimanggota2','$namaanggota2')";
		if (mysqli_query($dbsurat, $sql)) {
			$ket = "ok";
		} else {
			echo "error " . $mysqli_error($dbsurat);
		}
	} else {
		$ket = "notfound";
	}
}

header("location:observasi-isianggota.php?nodata=$nodata&ket=$ket");
