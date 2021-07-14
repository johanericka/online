<?php
  //input security check
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

	// menghubungkan dengan koneksi
	include '../system/dbconn.php';

	// menangkap data yang dikirim dari form
	$nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
	$nip = mysqli_real_escape_string($dbsurat,$_POST['nip']);
	$nohp = mysqli_real_escape_string($dbsurat,$_POST['nohp']);
	$jurusan = mysqli_real_escape_string($dbsurat,$_POST['jurusan']);
	$fakultas = "Sains dan Teknologi";
	$username = mysqli_real_escape_string($dbsurat,$_POST['username']);
	$password = mysqli_real_escape_string($dbsurat,$_POST['password']);
	
	echo "Nama =".$nama."<br/>";
	echo "NIP =".$nip."<br/>";
	echo "No HP =".$nohp."<br/>";
	echo "Jurusan =".$jurusan."<br/>";
	echo "Fakultas =".$fakultas."<br/>";
	echo "username = ".$username."<br/>";
	echo "Password = ".$password."<br/>";
	
	$query2 = mysqli_query($dbsurat,"UPDATE pengguna SET 
																				nama = '".$nama."',
																				nip = '".$nip."',
																				nohp = '".$nohp."',
																				jurusan = '".$jurusan."',
																				password = '".$password."'
																		WHERE username = '".$username."'");
																		
	header("location:index.php?pesan=success");
?>