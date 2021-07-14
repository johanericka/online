<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

require_once('../system/dbconn.php');

session_start();
$nim = $_SESSION['iduser'];
$nimanggota = mysqli_real_escape_string($dbsurat, $_POST['nim']);

if (empty($nimanggota)) {
	$ket = "nodata";
} else {
	//cari di observasianggota dulu
	$cari1 = mysqli_query($dbsurat, "SELECT * FROM observasianggota WHERE nimanggota = '$nimanggota'");
	$jcari1 = mysqli_num_rows($cari1);
	if ($jcari1 > 0) {
		$ket = "terdaftar";
	} else {
		//kalo belum ada kelompok cari di useraccount2
		$carianggota = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode ='$nimanggota'");
		$hasil = mysqli_num_rows($carianggota);
		if ($hasil > 0) {
			$data = mysqli_fetch_array($carianggota);
			$nimanggota2 = $data['kode'];
			$namaanggota2 = $data['nama'];
			$sql = "INSERT INTO observasianggota (nimketua, nimanggota, nama) 
							VALUES('$nim','$nimanggota2','$namaanggota2')";
			if (mysqli_query($dbsurat, $sql)) {
				echo "data tersimpan";
				$ket = "ok";
			} else {
				"error " . $mysqli_error($dbsurat);
			}
		} else {
			$ket = "nodata";
		}
	}
}

header("location:observasi-isi.php?ket=$ket");
