<?php
	require_once('../system/dbconn.php');
	
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	$def = $_POST['def'];
	echo "No. Data = ".$nodata."<br/>";
	//echo "Centang = ".$def."<br/>";
	
	if ($def==1){
		$defx = 1;
	}else{
		$defx = 0;
	}
	echo "Defx = ".$defx;
	
	$qupdate = mysqli_query($dbsurat,"UPDATE skpi_cpl 
																		SET def='".$defx."'
																		WHERE no='".$nodata."'");

		header("location:skpi-isi.php");	
?>
