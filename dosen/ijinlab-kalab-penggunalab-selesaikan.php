<?php
require('../system/dbconn.php');
require('../system/phpmailer/sendmail.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d');
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);

$sql = mysqli_query($dbsurat, "UPDATE ijinlab
					SET tglselesai = '$tgl',
                        statuspengajuan = 3
					WHERE no = '$nodata'");

//update kapasitas lab
$sql2 = mysqli_query($dbsurat, "UPDATE laboratorium
					SET kapasitas = kapasitas+1 
					WHERE namalab = '$namalab'");

header("location:ijinlab-kalab-penggunalab-tampil.php");
