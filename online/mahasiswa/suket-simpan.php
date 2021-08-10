<?php
session_start();
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$jenissurat = mysqli_real_escape_string($dbsurat, $_POST['jenissurat']);
$keperluan = mysqli_real_escape_string($dbsurat, $_POST['keperluan']);

//cari nip kajur
$jabatan = 'kaprodi';
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan='$jabatan'");
$stmt->bind_param("s", $prodi);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkaprodi = $dhasil['nip'];

//cari nip wd-1
$jabatan = 'wadek1';
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=?");
$stmt->bind_param("s", $jabatan);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd = $dhasil['nip'];
$statussurat = '-1';
//masukin data
$stmt = $dbsurat->prepare("INSERT INTO suket (tanggal, nim, nama, prodi, jenissurat, keperluan, validator2, validator3,statussurat) VALUES (?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssi", $tanggal, $nim, $nama, $prodi, $jenissurat, $keperluan, $nipkaprodi, $nipwd, $statussurat);
$stmt->execute();

/*
if (mysqli_query($dbsurat, $sql)) {
	//kirim email
	$sql3 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$kddosen'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0) {
		$data3 = mysqli_fetch_array($sql3);
		$email = $data3['email'];
		$kirimemail = $data3['kirimemail'];

		if ($kirimemail > 0) {
			$subject = "Notifikasi Pengajuan Surat Keterangan / Rekomendasi";
			$pesan = "Yth. " . $namadosen . "
										<br/>
										<br/>
										Terdapat pengajuan " . $jenissurat . " atas nama " . $nama . " pada tanggal " . tgl_indo($tglsurat) . ".
										<br/>
										Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
										<br/>
										<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";

			//kirim email
			sendmail($email, $nama, $subject, $pesan);
		}
	}

	mysqli_close($dbsurat);
	mysqli_close($dbsiakad);
	
} else {
	//header("location:suket-isi.php");
	echo mysqli_error($dbsurat);
}
*/
header('location:suket-isilampiran.php');
