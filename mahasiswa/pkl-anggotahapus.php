<?php
  require_once('../system/dbconn.php');
	session_start();
	$nim = mysqli_real_escape_string($dbsurat,$_SESSION['iduser']);
  	$nimanggota = mysqli_real_escape_string($dbsurat,$_GET['nimanggota']);
	echo "NIM = ".$nim;
	echo "NIM Anggota = ".$nimanggota;
	
	$qhapus = mysqli_query($dbsurat,"DELETE FROM pklanggota WHERE nimketua = '$nim' AND nimanggota ='$nimanggota'");
	
  header("location:pkl-isi.php");
	
?>