<?php
	require_once('../system/dbconn.php');
	 
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	$kapasitas = mysqli_real_escape_string($dbsurat,$_POST['kapasitas']);
	
	//update data kapasitas lab 	
	$query1 = mysqli_query($dbsurat,"UPDATE laboratorium SET kapasitas = '$kapasitas'	WHERE no = '$nodata'");
	header("location:lab-cekkapasitas.php");
	
?>