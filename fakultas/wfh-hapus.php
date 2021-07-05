<?php
	session_start();
	if($_SESSION['role']!="wakildekan"){
		header("location:../login.php?pesan=belum_login");
	}
	
  require_once('../system/dbconn.php');
	$nodata=$_GET['nodata'];
  
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