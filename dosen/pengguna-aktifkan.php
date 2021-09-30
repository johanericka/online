<?php
session_start();
require('../system/dbconn.php');
require('../system/phpmailer/sendmail.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$emailmhs = mysqli_real_escape_string($dbsurat, $_POST['email']);
$namamhs = mysqli_real_escape_string($dbsurat, $_POST['namamhs']);

//update status pengguna
$sql = mysqli_query($dbsurat, "UPDATE pengguna
					SET aktif = '1' 
					WHERE no = '$nodata'");

//kirim email
$subject = 'Aktivasi Akun SAINTEK Online';
$pesan = "Yth. " . $namamhs . "<br/>
        <br/>
		Assalamualaikum wr. wb.
        <br />
		<br />
		Dengan hormat,
		<br />
        Akun anda di SAINTEK Online telah diaktifkan.<br/>
        Silahkan klik tombol dibawah ini untuk mengakses sistem SAINTEK Online<br/>
        <br/>
        <a href='http://saintek.uin-malang.ac.id/online' style=' background-color: #0045CE;border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Website SAINTEK Online</a><br/>
        <br/>
        atau silahkan klik link ini <a href='https://saintek.uin-malang.ac.id/online/'>https://saintek.uin-malang.ac.id/online/</a> apabila tombol diatas tidak berfungsi.<br/>
        <br/>
        Wassalamualaikum wr. wb.
		<br/>
        <br/>
        <b>SAINTEK Online</b>";
sendmail($emailmhs, $namamhs, $subject, $pesan);

header("location:index.php");
