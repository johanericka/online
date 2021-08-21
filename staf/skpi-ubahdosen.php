<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['prodi']);
$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);

if (empty($dosen)) {
	header("location:skpi-rekap.php?pesan=gagal");
}

//cari kode dosen dari nama dosen
$sql1 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nama = '$dosen'");
if (mysqli_num_rows($sql1) == 0) {
	header("location:skpi-rekap.php?pesan=gagal");
} else {
	$row = mysqli_fetch_array($sql1);
	$nipdosen = $row['nip'];
};

//cari kajur
echo $prodi;
$sql2 = mysqli_query($dbsurat, "SELECT * FROM pejabat WHERE prodi = '$prodi' AND kdjabatan='kaprodi'");
$row2 = mysqli_fetch_array($sql2);
$nipkajur = $row2['nip'];

//cari wd1
$sql = mysqli_query($dbsurat, "SELECT * from pejabat WHERE kdjabatan = 'wadek1'");
$data = mysqli_fetch_array($sql);
$nipwd = $data['nip'];
/*
	echo "Nama = ".$nama."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "jurusan = ".$jurusan."<br/>";
	echo "dosen = ".$dosen."<br/>";
	echo "KD Dosen = ".$kddosen."<br/>";
	echo "KD Kajur = ".$kdkajur."<br/>";
	echo "KD WD = ".$kdwd."<br/>";
	*/

$qcari = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim'");
$cekdata = mysqli_num_rows($qcari);
if ($cekdata > 0) {
	$qsimpan = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan SET 
																		verifikator1='$nipdosen',
																		verifikator2='$nipkajur',
																		verifikator3='$nipwd'
																		WHERE nim='$nim'");

	//cari email dosen wali
	$sql3 = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nip = '$nipdosen'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0) {
		$data3 = mysqli_fetch_array($sql3);
		$email = $data3['email'];

		$subject = "Pengajuan Surat Keterangan Pendamping Ijazah";
		$pesan = "Yth. " . $dosen . "
									<br/>
									Assalamualaikum wr. wb.
									<br/>
									Terdapat pengajuan <b>Surat Keterangan Pendamping Ijazah</b> atas nama " . $nama . ".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									Wassalamualaikum wr. wb.";

		//kirim email
		sendmail($email, $nama, $subject, $pesan);
	}
}
header("location:skpi-rekap.php");
