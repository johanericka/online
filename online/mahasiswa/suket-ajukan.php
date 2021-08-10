<?php
require('../system/dbconn.php');

$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);
$statussurat = 0;
$stmt = $dbsurat->prepare("UPDATE suket SET statussurat=? WHERE no=?");
$stmt->bind_param("ii", $statussurat, $nodata);
$stmt->execute();
header("location:index.php");
