<?php
	
  require_once('../system/dbconn.php');
	
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  
	//hapus data
	$sql2 = mysqli_query($dbsurat,"DELETE FROM cetakkhs WHERE id='$nodata'");
	
	mysqli_close($dbsurat);
	header("location:index.php");
?>