<?php
	session_start();
  require_once('../system/dbconn.php');
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  
	$sql = "DELETE FROM skpi_prestasipenghargaan WHERE no='".$nodata."'";
	if (mysqli_query($dbsurat,$sql)) {
		echo "data terhapus";
			header("location:skpi-isi.php");
	}else {
		echo "error ".$mysqli_error($dbsurat);
		//header("location:index.php");
	}	
?>