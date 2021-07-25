<?php
  require_once('../system/dbconn.php');
  
	session_start();
	$nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	$koorjurusan = mysqli_real_escape_string($dbsurat,$_POST['koorjurusan']);
	$tglvalkoor = date('y-m-d H:i:s', strtotime(now));
	$tglvalkajur = date('y-m-d H:i:s', strtotime(now));
  $role = mysqli_real_escape_string($dbsurat,$_SESSION['role']);
	
	echo "NIM = ".$nim."<br/>";
	echo "No data = ".$nodata."<br/>";
	echo "Koorjurusan = ".$koorjurusan."<br/>";
	echo "Tanggal validasi koodinator = ".$tglvalkoor."<br/>";
	echo "Tanggal validasi jurusan = ".$tglvalkajur."<br/>";
	echo "Role = ".$role."<br/>";
	
	if ($role == "koorpkl"){
  $sql = "UPDATE pkl 
					SET validasikoordinator = 1, 
							tglvalidasikoordinator = '$tglvalkoor' 
					WHERE nim = '$nim' AND id='$nodata'";
	}else{
		if ($role=="kajur"){
			$sql = "UPDATE pkl 
					SET validasijurusan = 1, 
							tglvalidasijurusan = '$tglvalkoor' 
					WHERE nim = '$nim' AND id='$nodata'";
		}
	}
	
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  echo "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>