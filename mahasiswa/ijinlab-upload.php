<?php
require("../config.php");
require('../vendors/phpmailer/sendmail.php');
$target_dir = "../makalah/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
date_default_timezone_set("Asia/Jakarta");
$tanggal = date('Y-m-d H:i:s');

// get details of the uploaded file
$fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
$fileName = $_FILES['fileToUpload']['name'];
$fileSize = $_FILES['fileToUpload']['size'];
$fileType = $_FILES['fileToUpload']['type'];
$fileNameCmps = explode(".", $fileName);
$fileExtension = strtolower(end($fileNameCmps));
$namaemail = explode("@", $email);
$namae = $namaemail[0];
$newFileName = $namae . '-' . $fileName;

$allowedfileExtensions = array('pdf', 'doc', 'docx');

if (in_array($fileExtension, $allowedfileExtensions)) {
    $dest_path = $target_dir . $newFileName;
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        //cek apakah user sudah pernah upload makalah ? 
        $sql = "SELECT * FROM makalah WHERE email=? and judulmakalah = null";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $jhasil = $result->num_rows;
        $dhasil = $result->fetch_assoc();
        $namafile = $dhasil['judulmakalah'];
        if ($jhasil > 0) {
            unlink($target_dir . "/" . $namafile);
        }
        $statusmakalah = 0;
        $verifikatormakalah = null;
        $tglverifikasimakalah = null;
        $keteranganmakalah = null;
        $sql = "UPDATE makalah SET
                    tglmakalah=?,
                    judulmakalah=?,
                    statusmakalah=?,
                    verifikatormakalah=?,
                    tglverifikasimakalah=?,
                    keteranganmakalah=?
                    WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssissss", $tanggal, $newFileName, $statusmakalah, $verifikatormakalah, $tglverifikasimakalah, $keteranganmakalah, $email);
        $stmt->execute();
        //kirim email
        $subject = "Upload Makalah di Seminar Nasional Kewirausahaan 3";
        $pesan = "Yth. " . $nama . "<br/>
            <br/>
            <br/>
            Terima kasih telah melakukan <b>Upload Makalah </b>. <br/>
            <br/>
            Panitia akan segera melakukan verifikasi terhadap makalah anda. Anda akan mendapatkan notifikasi status makalah anda pada email selanjutnya atau pada sistem registrasi<br/>
            Silahkan klik tombol berikut ini untuk masuk kedalam sistem registrasi<br/>
            <br/>
            <a href='https://registrasi.semnaskwu3ub.com' style=' background-color: #4CAF50;border: none;color: white;padding: 8px 16px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;'>Masuk</a><br/>
            <br/>
            atau klik URL berikut ini <a href='https://registrasi.semnaskwu3ub.com'>https://registrasi.semnaskwu3ub.com</a> apabila tombol diatas tidak berfungsi. <br/>
            <br/>
            Untuk pertanyaan atau bantuan silahkan klik tombol <b>Bantuan</b> setelah masuk kedalam sistem registrasi. <br/>
            <br/>
            <br/>
            <b>Panitia Seminar Nasional Kewirausahaan 3</b><br/>
            <img src='https://registrasi.semnaskwu3ub.com/images/logo-feb2.png' width='300px'>";
        sendmail($email, $nama, $subject, $pesan);
        header("location:dashboard.php?pesan=sukses");
    } else {
        header("location:naskah-tampil.php?pesan=gagal");
    }
} else {
    header("location:naskah-tampil.php?pesan=extention");
}
