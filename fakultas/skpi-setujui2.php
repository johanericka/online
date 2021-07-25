<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$iduser = mysqli_real_escape_string($dbsurat, $_POST['iduser']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$tgl = date('y-m-d');

echo "ID User = " . $iduser . "<br/>";
echo "NIM = " . $nim . "<br/>";
echo "Tanggal = " . $tgl . "<br/>";

$qsimpan3 = mysqli_query($dbsurat, "UPDATE skpi 
																		SET verifikasi3=1,
																				tglverifikasi3='$tgl'
																		WHERE nim='$nim' and verifikator3='$iduser'");

$qsimpan4 = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan
																		SET verifikasi3=1,
																				tglverifikasi3='$tgl'
																		WHERE nim='$nim' and verifikator3='$iduser'");

//deteksi jurusan mahasiswa
if (strlen($nim) == 8) {
	$kdjurusan = substr($nim, 2, 2);
} else {
	$kdjurusan = substr($nim, 2, 5);
}

//dapatkan jurusan mahasiswa
$sql2 = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
$data2 = mysqli_fetch_array($sql2);
$jurusan = $data2['jurusan'];

//dapatkan nama mahasiswa
$sql4 = mysqli_query($dbsurat, "SELECT * FROM useraccount2 WHERE kode = '$nim'");
$data4 = mysqli_fetch_array($sql4);
$namamhs = $data4['nama'];

//dapatkan admin
$sql3 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE jurusan = '$jurusan'");
$data3 = mysqli_fetch_array($sql3);
$username = $data3['username'];
$nama = $data3['nama'];

//cari email WD-1
$sql3 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$username'");
$ceksql3 = mysqli_num_rows($sql3);
if ($ceksql3 > 0) {
	$data3 = mysqli_fetch_array($sql3);
	$email = $data3['email'];
	$kirimemail = $data3['kirimemail'];

	if ($kirimemail > 0) {
		$subject = "Notifikasi Pengajuan Surat Keterangan Pendamping Ijazah";
		$pesan = "Yth. " . $nama . "
								<br/>
								<br/>
								Terdapat pengajuan <b>Surat Keterangan Pendamping Ijazah</b> atas nama " . $namamhs . ".
								<br/>
								Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
								<br/>
								<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";

		//kirim email
		sendmail($email, $nama, $subject, $pesan);
	}
}

header("location:index.php");
