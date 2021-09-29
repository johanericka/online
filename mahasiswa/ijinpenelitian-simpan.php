<?php
session_start();
require('../system/dbconn.php');
include('../system/phpmailer/sendmail.php');

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

$nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nama = mysqli_real_escape_string($dbsurat, $_SESSION['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_SESSION['prodi']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);
$judulskripsi = mysqli_real_escape_string($dbsurat, $_POST['judulskripsi']);
$instansi = mysqli_real_escape_string($dbsurat, $_POST['instansi']);
$alamat = mysqli_real_escape_string($dbsurat, $_POST['alamat']);
$tglmulai = $_POST['tglmulai'];
$tglselesai = $_POST['tglselesai'];

//hitung jumlah hari
/*
$jmlhari = (strtotime($tglselesai) - strtotime($tglmulai)) / 60 / 60 / 24;
if ($jmlhari > 30) {
    $tglselesai = date('Y-m-d', strtotime($tglmulai . " +1 month"));
}
*/

//cari nip dosen
$stmt = $dbsurat->prepare("SELECT * FROM pengguna WHERE nama=?");
$stmt->bind_param("s", $dosen);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipdosen = $dhasil['nip'];

//cari nip kajur
$kdjabatan = 'kaprodi';
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan=?");
$stmt->bind_param("ss", $prodi, $kdjabatan);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkaprodi = $dhasil['nip'];

//cari nip wd-1
$jabatan = 'wadek1';
$level = 2;
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=?");
$stmt->bind_param("s", $jabatan);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd1 = $dhasil['nip'];

//masukin data
$stmt = $dbsurat->prepare("INSERT INTO ijinpenelitian (tanggal, nim, nama, prodi, judulskripsi, dosen, instansi, alamat, tglmulai, tglselesai, validator1, validator2, validator3) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("sssssssssssss", $tanggal, $nim, $nama, $prodi, $judulskripsi, $dosen, $instansi, $alamat, $tglmulai, $tglselesai, $nipdosen, $nipkaprodi, $nipwd1);
$stmt->execute();

//kirim email ke dosen pembimbing
//cari email dosen dari NIP
$sql3 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip='$nipdosen'");
$dsql3 = mysqli_fetch_array($sql3);
$namadosen = $dsql3['nama'];
$emaildosen = $dsql3['email'];

//kirim email
$surat = 'Ijin Penelitian';
$subject = "Pengajuan Surat " . $surat . "";
$pesan = "Yth. " . $namadosen . "<br/>
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
sendmail($emaildosen, $namadosen, $subject, $pesan);

header("location:index.php");
