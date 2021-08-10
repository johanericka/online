<?php
  require_once('../system/dbconn.php');
	
	session_start();
  $nim = mysqli_real_escape_string($dbsurat,$_SESSION['iduser']);
	$kdjurusan = substr($nim,2,2);
	$kdfakultas = substr($nim,2,1);
  $instansi = mysqli_real_escape_string($dbsurat,$_POST['instansi']);
  $alamat = mysqli_real_escape_string($dbsurat,$_POST['alamat']);
  $mulaipkl = mysqli_real_escape_string($dbsurat,$_POST['tglmulai']);
	$selesaipkl = mysqli_real_escape_string($dbsurat,$_POST['tglselesai']);
  $tglmulai = date('y-m-d', strtotime($mulaipkl));
	$tglselesai = date('y-m-d', strtotime($selesaipkl));
	
	//cari jurusan
	$query = mysqli_query($dbsurat,"SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
	$data = mysqli_fetch_array($query);
		$jurusan = $data['jurusan'];
	
	//cari kajur
	$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 5 and jurusan = '$jurusan'"); 
	$row2 = mysqli_fetch_row($sql2); 
	$kdkajur = $row2[0];
	
	//cari sekjur
	$sql3 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 6 and jurusan = '$jurusan'"); 
	$row3 = mysqli_fetch_row($sql3); 
	$kdsekjur = $row3[0];
	
	//cari wd3
	$sql = mysqli_query($dbsurat,"select iddosen from pejabat where level = 4 and jurusan = 'SAINTEK'"); 
	$data = mysqli_fetch_row($sql); 
	$kdwd = $data[0];
	
	/*
	echo "NIM = ".$nim."<br/>";
	echo "Kd. Jurusan = ".$kdjurusan."<br/>";
	echo "Kd. Fakultas = ".$kdfakultas."<br/>";
  echo "Kd. Kajur = ".$kdkajur."<br/>";
  echo "Kd. Sekjur = ".$kdsekjur."<br/>";
  echo "Kd. WD = ".$kdwd."<br/>";
	*/
	
	$query = mysqli_query($dbsurat,"SELECT * FROM pkl where nim = '$nim' and validatorkoor is null");
	$data = mysqli_fetch_array($query);
		$nodata = $data['id'];
	
	$sql = "UPDATE pkl 
					SET validatorkoor = '$kdsekjur',
							validatorjurusan = '$kdkajur',
							validatorfakultas = '$kdwd'
					WHERE nim = '$nim' AND id = '$nodata'";
	
	
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data tersimpan";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	mysqli_close($dbsiakad);
  header("location:index.php");
?>