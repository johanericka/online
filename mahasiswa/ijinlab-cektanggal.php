<?php
require_once('../system/dbconn.php');

$tglsekarang = date('Y-m-d');
echo "Tanggal sekarang = " . $tglsekarang . "<br/>";

//set status mahasiswa
$query = mysqli_query($dbsurat, "SELECT * FROM ijinlab WHERE tglselesai <= '$tglsekarang'");
$cek = mysqli_num_rows($query);
echo "Jumlah data = " . $cek . "\r\n";
while ($data = mysqli_fetch_array($query)) {
        $namalab = $data['namalab'];
        $nim = $data['nim'];
        echo "Nama Lab = " . $namalab . "\r\n";
        echo "NIM = " . $nim . "\r\n";
        $query1 = mysqli_query($dbsurat, "UPDATE ijinlab SET status = 0 WHERE nim = '$nim' AND namalab='$namalab' AND tglselesai <= '$tglsekarang'");
        //$query2 = mysqli_query($dbsurat,"UPDATE laboratorium SET kapasitas = kapasitas + 1 WHERE namalab = '$namalab'");
}


//update kapasitas lab
$query4 = mysqli_query($dbsurat, "SELECT * FROM laboratorium");
while ($rec = mysqli_fetch_array($query4)) {
        $namalab = $rec['namalab'];
        $diijinkan = $rec['diijinkan'];
        echo "Namalab = " . $namalab;
        echo " Diijinkan = " . $diijinkan;
        $query3 = mysqli_query($dbsurat, "SELECT COUNT(nim) FROM ijinlab WHERE namalab = '$namalab' AND STATUS =1");
        $rec2 = mysqli_fetch_row($query3);
        $isi = $rec2[0];
        $kapasitas = $diijinkan - $isi;
        echo " Isi = " . $isi;
        echo " Kapasitas = " . $kapasitas;
        echo "\r\n";
        $qupdate = mysqli_query($dbsurat, "UPDATE laboratorium SET kapasitas = '$kapasitas' WHERE namalab = '$namalab'");
}
header("location:lab-isi1.php");
