<?php
require('../system/dbconn.php');

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nip = mysqli_real_escape_string($dbsurat, $_POST['nip']);
$nohp = mysqli_real_escape_string($dbsurat, $_POST['nohp']);
$email = mysqli_real_escape_string($dbsurat, $_POST['email']);
$prodi = mysqli_real_escape_string($dbsurat, $_POST['namaprodi']);
$fakultas = 'Sains dan Teknologi';
$username = mysqli_real_escape_string($dbsurat, $_POST['username']);
$password = mysqli_real_escape_string($dbsurat, $_POST['password']);
$kunci = mysqli_real_escape_string($dbsurat, $_POST['kunci']);
$jawaban = mysqli_real_escape_string($dbsurat, $_POST['jawaban']);
$token = md5(microtime());

if ($kunci == $jawaban) {
    $stmt = $dbsurat->prepare("UPDATE pengguna 
        SET nama=?, 
            nip=?, 
            nohp=?, 
            email=?, 
            prodi=?, 
            fakultas=?, 
            user=?, 
            pass=?,
            token=?
            WHERE nip=?");
    $stmt->bind_param("ssssssssss", $nama, $nip, $nohp, $email, $prodi, $fakultas, $username, $password, $token, $nip);
    $stmt->execute();
    header("location:index.php?pesan=success");
} else {
    header("location:userprofile-tampil.php?pesan=token");
}
