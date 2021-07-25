<?php
  require_once('../system/dbconn.php');
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	//echo "Nim = ".$nim."<br/>";
	//echo "Nodata = ".$nodata."<br/>";
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	//echo "Tanggal validasi dosen = ".$tglvaldos."<br/>";

	//update approval dosen
	
  $sql = "UPDATE pengambilandata
					SET validasidosen = 1, 
							tglvalidasidosen = '".$tglvaldos."'
					WHERE id='$nodata' AND nim='$nim'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>