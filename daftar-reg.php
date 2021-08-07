<?php
require('system/dbconn.php');
require('system/phpmailer/sendmail.php');

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nip = mysqli_real_escape_string($dbsurat, $_POST['nip']);
$nohp = mysqli_real_escape_string($dbsurat, $_POST['nohp']);
$email = mysqli_real_escape_string($dbsurat, $_POST['email']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['prodi']);
$fakultas = 'Sains dan Teknologi';
$username = mysqli_real_escape_string($dbsurat, $_POST['username']);
$password = mysqli_real_escape_string($dbsurat, $_POST['password']);
$kunci = mysqli_real_escape_string($dbsurat, $_POST['kunci']);
$jawaban = mysqli_real_escape_string($dbsurat, $_POST['jawaban']);
$token = md5(microtime());

if ($kunci == $jawaban) {
    $stmt = $dbsurat->prepare('SELECT * FROM pengguna WHERE nip=? OR email=? OR user=?');
    $stmt->bind_param('sss', $nip, $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $jhasil = $result->num_rows;
    if ($jhasil > 0) {
        header('location:daftar.php?pesan=registered');
    } else {
        $hakakses = 'mahasiswa';
        $aktif = 0;
        $stmt = $dbsurat->prepare("INSERT INTO pengguna (nama, nip, nohp, email, prodi, fakultas, user, pass,hakakses,token,aktif) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssss", $nama, $nip, $nohp, $email, $prodi, $fakultas, $username, $password, $hakakses, $token, $aktif);
        $stmt->execute();

        //kirim email ke user
        $subject = "Pendaftaran Akun SAINTEK Online";
        $pesan = "Yth. " . $nama . "<br/>
        <br/>
		Assalamualaikum wr. wb.
        <br />
		<br />
		Pendaftaran pengguna pada SAINTEK Online telah berhasil dilakukan.
        <br/>
        Mohon menunggu proses verifikasi akun anda.
		<br />
        Anda akan mendapat email pemberitahuan apabila akun anda sudah aktif dan dapat digunaan.
		<br />
        Silahkan membalas email ini apabila ada pertanyaan terkait proses pendaftaran ini
        <br/>        
        Wassalamualaikum wr. wb.
		<br/>
        <br/>
        <b>SAINTEK Online</b>";
        sendmail($email, $nama, $subject, $pesan);

        /*
        //kirim email admin
        $namaadmin = 'Admin SAINTEK Online';
        $emailadmin = 'saintekonline@gmail.com';
        $subject = "Pendaftaran Akun SAINTEK Online Baru";
        $pesan = "Yth. " . $namaadmin . "<br/>
        <br/>
		Assalamualaikum wr. wb.<br />
		<br />
		Terdapat pendaftaran akun baru di sistem SAINTEK Online.<br/>
        Mohon melakukan verifikasi dan aktivasi terhadap akun tersebut.<br />
        Silahkan klik tombol berikut ini untuk masuk kedalam sistem SAINTEK Online.<br/>
        <a href='https://saintek.uin-malang.ac.id/online/' style=' background-color: #03DF00;border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>SAINTEK Online</a><br/>
        <br/>        
        Wassalamualaikum wr. wb.
		<br/>
        <br/>
        <b>SAINTEK Online</b>";
        sendmail($emailadmin, $namaadmin, $subject, $pesan);
        */
        header("location:index.php?pesan=success");
    }
}
