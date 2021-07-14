<?php
	session_start();
	if($_SESSION['role']!="mahasiswa"){
		header("location:../index.php?pesan=noaccess");
	}
	
  require_once('../system/dbconn.php');
	
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
	$nim=$_SESSION['nim'];
  
	$query3 = mysqli_query($dbsurat,"DELETE FROM suket WHERE id = '$nodata'");
		
	unlink($namafile);
	$query5 = mysqli_query($dbsurat,"DELETE FROM upload WHERE nodata = '$nodata' AND nim = '$nim'");
	
	
	mysqli_close($dbsiakad);
	mysqli_close($dbsurat);
	
	header("location:index.php");
?>