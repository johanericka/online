<?php
require_once('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d H:i:s');
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$namalab = mysqli_real_escape_string($dbsurat, $_POST['namalab']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$bulan = date('m');
$tahun = date('Y');
$nosurat = "B-" . $nodata . ".O/FST/PP.00.9/" . $bulan . "/" . $tahun . "";

//update status validasi dosen pembimbing
$sql = mysqli_query($dbsurat, "UPDATE ijinlab
					SET tglvalidasi3 = '$tgl', 
					validasi3 = '1',
					keterangan='$nosurat',
					statuspengajuan='1'
					WHERE no = '$nodata'");

header("location:index.php");
