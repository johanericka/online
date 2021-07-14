<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $iduser = mysqli_real_escape_string($dbsurat,$_POST['iduser']);
	$nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$tgl = date('y-m-d', strtotime(now));
	
	echo "ID User = ".$iduser."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "Tanggal = ".$tgl."<br/>";
	
	$qsimpan3 = mysqli_query($dbsurat,"UPDATE skpi 
																		SET verifikasi2=1,
																				tglverifikasi2='$tgl'
																		WHERE nim='$nim' and verifikator2='$iduser'");
	
	$qsimpan4 = mysqli_query($dbsurat,"UPDATE skpi_prestasipenghargaan
																		SET verifikasi2=1,
																				tglverifikasi2='$tgl'
																		WHERE nim='$nim' and verifikator2='$iduser'");
	header("location:index.php");
?>