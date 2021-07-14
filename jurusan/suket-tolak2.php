<?php
	require_once('../system/dbconn.php');
	
	$nim = $_POST['nim'];
	$nodata = $_POST['nodata'];
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
  $keterangan = mysqli_real_escape_string($dbsurat,$_POST['keterangan']);
	
	/*
	echo $nim."<br/>";
	echo $nodata."<br/>";
	echo $tglvaldos."<br/>";
	echo $keterangan."<br/>";
	*/
	
	if (!empty($keterangan)){
		$sql = "UPDATE suket
						SET tglvalidasidosen = '$tglvaldos', 
						validasidosen = 2,
						keterangan = '$keterangan'
						WHERE id = '$nodata' AND nim = '$nim'";
						
		if (mysqli_query($dbsurat,$sql)) {
			echo "data terupdate";
		}else {
			"error ".$mysqli_error($dbsurat);
		}

		mysqli_close($dbsurat);
		
		header("location:index.php");
	}else{
		echo "Keterangan kosong";
		header("location:suket-tampil.php?nodata=$nodata&respon=kosong");
	}
?>