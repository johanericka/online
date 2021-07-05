<?php
  $servername = "elearning.uin-malang.ac.id:9779";
  $username = "lupapass";
  $password = "lupapass@)@)";
  $dbname = "externaldb2019_2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['cek'])){
// ambil data dari formulir
    $nim = $_POST['nim'];
    $sql = "SELECT * 
            FROM ext_user 
            where kode=$nim";
    $result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
	echo "Lupa Password";
	echo "<br/>";
        echo "NIM / ID Dosen = " . $row["kode"]. "<br/>"; 
        echo "Nama = " . $row["nama"]."<br/>";
        echo "Password = " . $row["pass"]. "<br>";
        echo "<br/>";
        echo "<a href='http://elearning.uin-malang.ac.id/lupa/indexku.html'>Kembali</a>";
	echo "<br/>";
	echo "<form action='http://elearning.uin-malang.ac.id/online/auth.php' method='post' name='form' id='form'>";
	echo "  <p><input type='text' name='username' size='15' value=".$row["kode"]."></p>";
  	echo "  <p><input type='text' name='password' size='15' value=".$row["pass"]."></p>";
	echo "  <p><input type='submit' name='Submit' value='Login Surat Online' target='_blank'/></p>";
	echo "</form>";
        echo "<br/>";
        //echo "<a href='http://elearning.uin-malang.ac.id/wfh/auth.php'>Login Surat Online/a>";


    }
} else {
    echo "DATA TIDAK DITEMUKAN, cek kembali data anda";
    echo "<//elearning.uin-malang.ac.id/wfh/auth.phpbr/>";
    echo "<a href='http://elearning.uin-malang.ac.id/lupa/indexku.html'>Kembali</a>";

}
$conn->close();
}
?> 
