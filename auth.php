<?php
session_start();
require('system/dbconn.php');

$username = mysqli_real_escape_string($dbsurat, $_POST['username']);
$password = mysqli_real_escape_string($dbsurat, strtoupper($_POST['password']));
$kunci = mysqli_real_escape_string($dbsurat, $_POST['kunci']);
$antibot = mysqli_real_escape_string($dbsurat, $_POST['antibot']);

if ($kunci == $antibot) {
    $stmt = $dbsurat->prepare("SELECT * FROM pengguna WHERE user=? AND upper(pass)=? ");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $jhasil = $result->num_rows;
    if ($jhasil > 0) {
        $dhasil = $result->fetch_assoc();
        $nama = $dhasil['nama'];
        $nip = $dhasil['nip'];
        $nohp = $dhasil['nohp'];
        $email = $dhasil['email'];
        $jurusan = $dhasil['jurusan'];
        $hakakses = $dhasil['hakakses'];

        $_SESSION['hakakses'] = $hakakses;
        $_SESSION['user'] = $username;
        $_SESSION['nama'] = $nama;
        $_SESSION['nip'] = $nip;
        $_SESSION['jurusan'] = $nama;



        if ($hakakses == 'dosen') {
            header('location:dosen/index.php');
        } elseif ($hakakses == 'tendik') {
            header('location:staf/index.php');
        } else {
            header('location:mahasiswa/index.php');
        }
    } else {
        header('location:index.php?pesan=gagal');
    }
} else {
    header('location:index.php?pesan=antibot');
}
