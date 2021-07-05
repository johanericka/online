<?php
  require_once('../system/dbconn.php');
  
	session_start();
	
	$nim = $_POST['nim'];
	$nodata = $_POST['nodata'];
	$koorjurusan = $_POST['koorjurusan'];
	$tglvalkoor = date('y-m-d H:i:s', strtotime(now));
	$tglvalkajur = date('y-m-d H:i:s', strtotime(now));
  $role = $_SESSION['role'];
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = "B-".$nodata.".O/FST.3/PP.06/".$bulan."/".$tahun."";
	
	echo "NIM = ".$nim."<br/>";
	echo "No data = ".$nodata."<br/>";
	echo "Koorjurusan = ".$koorjurusan."<br/>";
	echo "Tanggal validasi koodinator = ".$tglvalkoor."<br/>";
	echo "Tanggal validasi jurusan = ".$tglvalkajur."<br/>";
	echo "Role = ".$role."<br/>";
	
  $sql = "UPDATE pkl 
					SET validasifakultas = 1, 
							tglvalidasifakultas = '$tglvalkoor',
							keterangan = '$nosurat'
					WHERE nim = '$nim' AND id='$nodata'";
	
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  echo "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>