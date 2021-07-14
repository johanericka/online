<?php
	session_start();
  require_once('../system/dbconn.php');
	$nodata=mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	$nim=mysqli_real_escape_string($dbsurat,$_POST['nim']);
  
	$sql = "DELETE FROM skpi_prestasipenghargaan 
					WHERE nim='".$nim."' AND no='".$nodata."'";
	if (mysqli_query($dbsurat,$sql)) {
		echo "data terhapus";
			header("location:skpi-tampil.php?nim=$nim");
	}else {
		echo "error ".$mysqli_error($dbsurat);
		//header("location:index.php");
	}	
?>