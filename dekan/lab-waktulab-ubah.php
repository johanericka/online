<?php
	require_once('../system/dbconn.php');
	 
	$nodata = $_POST['nodata'];
	$tglmulai = $_POST['tglmulai'];
	$tglselesai = $_POST['tglselesai'];
	
	echo "No Data = ".$nodata."<br/>";
	echo "tglmulai = ".$tglmulai."<br/>";
	echo "tglselesai = ".$tglselesai."<br/>";
	
	
	//update waktu penggunaan lab
	$query1 = mysqli_query($dbsurat,"UPDATE ijinlab 
																	SET tglmulai = '$tglmulai',
																			tglselesai = '$tglselesai'
																	WHERE no = '$nodata'");
	header("location:lab-tampil2.php?nodata=$nodata");
	
?>