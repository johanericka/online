<?php 
  require_once('system/dbconn.php');
	
	mysqli_close($dbpresensi);
	mysqli_close($dbsiakad);
	
	echo "ID User = ". $_SESSION['iduser'];
	
	// menghapus semua session
	// remove all session variables
	session_start();
	session_unset();

	// destroy the session
	session_destroy();
	echo "Status = ". $_SESSION['status'];
	
	echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
	// mengalihkan halaman sambil mengirim pesan logout
	header("location:index.php?pesan=logout");
?>