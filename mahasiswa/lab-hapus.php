<?php
	
  require_once('../system/dbconn.php');
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE no='$nodata'");
	$data = mysqli_fetch_array($query);
		$namalab = $data['namalab'];
	
	$sql3 = mysqli_query($dbsurat,"UPDATE laboratorium	SET kapasitas = kapasitas + 1 WHERE namalab = '$namalab'");
	
	$sql = mysqli_query($dbsurat,"DELETE FROM ijinlab WHERE no='$nodata'");
	
	$query4 = mysqli_query($dbsurat,"SELECT * FROM upload WHERE nodata = '$nodata'");
	$data = mysqli_fetch_array($query4);
		$namafile = $data['namafile'];
	unlink($namafile);
	
	$sql2 = mysqli_query($dbsurat,"DELETE FROM upload WHERE nodata='$nodata'");
	
	mysqli_close($dbsurat);
	header("location:index.php");
?>