<?php
require("../system/dbconn.php");

$target_dir = "../lampiran/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$lampiran = mysqli_real_escape_string($dbsurat, $_POST['lampiran']);
$nim = mysqli_real_escape_string($dbsurat, $_POST['nim']);
$nodata = mysqli_real_escape_string($dbsurat, $_POST['nodata']);

date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

// get details of the uploaded file
$fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
$fileName = $_FILES['fileToUpload']['name'];
$fileSize = $_FILES['fileToUpload']['size'];
$fileType = $_FILES['fileToUpload']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));

$allowedfileExtensions = array('jpg', 'jpeg');

if (in_array($fileExtension, $allowedfileExtensions)) {
    if ($fileSize <= 1048576) {
        $dest_path = $target_dir . $nim . '-ijinlab-' . $nodata . '-' . $lampiran . '.' . $fileExtension;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            //update data lampiran
            if ($lampiran == 'lamp1') {
                $stmt = $dbsurat->prepare("UPDATE ijinlab SET lamp1=? WHERE no=?");
            } elseif ($lampiran == 'lamp4') {
                $stmt = $dbsurat->prepare("UPDATE ijinlab SET lamp4=? WHERE no=?");
            } elseif ($lampiran == 'lamp5') {
                $stmt = $dbsurat->prepare("UPDATE ijinlab SET lamp5=? WHERE no=?");
            } elseif ($lampiran == 'lamp6') {
                $stmt = $dbsurat->prepare("UPDATE ijinlab SET lamp6=? WHERE no=?");
            } elseif ($lampiran == 'lamp7') {
                $stmt = $dbsurat->prepare("UPDATE ijinlab SET lamp7=? WHERE no=?");
            };
            $stmt->bind_param("si", $dest_path, $nodata);
            $stmt->execute();
            header("location:ijinlab-isi2.php?nodata=$nodata&pesan=success");
        } else {
            header("location:ijinlab-isi2.php?nodata=$nodata&pesan=filesize");
        };
    } else {
        header("location:ijinlab-isi2.php?nodata=$nodata&pesan=gagal");
    };
} else {
    header("location:ijinlab-isi2.php?nodata=$nodata&pesan=extention");
};
