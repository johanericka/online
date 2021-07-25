<?php
session_start();
require('../system/dbconn.php');

$nip = mysqli_real_escape_string($dbsurat, $_SESSION['nip']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['prodi']);
$kemampuankerja = $_POST['kemampuankerja'];
$penguasaanpengetahuan = $_POST['penguasaanpengetahuan'];
$SikapKhusus = $_POST['SikapKhusus'];

date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');

//cari nip kajur
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE prodi=? AND kdjabatan='kajur'");
$stmt->bind_param("s", $prodi);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipkaprodi = $dhasil['nip'];

//cari nip wd-1
$jabatan = 'wakildekan';
$level = 2;
$stmt = $dbsurat->prepare("SELECT * FROM pejabat WHERE kdjabatan=? AND level=?");
$stmt->bind_param("si", $jabatan, $level);
$stmt->execute();
$result = $stmt->get_result();
$dhasil = $result->fetch_assoc();
$nipwd1 = $dhasil['nip'];

//hapus data existing
$qhapus = mysqli_query($dbsurat, "DELETE FROM skpi WHERE nim='$nim'");

foreach ($kemampuankerja as $kerja) {
    $qcpl = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='$kerja' ");
    $data = mysqli_fetch_array($qcpl);
    $cpl = $data[2];
    $indonesia = $data[3];
    $english = $data[4];
    $qsimpan = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$prodi','$cpl','$indonesia','$english',1,'$nip','$tgl','$nipkaprodi','$nipwd1')");
}

foreach ($penguasaanpengetahuan as $pengetahuan) {
    $qcpl2 = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='$pengetahuan' ");
    $data2 = mysqli_fetch_array($qcpl2);
    $cpl = $data2[2];
    $indonesia = $data2[3];
    $english = $data2[4];
    $qsimpan2 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$prodi','$cpl','$indonesia','$english',1,'$nip','$tgl','$nipkaprodi','$nipwd1')");
}

foreach ($SikapKhusus as $khusus) {
    $qcpl3 = mysqli_query($dbsurat, "SELECT * FROM skpi_cpl WHERE no='$khusus' ");
    $data3 = mysqli_fetch_array($qcpl3);
    $cpl = $data3[2];
    $indonesia = $data3[3];
    $english = $data3[4];
    $qsimpan3 = mysqli_query($dbsurat, "INSERT INTO skpi (nim,nama,jurusan,cpl,indonesia,english,verifikasi1,verifikator1,tglverifikasi1,verifikator2,verifikator3) VALUES 
																			('$nim','$nama','$prodi','$cpl','$indonesia','$english',1,'$nip','$tgl','$nipkaprodi','$nipwd1')");
}


//setujui sertifikat
$qsimpan5 = mysqli_query($dbsurat, "UPDATE skpi_prestasipenghargaan 
								    SET verifikasi3=1,
										tglverifikasi3='$tgl'
									WHERE nim='$nim'");

header("location:index.php");
