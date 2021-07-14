<?php
  require_once('../system/dbconn.php');
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  
	//hapus
	$sql2 = mysqli_query($dbsurat,"DELETE FROM peminjamanalat WHERE id='$nodata'");
	
	mysqli_close($dbsurat);
	header("location:index.php");
?>