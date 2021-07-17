<?php
require('../system/dbconn.php');
require('../system/phpmailer/sendmail.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['prodi']);
$keterangan = mysqli_real_escape_string($dbsurat, $_POST['keterangan']);

//update status validasi dosen pembimbing
$sql = mysqli_query($dbsurat, "UPDATE ijinlab
					SET tglvalidasi3 = '$tgl', 
					validasi3 = '2',
                    keterangan='$keterangan',
                    statuspengajuan=2
					WHERE no = '$nodata'");

//cari email mahasiswa
$sql4 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE nip = '$nim'");
$ceksql4 = mysqli_num_rows($sql4);
//apabila ada email user
if ($ceksql4 > 0) {
	$data4 = mysqli_fetch_array($sql4);
	$emailmhs = $data4['email'];
	$kirimemailmhs = $data4['kirimemail'];
	//apabila status kirim email = 1
	if ($kirimemailmhs == 1) {
		$subjectmhs = "Notifikasi Pengajuan Ijin Penggunaan Laboratorium";
		$pesanmhs = "Yth. " . $nama . "
								<br/>
								<br/>
								Pengajuan Ijin Penggunaan Laboratorium anda <b>DITOLAK</b> oleh Wakil Dekan Bidang akademik dengan alasan <b><i>" . $keterangan . "</i></b>
								<br/>
								Silahkan lakukan pengajuan ulang dengan memperhatikan alasan penolakan.
								<br/>
								<br/>
								Klik pada tombol di bawah ini untuk mengakses sistem SAINTEK Online
								<br/>
								<a href='https://saintek.uin-malang.ac.id/online' style=' background-color: #4CAF50;border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Masuk</a><br/>
                        		<br/>
                        		atau klik URL ini apabila tombol diatas tidak berfungsi <a href='https://saintek.uin-malang.ac.id/online'>https://saintek.uin-malang.ac.id/online</a>
                        		<br/>
								<br/>
								<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
		//kirim email
		sendmail($emailmhs, $nama, $subjectmhs, $pesanmhs);
	}
}

header("location:index.php");
