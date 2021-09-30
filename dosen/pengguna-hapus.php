<?php
session_start();
require('../system/dbconn.php');
require('../system/phpmailer/sendmail.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$emailmhs = mysqli_real_escape_string($dbsurat, $_POST['email']);
$namamhs = mysqli_real_escape_string($dbsurat, $_POST['namamhs']);

//update status pengguna
$sql = mysqli_query($dbsurat, "DELETE FROM pengguna 
					WHERE no = '$nodata'");

header("location:index.php");
