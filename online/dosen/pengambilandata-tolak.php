<?php
  require_once('../system/dbconn.php');
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	$keterangan = mysqli_real_escape_string($dbsurat,$_POST['keterangan']);
	/*
	echo "Nim = ".$nim."<br/>";
	echo "Nodata = ".$nodata."<br/>";
	echo "Keterangan = ".$keterangan."<br/>";
	*/
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	echo "Tanggal validasi dosen = ".$tglvaldos."<br/>";

	//update approval dosen
	
	if (!empty($keterangan)){
		$sql = "UPDATE pengambilandata
						SET validasidosen = 2, 
								tglvalidasidosen = '$tglvaldos',
								keterangan = '$keterangan'
						WHERE id='$nodata' AND nim='$nim'";
						
		if (mysqli_query($dbsurat,$sql)) {
			echo "data terupdate";
		}else {
			"error ".$mysqli_error($dbsurat);
		}
		
		mysqli_close($dbsurat);
		
		header("location:index.php");
	}else{
		echo "Keterangan kosong";
		header("location:pengambilandata-tampil.php?nodata=$nodata&respon=kosong");
	}
	
?>