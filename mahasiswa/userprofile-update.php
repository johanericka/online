<?php
require('../system/dbconn.php');

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nip = mysqli_real_escape_string($dbsurat, $_POST['nip']);
$nohp = mysqli_real_escape_string($dbsurat, $_POST['nohp']);
$email = mysqli_real_escape_string($dbsurat, $_POST['email']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$fakultas = 'Sains dan Teknologi';
$username = mysqli_real_escape_string($dbsurat, $_POST['username']);
$password = mysqli_real_escape_string($dbsurat, $_POST['password']);
$kunci = mysqli_real_escape_string($dbsurat, $_POST['kunci']);
$jawaban = mysqli_real_escape_string($dbsurat, $_POST['jawaban']);
$token = md5(microtime());

echo "Nama = " . $nama . "<br/>";
echo "NIP = " . $nip . "<br/>";
echo "No HP = " . $nohp . "<br/>";
echo "email = " . $email . "<br/>";
echo "jurusan = " . $jurusan . "<br/>";
echo "fakultas = " . $fakultas . "<br/>";
echo "username = " . $username . "<br/>";
echo "password = " . $password . "<br/>";
echo "kunci = " . $kunci . "<br/>";
echo "jawaban = " . $jawaban . "<br/>";
echo "token = " . $token . "<br/>";

if ($kunci == $jawaban) {
    $stmt = $dbsurat->prepare("UPDATE pengguna 
        SET nama=?, 
            nip=?, 
            nohp=?, 
            email=?, 
            jurusan=?, 
            fakultas=?, 
            user=?, 
            pass=?,
            token=?
            WHERE nip=?");
    $stmt->bind_param("ssssssssss", $nama, $nip, $nohp, $email, $jurusan, $fakultas, $username, $password, $token, $nip);
    $stmt->execute();
    //header("location:index.php?pesan=success");
} else {
    header("location:userprofile-tampil.php?pesan=token");
}
