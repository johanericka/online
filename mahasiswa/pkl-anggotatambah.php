<?php
require_once('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nimanggota = mysqli_real_escape_string($dbsurat, $_POST['nimanggota']);
echo "NIM = " . $nim;
echo "NIM anggota = " . $nimanggota;


if (empty($nimanggota)) {
	$ket = "notfound";
} else {
	$carianggota = mysqli_query($dbsurat, "SELECT kode, nama FROM useraccount2 WHERE kode='$nimanggota'");
	$hasil = mysqli_num_rows($carianggota);
	if ($hasil > 0) {
		$data = mysqli_fetch_array($carianggota);
		$nimanggota2 = $data[0];
		$namaanggota2 = $data[1];
		$sql = "INSERT INTO pklanggota (nimketua, nimanggota, nama) 
				values('" . $nim . "','" . $nimanggota2 . "','" . $namaanggota2 . "')";
		if (mysqli_query($dbsurat, $sql)) {
			echo "data tersimpan";
			$ket = "ok";
		} else {
			echo "error " . $mysqli_error($dbsurat);
		}
	} else {
		$ket = "notfound";
	}
}

header("location:pkl-isi.php?ket=$ket");
