<?php
  require_once('../system/dbconn.php');
  $nim = $_GET['nim'];
	$nodata = $_GET['nodata'];
	$tglvaljur = date('y-m-d H:i:s', strtotime(now));
  
	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = "B-".$nodata.".O/FST.1/KM.01.7/".$bulan."/".$tahun."";
	
	echo "ID = ".$nodata."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "Tanggal validasi jurusan = ".$tglvaljur."<br/>";
	
  $sql = "UPDATE cetakkhs 
					SET validasifakultas = 1, 
							tglvalidasifakultas = '$tglvaljur',
							keterangan = '$nosurat'
					WHERE nim = '$nim' AND id='$nodata'";
				
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>