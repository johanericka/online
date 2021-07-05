<?php
  require_once('../system/dbconn.php');
	$id = mysqli_real_escape_string($dbsurat,$_SESSION['iduser']);
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$kdjurusan = mysqli_real_escape_string($dbsurat,substr($nim,2,2));
	$kdfakultas = mysqli_real_escape_string($dbsurat,substr($nim,2,1));
  $nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
  $jurusan = mysqli_real_escape_string($dbsurat,$_POST['jurusan']);
  $semester = mysqli_real_escape_string($dbsurat,$_POST['semester']);
  $tahunakademik = mysqli_real_escape_string($dbsurat,$_POST['tahunakademik']);
  $keperluan = mysqli_real_escape_string($dbsurat,$_POST['keperluan']);
  $alasan = mysqli_real_escape_string($dbsurat,$_POST['alasan']);
  $alasanbelumdiambil = mysqli_real_escape_string($dbsurat,$_POST['alasanbelumdiambil']);
	
	//cari kajur
	$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 5 and jurusan = '$jurusan'"); 
	$row2 = mysqli_fetch_row($sql2); 
	$kdkajur = $row2[0];
	
	//cari wd1
	$sql = mysqli_query($dbsurat,"select iddosen from pejabat where level = 2 and jurusan = 'SAINTEK'"); 
	$data = mysqli_fetch_row($sql); 
	$kdwd = $data[0];
  
	if (empty($keperluan) OR empty($alasanbelumdiambil) 
			){
		echo "<script>alert('ERROR!! ada data yang belum terisi, silahkan cek kembali');
		document.location='cetakkhs-isi.php'</script>";		
	}else{
		$sql = "insert into cetakkhs (
																	kdfakultas, 
																	kdjurusan, 
																	nim, 
																	nama, 
																	jurusan, 
																	semester, 
																	tahunakademik, 
																	keperluan, 
																	alasan, 
																	alasanbelumdiambil,
																	validatorjurusan, 
																	validatorfakultas) 
													 values('".$kdfakultas."',
																	'".$kdjurusan."',
																	'".$nim."',
																	'".$nama."',
																	'".$jurusan."',
																	'".$semester."',
																	'".$tahunakademik."',
																	'".$keperluan."',
																	'".$alasan."',
																	'".$alasanbelumdiambil."',
																	'".$kdkajur."',
																	'".$kdwd."')";
		
		if (mysqli_query($dbsurat,$sql)) {
			echo "data tersimpan";
		}else {
			"error ".$mysqli_error($dbsurat);
		}
		mysqli_close($dbsiakad);
		mysqli_close($dbsurat);
		header("location:index.php");
	}
	
?>