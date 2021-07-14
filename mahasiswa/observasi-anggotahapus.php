<?php
	session_start();
  require_once('../system/dbconn.php');
	
	$nim = $_SESSION['id'];
  $nimanggota = mysqli_real_escape_string($dbsurat,$_GET['nimanggota']);
	//echo "NIM Ketua = ".$nim."<br/>";
	//echo "NIM Anggota = ".$nimanggota."<br/>";
	
	$qhapus = mysqli_query($dbsurat,"delete from observasianggota where nimanggota ='$nimanggota'");

	header("location:observasi-isi.php");	
?>