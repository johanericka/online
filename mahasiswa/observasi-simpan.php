<?php
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

require_once('../system/dbconn.php');
$id = mysqli_real_escape_string($dbsurat, $_POST['id']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
echo $nim . "<br/>";
echo $id . "<br/>";
if (strlen($id) == 8) {
	$kdjurusan = substr($nim, 2, 2);
} else {
	$kdjurusan = substr($nim, 3, 4);
}
echo $kdjurusan . "<br/>";;

//cari nama jurusan
$sql0 = mysqli_query($dbsurat, "SELECT jurusan FROM jurusan WHERE kdjurusan = '$kdjurusan'");
$row = mysqli_fetch_row($sql0);
$jurusan = $row[0];
if (strlen($id) == 8) {
	$kdfakultas = substr($nim, 2, 1);
} else {
	$kdfakultas = substr($nim, 3, 1);
}
echo $kdfakultas;
$matakuliah = mysqli_real_escape_string($dbsurat, $_POST['matakuliah']);
$namadosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);

//cari kode dosen dari nama dosen
$sql1 = mysqli_query($dbsurat, "SELECT kode FROM useraccount2 WHERE nama = '$namadosen'");
$row = mysqli_fetch_row($sql1);
$kddosen = $row[0];
$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$tanggal = mysqli_real_escape_string($dbsurat, $_POST['tanggal']);
$tglpelaksanaan = date('y-m-d', strtotime($tanggal));

//cari kajur
$sql2 = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level = 5 AND kdjurusan = '$kdjurusan'");
$row2 = mysqli_fetch_row($sql2);
$kdkajur = $row2[0];

//cari wd1
$sql = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level = 2 AND kdjurusan = '$kdfakultas'");
$data = mysqli_fetch_row($sql);
$kdwd = $data[0];

$sql = "insert into observasi (
						kdfakultas, 
						jurusan, 
						nim,
						nama,
						matakuliah, 
						kddosen, 
						namadosen, 
						instansi, 
						alamat, 
						tglpelaksanaan, 
						validatordosen,
						validatorjurusan,
						validatorfakultas) 
					values(
						'" . $kdfakultas . "',
						'" . $jurusan . "',
						'" . $nim . "',
						'" . $nama . "',
						'" . $matakuliah . "',
						'" . $kddosen . "',
						'" . $namadosen . "',
						'" . $instansi . "',
						'" . $alamat . "',
						'" . $tglpelaksanaan . "',
						'" . $kddosen . "',
						'" . $kdkajur . "',
						'" . $kdwd . "')";

if (mysqli_query($dbsurat, $sql)) {
	//echo "data tersimpan";
	//header("location:index.php");
} else {
	//echo "error " . $mysqli_error($dbsurat);
}
