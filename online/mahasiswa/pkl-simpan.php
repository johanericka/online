<?php
require_once('../system/dbconn.php');

session_start();
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$kdjurusan = substr($nim, 2, 2);
$kdfakultas = substr($nim, 2, 1);
$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$tempatpkl = mysqli_real_escape_string($dbsurat, $_POST['tempatpkl']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$mulaipkl = $_POST['tglmulai'];
$selesaipkl = $_POST['tglselesai'];
$tglmulai = date('y-m-d', strtotime($mulaipkl));
$tglselesai = date('y-m-d', strtotime($selesaipkl));

//cari jurusan
$query = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
$data = mysqli_fetch_array($query);
$jurusan = $data['jurusan'];

//cari kajur
$sql2 = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level = 5 AND jurusan = '$jurusan'");
$row2 = mysqli_fetch_row($sql2);
$kdkajur = $row2[0];

//cari sekjur
$sql3 = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level = 6 AND jurusan = '$jurusan'");
$row3 = mysqli_fetch_row($sql3);
$kdsekjur = $row3[0];

//cari wd3
$sql = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level = 4 AND jurusan = 'SAINTEK'");
$data = mysqli_fetch_row($sql);
$kdwd = $data[0];

/*
echo "NIM =" . $nim . "<br/>";
echo "Nama =" . $nama . "<br/>";
echo "Kode Jurusan =" . $kdjurusan . "<br/>";
echo "Kode Fakultas =" . $kdfakultas . "<br/>";
echo "Instansi =" . $instansi . "<br/>";
echo "Tempat PKL =" . $tempatpkl . "<br/>";
echo "Alamat =" . $alamat . "<br/>";
echo "Mulai PKL =" . $mulaipkl . "<br/>";
echo "Selesai PKL =" . $selesaipkl . "<br/>";
*/

if (empty($instansi) or empty($alamat)	or ($mulaipkl == 0)	or ($selesaipkl == 0)) {
	echo "<script>alert('ERROR!! ada data yang belum terisi, silahkan cek kembali');
			document.location='pkl-isi.php'</script>";
} else {
	$sql = mysqli_query($dbsurat, "INSERT INTO pkl (nim, nama, kdfakultas, kdjurusan, instansi, tempatpkl, alamat, tglmulai, tglselesai,validatorkoor,validatorjurusan,validatorfakultas) 
														VALUES ('$nim', '$nama', '$kdfakultas', '$kdjurusan', '$instansi','$tempatpkl', '$alamat', '$tglmulai', '$tglselesai','$kdsekjur','$kdkajur','$kdwd')");
	mysqli_close($dbsurat);
	mysqli_close($dbsiakad);
	header("location:index.php");
}
