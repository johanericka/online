<?php
    date_default_timezone_set('Asia/Jakarta');
    //captcha
    session_start();
    $status = '';
    if (isset($_POST['captcha']) && ($_POST['captcha']!="") ){
        // Validation: Checking entered captcha code with the generated captcha code
        if(strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0){
            // Note: the captcha code is compared case insensitively.
            // if you want case sensitive match, update the check above to strcmp()
            $status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#FF0000;'>Kode Salah! Coba lagi.</span></p>";
            $kd = 0;
        }
        else{
            $status = "<p style='color:#FFFFFF; font-size:20px'><span style='background-color:#46ab4a;'>Kode benar.</span></p>";
            $kd = 1;    
        }
    }

    //echo "kode = ".$kd."<br/>";

    include 'db.php';
    $website = "http://elearning.uin-malang.ac.id";

    if (isset($_POST['nim'])){$nim=mysqli_real_escape_string($conn,$_POST['nim']);}
    if (isset($_POST['nama'])){$nama=mysqli_real_escape_string($conn,$_POST['nama']);}
    if (isset($_POST['tgllhr'])){$tgllhr=mysqli_real_escape_string($conn,$_POST['tgllhr']);}
    if (isset($_POST['captcha'])){$captcha=mysqli_real_escape_string($conn,$_POST['captcha']);}

    if ($captcha != "" and $kd == 1) {
        echo "cari data <br/>";
        if(isset($_POST['cek'])){
            
            //query data
            $sql = "SELECT nim,namamahasiswa,tanggallahir,pin FROM mastermhs where nim=$nim";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $tglinput = strtotime($tgllhr);
                    $tgldb = strtotime($row["tanggallahir"]);
                    //cek perbedaan tanggal, kalo 0 berarti bener
                    $diff = $tgldb - $tglinput;
                    //echo "diff = ".$diff;
                    if ($diff != 0) {
                        echo "DATA YANG DIMASUKKAN SALAH!! <br/>";
                        echo "CEK KEMBALI DATA ANDA <br/>";
                        echo "<br/>";
                        echo "<a href=".$website."/lupa/>Kembali</a>";
                        echo "<br/>";
                        echo "<br/>";
                        echo "Yakin data yang anda masukkan benar ? <br/>";
                        echo "Kirimkan data anda (NIM, Nama & Tgl. Lahir) ke <br/>";
                        echo "<a href='mailto:elearning@uin-malang.ac.id?subject=Lupa%20Password'>elearning@uin-malang.ac.id</a> <br/>";
                        echo "untuk pengecekan manual (slow response)";
                    } else {
                        echo "NIM = <b>" . $row["nim"]. "</b><br/>"; 
                        echo "Nama = " . $row["namamahasiswa"]."<br/>";
                        echo "Password = <b>" . $row["pin"]. "</b><br>";
                        echo "<br/>";
                        echo "<a href=".$website."/lupa/>Kembali</a>";
			$nim = $row["nim"];
                        $sql2 = "insert into hitung values (now(),$nim)";
                        $result2 = $conn->query($sql2);
                    }
                }
                } else {
                    echo "DATA TIDAK DITEMUKAN, cek kembali data anda";
                    echo "<br/>";
                    echo "<a href=".$website."/lupa/>Kembali</a>";
                }
            }
        }
        else {
            echo $status;
            echo "<br/>";
            echo "<a href=".$website."/lupa/>Kembali</a>";
        }
$conn->close();
?> 
