<?php
session_start();
require("../system/dbconn.php");
require("../system/phpmailer/sendmail.php");

$nim = $nim = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

$stmt = $dbsurat->prepare("SELECT * FROM ijinlab WHERE no=?");
$stmt->bind_param("i", $nodata);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$dosen = $dhasil['dosen'];
$namalab = $dhasil['namalab'];
$prodi = $dhasil['prodi'];

//cari nip kalab
$stmt = $dbsurat->prepare("SELECT * FROM laboratorium WHERE namalab=?");
$stmt->bind_param("s", $namalab);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkalab = $dhasil['kalab'];

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

//update pengajuan masukkan data dosen, kaprodi & wd-1
$status = 0;
$stmt = $dbsurat->prepare("UPDATE ijinlab SET tanggal=?, validator0=?,validator1=?, validator2=?, validator3=?,statuspengajuan=? WHERE no=?");
$stmt->bind_param("sssssii", $tanggal, $nipdosen, $nipkalab, $nipkaprodi, $nipwd1, $status, $nodata);
$stmt->execute();

//kirim email ke dosen pembimbing
//cari email dosen dari NIP
$sql3 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip='$nipdosen'");
$dsql3 = mysqli_fetch_array($sql3);
$namadosen = $dsql3['nama'];
$emaildosen = $dsql3['email'];

//kirim email
$surat = 'Ijin Penggunaan Lab.';
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
