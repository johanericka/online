<?php
require_once('../system/dbconn.php');
session_start();

date_default_timezone_set("Asia/Jakarta");

$iduser = $_SESSION['iduser'];
$tanggal = date('Y-m-d H:i:s');
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$ttl = mysqli_real_escape_string($dbsurat, $_POST['ttl']);
$alamatasal = mysqli_real_escape_string($dbsurat, $_POST['alamatasal']);
$alamatmalang = mysqli_real_escape_string($dbsurat, $_POST['alamatmalang']);
$nohp = mysqli_real_escape_string($dbsurat, $_POST['nohp']);
$nohportu = mysqli_real_escape_string($dbsurat, $_POST['nohportu']);
$riwayatpenyakit = mysqli_real_escape_string($dbsurat, $_POST['riwayatpenyakit']);
$posisi = mysqli_real_escape_string($dbsurat, $_POST['posisi']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);
$tglmulai = mysqli_real_escape_string($dbsurat, $_POST['tglmulai']);
$tglselesai = mysqli_real_escape_string($dbsurat, $_POST['tglselesai']);

//cari kode dosen dari nama dosen
$sql1 = mysqli_query($dbsurat, "select kode from useraccount2 where nama = '$dosen'");
$row = mysqli_fetch_row($sql1);
$kddosen = $row[0];

//cari kaprodi
$sql2 = mysqli_query($dbsurat, "select iddosen from pejabat where jurusan ='$prodi' and level=5");
$data = mysqli_fetch_row($sql2);
$kdkaprodi = $data[0];

/*
echo "No Data = " . $nodata . "<br/>";
echo "ID User = " . $iduser . "<br/>";
echo "NIM = " . $nim . "<br/>";
echo "Nama = " . $nama . "<br/>";
echo "Tempat Tanggal Lahir = " . $ttl . "<br/>";
echo "Alamat Asal = " . $alamatasal . "<br/>";
echo "Alamat Malang = " . $alamatmalang . "<br/>";
echo "No. HP = " . $nohp . "<br/>";
echo "No. HP Orang Tua = " . $nohportu . "<br/>";
echo "Riwayat penyakit = " . $riwayatpenyakit . "<br/>";
echo "Posisi = " . $posisi . "<br/>";
echo "Program Studi = " . $prodi . "<br/>";
echo "Kode kaprodi = " . $kdkaprodi . "<br/>";
echo "Nama Lab = " . $namalab . "<br/>";
echo "Dosen Pembimbing = " . $dosen . "<br/>";
echo "Kode Dosen = " . $kddosen . "<br/>";
echo "Tanggal Mulai = " . $tglmulai . "<br/>";
echo "Tanggal Selesai = " . $tglselesai . "<br/>";
*/

//hitung jumlah hari
$jmlhari = (strtotime($tglselesai) - strtotime($tglmulai)) / 60 / 60 / 24;
//echo "Jumlah hari = ".$jmlhari	."<br/>";
//jika jumlah hari >30 maka di potong jadi 1 bulan saja
if ($jmlhari > 30) {
	$tglselesai = date('Y-m-d', strtotime($tglmulai . " +1 month"));
	//echo "Tanggal Selesai baru ".$tglselesai;
}


//kalo belom ada datanya insert baru kalo sudah ada di update
if (isset($nodata)) {
	//cek kapasitas lab
	$querylab = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE namalab = '$namalab'");
	$datalab = mysqli_fetch_array($querylab);
	$kapasitas = $datalab['kapasitas'];
	echo "Kapasitas = " . $kapasitas;

	if ($kapasitas >= 0) {
		$sql = mysqli_query($dbsurat, "INSERT INTO ijinlab (tanggal, nim, nama, ttl, alamatasal, alamatmalang, nohp, nohportu, riwayatpenyakit, posisi, prodi, namalab, dosen, tglmulai, tglselesai ) 
									VALUES ('$tanggal','$nim','$nama','$ttl','$alamatasal','$alamatmalang','$nohp','$nohportu','$riwayatpenyakit','$posisi','$prodi','$namalab','$dosen','$tglmulai','$tglselesai')");

		//$sql2 = mysqli_query($dbsurat,"UPDATE laboratorium SET kapasitas = kapasitas - 1 WHERE namalab = '$namalab'");

		header("location:lab-isi-lamp.php");
	} else {
		echo "<script>alert('ERROR!! Mohon maaf kapasitas lab. sudah penuh');
				document.location='index.php'</script>";
	}
} else {
	$sql3 = mysqli_query($dbsurat, "UPDATE ijinlab SET
								tanggal = '$tanggal',
								alamatasal = '$alamatasal',
								alamatmalang =  '$alamatmalang',
								nohp = '$nohp', 
								nohportu = '$nohportu',
								riwayatpenyakit = '$riwayatpenyakit',
								posisi = '$posisi',
								tglmulai = '$tglmulai', 
								tglselesai = '$tglselesai'
							WHERE no = '$nodata'");

	header("location:index.php");
}
