<?php
	require_once('../system/dbconn.php');
	
	session_start();
	
	$nodata = $_POST['nodata']; 	
	$nim = $_POST['nim'];
	$tgl = date('y-m-d H:i:s', strtotime(now));
	$keterangan = mysqli_real_escape_string($dbsurat,$_POST['keterangan']);
	$role = $_SESSION['role'];
	
	echo "NO Data = ".$nodata."<br/>";;
	echo "Tanggal =".$tgl."<br/>";
	echo "Keterangan = ".$keterangan."<br/>";
	
	if (!empty($keterangan)){
			$sql = "UPDATE pkl
							SET tglvalidasifakultas = '$tgl', 
									validasifakultas = 2,
									keterangan = '$keterangan'
									WHERE nim = '$nim' AND id = '$nodata'";
							
		if (mysqli_query($dbsurat,$sql)) {
			echo "data terupdate";
		}else {
			"error ".$mysqli_error($dbsurat);
		}
		
		mysqli_close($dbsurat);
		
		header("location:index.php");
	}else{
		echo "Keterangan kosong";
		header("location:pkl-tampil.php?nodata=$nodata&respon=kosong");
	}

?>