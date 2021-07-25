<?php
  require_once('../system/dbconn.php');
	$iduser = $_POST['iduser'];
	$nama = $_POST['nama'];
  $nip = $_POST['nip'];
	$jabatan = $_POST['jabatan'];
	$jurusan = $_POST['jurusan'];
	$fakultas = $_POST['fakultas'];
	$tglsurat = date('Y-m-d');
	$tgl1 = $_POST['tgl1'];
	$kegiatan1 = mysqli_real_escape_string($dbsurat,$_POST['kegiatan1']);
	$tgl2 = $_POST['tgl2'];
	$kegiatan2 = mysqli_real_escape_string($dbsurat,$_POST['kegiatan2']);
	$tgl3 = $_POST['tgl3'];
	$kegiatan3 = mysqli_real_escape_string($dbsurat,$_POST['kegiatan3']);
	$tgl4 = $_POST['tgl4'];
	$kegiatan4 = mysqli_real_escape_string($dbsurat,$_POST['kegiatan4']);
	$tgl5 = $_POST['tgl5'];
	$kegiatan5 = mysqli_real_escape_string($dbsurat,$_POST['kegiatan5']);
	
  //cari kajur
	//$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 5 and jurusan = '".$jurusan."'"); 
	//$row2 = mysqli_fetch_row($sql2); 
		$kdkajur = '62007';
  
	//cari wd1
	//$sql = mysqli_query($dbsurat,"select iddosen from pejabat where level = 2 and kdjurusan = '".$kdfakultas."'"); 
	//$data = mysqli_fetch_row($sql); 
		$kdwd = '62007';
	
	
	$sql = "insert into wfh (fakultas, jurusan, tglsurat, iduser, nama, nip,jabatan, tglwfh1, kegiatan1, tglwfh2, kegiatan2,tglwfh3, kegiatan3, tglwfh4, kegiatan4,tglwfh5, kegiatan5,verifikatorjurusan, verifikasijurusan, verifikatorfakultas, verifikasifakultas) 
				values ('$fakultas','$jurusan','$tglsurat','$iduser','$nama','$nip','$jabatan','$tgl1','$kegiatan1','$tgl2','$kegiatan2','$tgl3','$kegiatan3','$tgl4','$kegiatan4','$tgl5','$kegiatan5','$kdkajur',0,'$kdwd',0)";

if (mysqli_query($dbsurat, $sql)) {
	echo "data tersimpan";
	header("location:index.php");
} else {
	echo "error " . $mysqli_error($dbsurat);
	//header("location:wfh-isi.php");
}
	
?>