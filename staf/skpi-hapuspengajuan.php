<?php
session_start();
require_once('../system/dbconn.php');
$iduser = mysqli_real_escape_string($dbsurat, $_GET['iduser']);
echo "ID USer = " . $iduser;

$sql = mysqli_query($dbsurat, "DELETE FROM skpi_prestasipenghargaan WHERE nim='" . $iduser . "'");
$sql = mysqli_query($dbsurat, "DELETE FROM skpi WHERE nim='" . $iduser . "'");
//echo "data terhapus";
header("location:skpi-rekap.php");
