<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['prodi']);
$keterangan = mysqli_real_escape_string($dbsurat, $_POST['keterangan']);

//update status validasi dosen pembimbing
$sql = mysqli_query($dbsurat, "UPDATE ijinlab
					SET tglvalidasi1 = '$tgl', 
					validasi1 = '2',
                    keterangan='$keterangan',
                    statuspengajuan=2
					WHERE no = '$nodata'");

header("location:index.php");
