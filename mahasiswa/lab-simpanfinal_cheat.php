<?php
	require_once('../system/dbconn.php');
	
	session_start();
	$nim = $_SESSION['nim'];
	
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE nim ='$nim' AND keterangan IS NULL");
	$data = mysqli_fetch_array($query);
		$nodata = $data['no'];
		$tgl = $data['tglmulai'];
	
	$bulan = date('m', strtotime($tgl));
	$tahun = date('Y', strtotime($tgl));
	$nosurat = "B-".$nodata.".O/FST/PP.00.9/".$bulan."/".$tahun."";
	
	//update validasi dosen
	$sql = "UPDATE ijinlab
					SET keterangan = '$nosurat'
					WHERE no = '".$nodata."'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
?>