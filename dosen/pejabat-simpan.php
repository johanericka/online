<?php
session_start();
require('../system/dbconn.php');

$dosen = mysqli_real_escape_string($dbsurat, $_POST['dosen']);
$prodi = $_POST['prodi'];
$kdjabatan = $_POST['kdjabatan'];

$qdosen = mysqli_query($dbsurat, "SELECT * FROM pengguna WHERE nama = '$dosen'");
$ddosen = mysqli_fetch_array($qdosen);
$iddosen = $ddosen['user'];
$nip = $ddosen['nip'];

switch ($kdjabatan) {
    case "dekan":
        $jabatan = "Dekan";
        break;
    case "wadek1":
        $jabatan = "Wakil Dekan Bidang Akademik";
        break;
    case "wadek2":
        $jabatan = "Wakil Dekan Bidang AUPK";
        break;
    case "wadek3":
        $jabatan = "Wakil Dekan Bidang Kemahasiswaan dan Kerja Sama";
        break;
    case "kaprodi":
        $jabatan = "Ketua Program Studi " . $prodi;
        break;
    case "sekprodi":
        $jabatan = "Sekretaris Program Studi " . $prodi;
        break;
    case "kabag-tu":
        $jabatan = "Kepala Bagian Tata Usaha Fakultas";
        break;
    case "kasubag-pak":
        $jabatan = "Kepala Sub Bagian PAK";
        break;
    case "kasubag-akademik":
        $jabatan = "Kepala Sub Bagian Akademik";
        break;
    case "kasubag-umum":
        $jabatan = "Kepala Sub Bagian Umum";
        break;
}

$qsimpan = mysqli_query($dbsurat, "INSERT INTO pejabat (prodi,kdjabatan,iddosen,nip,nama,jabatan)
                                    VALUES ('$prodi','$kdjabatan','$iddosen','$nip','$dosen','$jabatan')");

header("location:pejabat-tampil.php");
