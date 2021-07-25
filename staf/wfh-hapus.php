<?php
	session_start();
  require_once('../system/dbconn.php');
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  
	$sql = "DELETE FROM wfh WHERE no='".$nodata."'";
	if (mysqli_query($dbsurat,$sql)) {
		echo "data terhapus";
			mysqli_close($dbsiakad);
			mysqli_close($dbsurat);
			header("location:index.php");
	}else {
		"error ".$mysqli_error($dbsurat);
		header("location:index.php");
	}	
?>