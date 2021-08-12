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

//cek kapasitas lab
$sql3 = mysqli_query($dbsurat, "SELECT * FROM laboratorium WHERE namalab='$namalab'");
$dlab = mysqli_fetch_array($sql3);
$kapasitas = $dlab['kapasitas'];
if ($kapasitas > 0) {

	//update status validasi dosen pembimbing
	$sql = mysqli_query($dbsurat, "UPDATE ijinlab
					SET tglvalidasi0 = '$tgl', 
					validasi0 = '1'
					WHERE no = '$nodata'");

	//kirim email ke kalab
	//cari email kalab dari NIP
	$sql2 = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE no='$nodata'");
	$dsql2 = mysqli_fetch_array($sql2);
	$nama = $dsql2['nama'];
	$nipkalab = $dsql2['validator1'];
	$sql3 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip='$nipkalab'");
	$dsql3 = mysqli_fetch_array($sql3);
	$namakalab = $dsql3['nama'];
	$emailkalab = $dsql3['email'];

	//kirim email
	$surat = 'Ijin Penggunaan Lab.';
	$subject = "Pengajuan Surat " . $surat;
	$pesan = "Yth. " . $namakalab . "<br/>
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
	sendmail($emailkalab, $namakalab, $subject, $pesan);

	header("location:index.php");
} else {
	header("location:ijinlab-dosbing-tampil.php?nodata=$nodata&pesan=penuh");
}
