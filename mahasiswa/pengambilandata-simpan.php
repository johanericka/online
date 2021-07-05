<?php
require_once('../system/dbconn.php');

$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$kdjurusan = substr($nim, 2, 2);
$kdfakultas = substr($nim, 2, 1);

//cari nama jurusan
$query = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
$data2 = mysqli_fetch_array($query);
$jurusan = $data2['jurusan'];

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$judulskripsi = mysqli_real_escape_string($dbsurat, $_POST['judulskripsi']);

//cari kode dosen dari nama dosen
$namadosen = mysqli_real_escape_string($dbsurat, $_POST['namadosen']);
$sql1 = mysqli_query($dbsurat, "SELECT kode FROM useraccount2 WHERE nama = '$namadosen'");
$hasildosen = mysqli_num_rows($sql1);
$row = mysqli_fetch_row($sql1);
$kddosen = $row[0];
$dosbing = $namadosen;

$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$tglpelaksanaan = date('y-m-d', strtotime($_POST['tglpelaksanaan']));
$data = mysqli_real_escape_string($dbsurat, $_POST['data']);

//cari kajur
$sql2 = mysqli_query($dbsurat, "select iddosen from pejabat where level = 5 and kdjurusan = '" . $kdjurusan . "'");
$row2 = mysqli_fetch_row($sql2);
$kdkajur = $row2[0];

//cari wd1
$sql = mysqli_query($dbsurat, "select iddosen from pejabat where level = 2 and kdjurusan = '" . $kdfakultas . "'");
$data3 = mysqli_fetch_row($sql);
$kdwd = $data3[0];



echo "Kode Fakultas = " . $kdfakultas . "<br/>";
echo "Kode Jurusan = " . $kdjurusan . "<br/>";
echo "NIM = " . $nim . "<br/>";
echo "Nama = " . $nama . "<br/>";
echo "Judul Skripsi = " . $judulskripsi . "<br/>";
echo "Hasil cari dosen =" . $hasildosen . "<br/>";
echo "Dosen pembimbing = " . $dosbing . "<br/>";
echo "Kode Dosen = " . $kddosen . "<br/>";
echo "Instansi = " . $instansi . "<br/>";
echo "Alamat = " . $alamat . "<br/>";
echo "Tgl. Pelaksanaan = " . $tglpelaksanaan . "<br/>";
echo "Data = " . $data . "<br/>";

if (
	empty($judulskripsi)
	or empty($instansi)
	or empty($alamat)
	or $hasildosen == 0
	or $tglpelaksanaan == 0
) {
	echo "<script>alert('ERROR!! ada data yang belum terisi, silahkan cek kembali');
		document.location='pengambilandata-isi.php'</script>";
} else {
	$sql = "insert into pengambilandata (kdfakultas,
																				jurusan, 
																				nim, 
																				nama, 
																				judulskripsi, 
																				dosbing,
																				instansi, 
																				alamat,
																				tglpelaksanaan,
																				data,
																				validatordosen,
																				validatorjurusan,
																				validatorfakultas) 
																 values('" . $kdfakultas . "',
																				'" . $jurusan . "',
																				'" . $nim . "',
																				'" . $nama . "',
																				'" . $judulskripsi . "',
																				'" . $dosbing . "',
																				'" . $instansi . "',
																				'" . $alamat . "',
																				'" . $tglpelaksanaan . "',
																				'" . $data . "',
																				'" . $kddosen . "',
																				'" . $kdkajur . "',
																				'" . $kdwd . "')";
	if (mysqli_query($dbsurat, $sql)) {
		echo "data tersimpan";
	} else {
		echo "error " . $mysqli_error($dbsurat);
	}

	mysqli_close($dbsiakad);
	mysqli_close($dbsurat);

	//cari email dosen pembimbing
	$sql5 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$kddosen'");
	$ceksql5 = mysqli_num_rows($sql5);
	if ($ceksql5 > 0) {
		$data5 = mysqli_fetch_array($sql5);
		$emaildosen = $data5['email'];
		$kirimemaildosen = $data5['kirimemail'];
		if ($kirimemaildosen == 1) {
			$subject = "Notifikasi Pengajuan Ijin Pengambilan Data";
			$pesan = "Yth. " . $dosen . "
									<br/>
									<br/>
									Terdapat pengajuan Ijin Pengambilan Data atas nama " . $nama . ".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
			sendmail($emaildosen, $dosen, $subject, $pesan);
		}
	}

	/*
	//cari email user
	$sql4 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$nim'");
	$ceksql4 = mysqli_num_rows($sql4);
	//apabila ada email user
	if ($ceksql4 > 0) {
		$data4 = mysqli_fetch_array($sql4);
		$emailuser = $data4['email'];
		$kirimemailuser = $data4['kirimemail'];
		if ($kirimemailuser > 0) {
			$subject = "Notifikasi Pengajuan Ijin Pengambilan Data";
			$pesan = "Yth. " . $nama . "
									<br/>
									<br/>
									Pengajuan Ijin Pengambilan Data anda sedang menunggu verifikasi dosen pembimbing.
									<br/>
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
			sendmail($emailuser, $nama, $subject, $pesan);
		}
	}
	*/
	header("location:index.php");
}
