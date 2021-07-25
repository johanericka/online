<?php
	session_start();
	if($_SESSION['role']!="mahasiswa"){
		header("location:../index.php?pesan=noaccess");
	}
	
  require_once('../system/dbconn.php');
	
	$nodata=mysqli_real_escape_string($dbsurat,$_GET['nodata']);
  echo "NO DATA = ".$nodata;
	
	$query = mysqli_query($dbsurat,"SELECT * FROM pkl WHERE id='$nodata'");
	$data = mysqli_fetch_array($query);
		$nim = $data['nim'];
		echo "NIM = ".$nim;
	$query2 = mysqli_query($dbsurat,"DELETE FROM pklanggota WHERE nimketua = '$nim'");
	$query3 = mysqli_query($dbsurat,"DELETE FROM pkl WHERE nim = '$nim'");
	
	$query4 = mysqli_query($dbsurat,"SELECT * FROM upload WHERE nodata = '$nodata' AND nim = '$nim'");
	$data = mysqli_fetch_array($query4);
		$namafile = $data['namafile'];
	
	unlink($namafile);
	$query5 = mysqli_query($dbsurat,"DELETE FROM upload WHERE nodata = '$nodata' AND nim = '$nim'");
	
	
	mysqli_close($dbsiakad);
	mysqli_close($dbsurat);
	
	header("location:index.php");
?>