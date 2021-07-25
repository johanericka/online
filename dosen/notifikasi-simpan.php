<?php
	require_once('../system/dbconn.php');
	 
	session_start();
	$iduser = mysqli_real_escape_string($dbsurat,$_SESSION['iduser']);
	$email = mysqli_real_escape_string($dbsurat,$_POST['email']);
	$kirimemail = mysqli_real_escape_string($dbsurat,$_POST['kirimemail']);
	if($kirimemail==1){
		$statusemail = 1;
	}else{
		$statusemail = 0;
	};
	
	$nohp = mysqli_real_escape_string($dbsurat,$_POST['nohp']);
	$kirimhp = mysqli_real_escape_string($dbsurat,$_POST['kirimhp']);
	if($kirimhp==1){
		$statushp = 1;
	}else{
		$statushp = 0;
	};
	
	echo "ID User = ".$iduser."<br/>";
	echo "E-Mail = ".$email."<br/>";
	echo "Kirim E-Mail = ".$statusemail."<br/>";
	echo "No. HP = ".$nohp."<br/>";
	echo "Kirim HP = ".$statushp."<br/>";
	
	//cek kalo sudah ada datanya ya di update
	
	$query = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser='$iduser'");
	$cekdata = mysqli_num_rows($query);	
	if ($cekdata > 0){
		$query1 = "UPDATE notifikasi
							SET email = '$email',
									kirimemail = $statusemail,
									nohp = '$nohp',
									kirimhp = $statushp
							WHERE iduser = '$iduser'";
	}else{
		$query1 = "INSERT INTO notifikasi (iduser, email, kirimemail, nohp, kirimhp)
							VALUES ('$iduser','$email','$statusemail','$nohp','$statushp')";
	};
	
	if (mysqli_query($dbsurat,$query1)) {
		mysqli_close($dbsurat);
		header("location:index.php");
	}else {
		echo "error ".$mysqli_error($dbsurat);
		header("location:index.php");
	};
		
?>