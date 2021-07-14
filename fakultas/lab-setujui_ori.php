<?php
	require_once('../system/dbconn.php');
	$nodata = $_GET['nodata']; 	
	echo "NO Data = ".$nodata;
	$tgl = date('Y-m-d');
	
	$sql = "UPDATE ijinlab
					SET tglvalidasifakultas = '".$tgl."', 
					validasifakultas = '1'
					WHERE no = '".$nodata."'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
?>