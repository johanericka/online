<?php
require ('system/dbconn.php');

$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nip = mysqli_real_escape_string($dbsurat, $_POST['nip']);
$nohp = mysqli_real_escape_string($dbsurat, $_POST['nohp']);
$email = mysqli_real_escape_string($dbsurat, $_POST['email']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$fakultas = "Sains dan Teknologi";
$username = mysqli_real_escape_string($dbsurat, $_POST['username']);
$password = mysqli_real_escape_string($dbsurat, $_POST['password']);
$kunci = mysqli_real_escape_string($dbsurat, $_POST['kunci']);
$jawaban = mysqli_real_escape_string($dbsurat, $_POST['jawaban']);

if ($kunci == $jawaban) {
	$stmt = $dbsurat->prepare('SELECT nip FROM pengguna WHERE nip=? ');
    $stmt->bind_param('s', $nip);
    $stmt->execute();
    $result = $stmt->get_result();
    $jhasil = $result->num_rows;
    if ($jhasil > 0) {
        header('location:daftar.php?pesan=registered');
} else {
    $hakakses = 'mahasiswa';
	$stmt = $dbsurat->prepare('INSERT INTO pengguna (nama, nip, nohp, email, jurusan, fakultas, user, pass,hakakses) VALUES(?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param("sssssssss", $nama,$nip,$nohp,$email,$jurusan,$fakultas,$username,$password,$hakakses);
    $stmt->execute();
    header("location:index.php?pesan=success");
};