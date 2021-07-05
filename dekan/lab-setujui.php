<?php
	require_once('../system/dbconn.php');
	$nodata = $_GET['nodata']; 	
	echo "NO Data = ".$nodata;
	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = $nodata.".O/FST/PP.00.9/".$bulan."/".$tahun."";
	
	$sql = "UPDATE ijinlab
					SET tglvalidasifakultas = '".$tgl."', 
					validasifakultas = '1',
					keterangan = '$nosurat'
					WHERE no = '".$nodata."'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
?>