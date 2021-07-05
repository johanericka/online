<?php
	require_once('../system/dbconn.php');
	
	$nim = mysqli_real_escape_string($dbsurat,$_GET['nim']);
	$nodata = mysqli_real_escape_string($dbsurat,$_GET['nodata']);
	$tglvaljur = date('y-m-d H:i:s', strtotime(now));
  $keterangan = mysqli_real_escape_string($dbsurat,$_GET['keterangan']);
	echo "ID = ".$nodata."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "Tanggal validasi jurusan = ".$tglvaljur."<br/>";
	echo "Keterangan = ".$keterangan."<br/>";
	
	
	if (!empty($keterangan)){
		$sql = "UPDATE cetakkhs
						SET tglvalidasijurusan = '$tglvaljur', 
						validasijurusan = 2,
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
		header("location:cetakkhs-tampil.php?nodata=$nodata&respon=kosong");
	}
	
?>