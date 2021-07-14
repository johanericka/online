<?php
session_start();
$status = '';
if (isset($_POST['captcha']) && ($_POST['captcha']!="") ){
// Validation: Checking entered captcha code with the generated captcha code
if(strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0){
// Note: the captcha code is compared case insensitively.
// if you want case sensitive match, update the check above to strcmp()
$status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#FF0000;'>Kode Salah! Coba lagi.</span></p>";

}else{
$status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#46ab4a;'>Kode benar.</span></p>";
 
    }
}
include 'db.php';

$sql = "SELECT count(*) as total FROM hitung";
$result = mysqli_query($conn,$sql);
$data = mysqli_fetch_assoc($result);
$count = $data['total'];
?>
<html>
<head>
    <title>Lupa Password</title>
</head>

<body>
    <header>
        <h3>Lupa Password</h3>
    </header>
    <form action="tampildata.php" method="POST" name="form">

        <p>
            <label for="nim">NIM: </label>
            <input type="number" name="nim" autocomplete="off" placeholder="tuliskan NIM anda disini" />
        </p>
        <p>
            <label for="nama">Nama: </label>
            <input type="text" name="nama" autocomplete="off" placeholder="tuliskan Nama anda disini" />
        </p>
        <p>
            <label for="tgllhr">Tanggal Lahir: </label>
            <input type="date" name="tgllhr" value="2000-12-31" />
        </p>
        <p>
        <?php echo $status; ?>
        <label><strong>Ketikkan kode yang anda lihat:</strong></label><br />
        <input type="text" name="captcha" autocomplete="off" placeholder="kode"/>
        <p>
            <img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>
        </p>
        <p>Tulisan tidak terbaca?<a href='javascript: refreshCaptcha();'>klik disini</a> untuk ganti tulisan
        </p>
            <input type="submit" value="Cek" name="cek" />
        </p>
        <p><i>Anda orang ke <?php echo $count+163; ?> yang lupa password :)</i></p>
    </form>
    <script>
    //Refresh Captcha
    function refreshCaptcha(){
        var img = document.images['captcha_image'];
        img.src = img.src.substring(
            0,img.src.lastIndexOf("?")
            )+"?rand="+Math.random()*1000;
    }
    </script>
    </body>
</html>
