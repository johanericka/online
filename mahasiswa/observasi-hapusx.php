<?php
	
  require_once('../system/dbconn.php');
	
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  
	$query = mysqli_query($dbsurat,"SELECT * FROM observasi WHERE id='$nodata'");
	$data = mysqli_fetch_array($query);
		$nimketua = $data['nim'];
	//hapus anggota
	$sql = mysqli_query($dbsurat,"DELETE FROM observasianggota WHERE nimketua='$nimketua'");
	//hapus ketua
	$sql2 = mysqli_query($dbsurat,"DELETE FROM observasi WHERE id='$nodata'");
	
	mysqli_close($dbsurat);
	header("location:index.php");
?>