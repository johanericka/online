<?php
require('system/dbconn.php');
$q1 = mysqli_query($dbsurat, "SELECT * FROM useraccount3");
while ($d1 = mysqli_fetch_array($q1)) {
    $kode = $d1['kode'];
    $nip = $d1['nip'];
    $nama = $d1['nama'];
    $pass = $d1['pass'];
    $email = $d1['email'];

    if (strlen($kode) == 5) {
        $kdjurusan = substr($kode, 0, 2);
        $sql2 = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
        $data2 = mysqli_fetch_array($sql2);
        $jurusan = $data2['jurusan'];
    } else {
        if (strlen($kode) == 8) {
            $kdjurusan = substr($kode, 2, 2);
        } else {
            $kdjurusan = substr($kode, 2, 5);
        }
        //dapatkan jurusan mahasiswa
        $sql2 = mysqli_query($dbsurat, "SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
        $data2 = mysqli_fetch_array($sql2);
        $jurusan = $data2['jurusan'];
    }
}
