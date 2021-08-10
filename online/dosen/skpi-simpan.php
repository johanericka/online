<?php
	require_once('../system/dbconn.php');
	
	$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
	$cpl = mysqli_real_escape_string($dbsurat, $_POST['cpl']);
	$indonesia = mysqli_real_escape_string($dbsurat, $_POST['indonesia']);
	$english = mysqli_real_escape_string($dbsurat, $_POST['english']);
	$default = $_POST['default'];
	echo $indonesia."<br/>";
	echo $english."<br/>";
	echo $default."<br/>";
	
	if ($default==1){
		$def=1;
	}else{
		$def=0;
	}
	
	
	if(empty($indonesia) OR empty($english)){
		header("location:skpi-isi.php?pesan=gagal");
	}else{
		$qsimpan = mysqli_query($dbsurat,"INSERT INTO skpi_cpl (jurusan, cpl, indonesia, english,def) VALUES ('$jurusan','$cpl','$indonesia','$english',$def)");

		if ($qsimpan){
			header("location:skpi-isi.php");
		}else {
			echo "error " . mysqli_error($dbsurat);
		}	
	}
	
?>
