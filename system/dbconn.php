<?php
//$dbsurat = mysqli_connect("10.10.7.91:3306", "surat", "surat2020", "surat");
$dbsurat = mysqli_connect("localhost", "surat", "surat2020", "surat");
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
	//echo "Connected to surat db";
}
//koneksi ke db siakad
//$dbsiakad = mysqli_connect("10.10.7.80:9779","elearning2019_2","elearningADM1N@)@)","externaldb2019_2");
/*
$dbsiakad = mysqli_connect("103.17.76.13:9779", "johanericka", "p455w0rd", "externaldb2019_2");
// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to DB SIAKAD: " . mysqli_connect_error();
} else {
	//echo "Connected to DB SIAKAD";
}
*/