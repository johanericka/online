<?php
	require_once('../system/dbconn.php');
	$nodata = $_GET['nodata']; 	
	$tgl = date('Y-m-d');
	$keterangan = mysqli_real_escape_string($dbsurat,$_GET['keterangan']);
	echo "NO Data = ".$nodata."<br/>";;
	echo "Tanggal =".$tgl."<br/>";
	echo "Keterangan = ".$keterangan."<br/>";
	
	if (!empty($keterangan)){
		$sql = "UPDATE ijinlab
						SET tglvalidasifakultas = '".$tgl."', 
						validasifakultas = '2',
						keterangan = '".$keterangan."'
						where no = '".$nodata."'";
						
		if (mysqli_query($dbsurat,$sql)) {
			echo "data terupdate";
		}else {
			"error ".$mysqli_error($dbsurat);
		}
		
		mysqli_close($dbsurat);
		
		header("location:index.php");
	}else{
		echo "Keterangan kosong";
		header("location:lab-tampil.php?nodata=$nodata&respon=kosong");
	}
	
?>