<?php
session_start();
require('../system/dbconn.php');
include('../system/phpmailer/sendmail.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);

$sql = mysqli_query($dbsurat, "UPDATE observasi
					SET tglvalidasi2 = '$tgl', 
					validasi2 = '1'
					WHERE no = '$nodata' AND validator2='$nip'");

//kirim email ke wadek1
//cari email wadek dari NIP
$sql2 = mysqli_query($dbsurat, "SELECT * FROM observasi WHERE no='$nodata'");
$dsql2 = mysqli_fetch_array($sql2);
$nama = $dsql2['nama'];
$nipwadek1 = $dsql2['validator3'];
$sql3 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip='$nipwadek1'");
$dsql3 = mysqli_fetch_array($sql3);
$namawadek1 = $dsql3['nama'];
$emailwadek1 = $dsql3['email'];

//kirim email
$surat = 'Ijin Observasi';
$subject = "Pengajuan Surat " . $surat;
$pesan = "Yth. " . $namawadek1 . "<br/>
        <br/>
		Assalamualaikum wr. wb.
        <br />
		<br />
		Dengan hormat,
		<br />
        Terdapat pengajuan surat " . $surat . " atas nama " . $nama . " di sistem SAINTEK Online.<br/>
        Silahkan klik tombol dibawah ini untuk melakukan verifikasi surat di website SAINTEK Online<br/>
        <br/>
        <a href='https://saintek.uin-malang.ac.id/online/' style=' background-color: #0045CE;border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Website</a><br/>
        <br/>
        atau klik URL berikut ini <a href='https://saintek.uin-malang.ac.id/online/'>https://saintek.uin-malang.ac.id/online/</a> apabila tombol diatas tidak berfungsi.<br/>
        <br/>
        Wassalamualaikum wr. wb.
		<br/>
        <br/>
        <b>SAINTEK Online</b>";
sendmail($emailwadek1, $namawadek1, $subject, $pesan);

header("location:index.php");
