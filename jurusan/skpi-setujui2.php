<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$iduser = mysqli_real_escape_string($dbsurat, $_POST['iduser']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$kemampuankerja = $_POST['kemampuankerja'];
$penguasaanpengetahuan = $_POST['penguasaanpengetahuan'];
$SikapKhusus = $_POST['SikapKhusus'];
$opsicpl = $_POST['cpl'];
$kemampuantambahan_ind = mysqli_real_escape_string($dbsurat, $_POST['kemampuantambahan_ind']);
$kemampuantambahan_eng = mysqli_real_escape_string($dbsurat, $_POST['kemampuantambahan_eng']);
$tglvaldos = date('y-m-d');

//cek data di skpi_prestasipenghargaan
$qprestasi = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan
									SET verifikasi2=1,
										tglverifikasi2='$tglvaldos'
									WHERE nim='$nim' and verifikator2='$iduser'");

//dosen pembimbing
$qdosenpa = mysqli_query($dbsurat, "SELECT * FROM skpi_prestasipenghargaan WHERE nim='$nim'");
$ddosenpa = mysqli_fetch_array($qdosenpa);
$kddosen = $ddosenpa['verifikator1'];
//echo "Kode Dosen = " . $kddosen . "<br/>";

//cari kajur
$sql2 = mysqli_query($dbsurat, "SELECT iddosen FROM pejabat WHERE level = 5 AND jurusan = '$jurusan'");
$row2 = mysqli_fetch_row($sql2);
$kdkajur = $row2[0];
//echo "Kode Kajur = " . $kdkajur . "<br/>";

//cari wd1
$sql = mysqli_query($dbsurat, "SELECT * FROM pejabat WHERE level = 2 AND jurusan = 'SAINTEK'");
$data = mysqli_fetch_array($sql);
$kdwd = $data['iddosen'];
$namawd = $data['nama'];
echo "Kode WD = " . $kdwd . "<br/>";

//hapus data existing
$qhapus = mysqli_query($dbsurat, "DELETE FROM skpi WHERE nim='$nim'");

foreach ($kemampuankerja as $kerja) {
	$qcpl = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='$kerja'");
	$data = mysqli_fetch_array($qcpl);
	$cpl = $data['cpl'];
	$indonesia = $data['indonesia'];
	$english = $data['english'];

	$qsimpan = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikasi2,tglverifikasi2,verifikator3) VALUES 
														('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tglvaldos','$kdkajur',1,'$tglvaldos','$kdwd')");
}

foreach ($penguasaanpengetahuan as $pengetahuan) {
	$qcpl2 = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='$pengetahuan'");
	$data2 = mysqli_fetch_array($qcpl2);
	$cpl = $data2['cpl'];
	$indonesia = $data2['indonesia'];
	$english = $data2['english'];

	$qsimpan2 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikasi2,tglverifikasi2,verifikator3) VALUES 
														('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tglvaldos','$kdkajur',1,'$tglvaldos','$kdwd')");
}

foreach ($SikapKhusus as $khusus) {
	$qcpl3 = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='$khusus'");
	$data3 = mysqli_fetch_array($qcpl3);
	$cpl = $data3['cpl'];
	$indonesia = $data3['indonesia'];
	$english = $data3['english'];

	$qsimpan3 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikasi2,tglverifikasi2,verifikator3) VALUES 
														('$nim','$nama','$jurusan','$cpl','$indonesia','$english',1,'$kddosen','$tglvaldos','$kdkajur',1,'$tglvaldos','$kdwd')");
}

//kemampuan tambahan
if (!empty($kemampuantambahan_ind) and !empty($kemampuantambahan_eng)) {
	$qsimpan4 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikasi2,tglverifiaksi2,verifikator3) VALUES 
														('$nim','$nama','$jurusan','$opsicpl','$kemampuantambahan_ind','$kemampuantambahan_eng',1,'$kddosen','$tglvaldos','$kdkajur',1,'$tglvaldos','$kdwd')");
}

//cari email WD-1
$sql3 = mysqli_query($dbsurat, "SELECT * FROM notifikasi WHERE iduser = '$kdwd'");
$ceksql3 = mysqli_num_rows($sql3);
if ($ceksql3 > 0) {
	$data3 = mysqli_fetch_array($sql3);
	$email = $data3['email'];
	$kirimemail = $data3['kirimemail'];

	if ($kirimemail > 0) {
		$subject = "Notifikasi Pengajuan Surat Keterangan Pendamping Ijazah";
		$pesan = "Yth. " . $namawd . "
								<br/>
								<br/>
								Terdapat pengajuan <b>Surat Keterangan Pendamping Ijazah</b> atas nama " . $nama . ".
								<br/>
								Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
								<br/>
								<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";

		//kirim email
		sendmail($email, $nama, $subject, $pesan);
	}
}

//kembali ke dashboard
header("location:index.php");
