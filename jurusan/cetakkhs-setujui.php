<?php
  require_once('../system/dbconn.php');
  $nim = mysqli_real_escape_string($dbsurat,$_GET['nim']);
	$nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
	$tglvaljur = date('y-m-d H:i:s', strtotime(now));
  
	echo "ID = ".$nodata."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "Tanggal validasi jurusan = ".$tglvaljur."<br/>";
	
  $sql = "UPDATE cetakkhs 
					SET validasijurusan = 1, 
							tglvalidasijurusan = '$tglvaljur' 
					WHERE nim = '$nim' AND id='$nodata'";
				
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>