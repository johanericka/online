<?php
	// menghubungkan dengan koneksi
	include 'system/dbconn.php';
	
  //input security check
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

	

	// menangkap data yang dikirim dari form
	$nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
	$nipt = mysqli_real_escape_string($dbsurat,$_POST['nipt']);
	$nohp = mysqli_real_escape_string($dbsurat,$_POST['nohp']);
	$kdjurusan = mysqli_real_escape_string($dbsurat,$_POST['jurusan']);
	$kdfakultas = "Sains dan Teknologi";
	$username = mysqli_real_escape_string($dbsurat,$_POST['username']);
	$password = mysqli_real_escape_string($dbsurat,$_POST['password']);
	$password2 = test_input($_POST['password2']);
	
	echo "Nama =".$nama."<br/>";
	echo "NIPT =".$nipt."<br/>";
	echo "No HP =".$nohp."<br/>";
	echo "Jurusan =".$kdjurusan."<br/>";
	echo "Fakultas =".$kdfakultas."<br/>";
	echo "username = ".$username."<br/>";
	echo "Password = ".$password."<br/>";

	if ( !isset($_POST['username'], $_POST['password']) ) {
	  exit('Isikan User ID & Password anda');
  };
	
	
	$query = mysqli_query($dbsurat,"select * from pengguna where nipt = '$nipt' or username = '$username'");
	$jmldata = mysqli_num_rows($query);
	if ($jmldata > 0){
		header("location:index.php?pesan=duplicate");
	}else{
		$query2 = mysqli_query($dbsurat,"INSERT INTO pengguna (nama, nip, nohp, jurusan, fakultas, username, password)
													 VALUES ('$nama','$nipt','$nohp','$kdjurusan','$kdfakultas','$username','$password')");
		$jmldata2 = mysqli_num_rows($query2);
	};
	
	header("location:index.php?pesan=success");
	
?>