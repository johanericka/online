<?php
  require_once('../system/dbconn.php');
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	//echo "Nim = ".$nim."<br/>";
	//echo "Nodata = ".$nodata."<br/>";
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	//echo "Tanggal validasi dosen = ".$tglvaldos."<br/>";

	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = "B-".$nodata.".O/FST.01/TL.00/".$bulan."/".$tahun."";

	//update approval dosen
	
  $sql = "UPDATE pengambilandata
					SET validasifakultas = 1, 
							tglvalidasifakultas = '".$tglvaldos."',
							keterangan = '$nosurat'
					WHERE id='$nodata' AND nim='$nim'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>