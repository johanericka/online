<?php
//akses ke database
require_once('../system/dbconn.php');

//dapatkan info dari lab-isi.php
$nim = $_POST['nim'];
$button = $_POST['upload'];
$nodata = $_POST['nodata'];
echo $nim . "<br/>";
echo $button . "<br/>";
echo $nodata . "<br/>";

if (isset($_POST) && !empty($_FILES['image']['name'])) {
    $valid_extensions = array('jpeg', 'jpg', 'pdf'); // valid extensions
    $filepath = '../uploads/';
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];

    //list($txt, $ext) = explode(".", $img); // alternative $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    $ext = strtolower(substr($img, -3));
    if ($ext == 'peg') {
        $ext = 'jpg';
    }

    //$image_name = $txt.".".$ext;
    $image_name = $nim . $button . $nodata . "." . $ext;
    echo $image_name;
    // Validate File extension
    if (in_array($ext, $valid_extensions)) {
        $filepath = $filepath . $image_name;
        compressImage($tmp, $filepath, 60);
        if (move_uploaded_file($tmp, $filepath)) {
            //resize image
            if ($ext != "pdf") {
                $width_size = 1024;
                list($width, $height) = getimagesize($filepath);
                $k = $width / $width_size;
                $newwidth = $width / $k;
                $newheight = $height / $k;
                $thumb = imagecreatetruecolor($newwidth, $newheight);
                $source = imagecreatefromjpeg($filepath);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                imagejpeg($thumb, $filepath);
                imagedestroy($thumb);
                imagedestroy($source);
            }
        }

        $query = mysqli_query($dbsurat, "SELECT * FROM upload WHERE nim='$nim' AND keterangan='$button'");
        $cekhasil = mysqli_num_rows($query);
        echo $cekhasil;
        if ($cekhasil > 0) {
            $query2 = mysqli_query($dbsurat, "UPDATE upload SET namafile = '$filepath' WHERE nim = '$nim' AND keterangan = '$button'");
        } else {
            $query2 = mysqli_query($dbsurat, "INSERT INTO upload (nim, namafile, keterangan) VALUES ('$nim','$filepath','$button')");
        };
        header('location:pkl-isilampiran.php');
    } else {
        echo "<script>alert('ERROR!! Hanya menerima format file JPG / PDF');
                                    document.location='pkl-isilampiran.php'</script>";
    };
};

// Compress image
function compressImage($source, $destination, $quality)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/PDF')
        $image = imagecreatefromPDF($source);
    imagejpeg($image, $destination, $quality);
};
