<?php
	// mengaktifkan session php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	// menghubungkan dengan koneksi
	include 'system/dbconn.php';

  //input security check
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
	
	//get user data function
	function userlog($userid){
		$userip = $_SERVER['REMOTE_ADDR'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		date_default_timezone_set("Asia/Jakarta");
		$waktu = date("Y-m-d H:i:d");
		$querylog = mysqli_query($dbsurat,"INSERT INTO log (waktu,iduser,ipaddress,browser) VALUES ($waktu,$userid,$userip,$browser)");
	}
	
	// menangkap data yang dikirim dari form
	$username = mysqli_real_escape_string($dbsurat,$_POST['username']);
	$password = mysqli_real_escape_string($dbsurat,$_POST['password']);
	
	if ( !isset($_POST['username'], $_POST['password']) ) {
	  exit('Isikan User ID & Password anda');
  };
	
	$iduser = $username;
	
	if(strlen($username > 5)){
		//yg login mahasiswa
			echo '<script>alert("Mahasiswa Login")</script>'; 
			
			$sql = mysqli_query($dbsiakad, "select * from elearning_user where kode='$username' and pass='$password'");
			$cek = mysqli_num_rows($sql);
			if ($cek > 0){
				$data = mysqli_fetch_array($sql);
					$iduser = $data['kode'];
					$nim = $data['kode'];
					$nama = $data['nama'];
					$kdjurusan = substr($iduser,2,2);
					
					//dapatkan jurusan dosen
					$sql2 = mysqli_query($dbsurat, "select * from jurusan where kdjurusan = '$kdjurusan'");
					$data2 = mysqli_fetch_array($sql2);
						$jurusan = $data2['jurusan'];
					
					$role = "mahasiswa";
					echo "Username = ".$username."<br/>";
					echo "Password = ".$password."<br/>";
					echo "ID User = ".$iduser."<br/>";
					echo "NIM = ".$nim."<br/>";
					echo "Nama = ".$nama."<br/>";
					echo "Jurusan = ".$jurusan."<br/>";
					echo "Role = ".$role."<br/>";
					
					//set session
					$_SESSION['iduser'] = $iduser;
					$_SESSION['nim'] = $nim;
					$_SESSION['nama'] = $nama;
					$_SESSION['jurusan'] = $jurusan;
					$_SESSION['status'] = "login";
					$_SESSION['role'] = $role;
					
					$userip = $_SERVER['REMOTE_ADDR'];
					$browser = $_SERVER['HTTP_USER_AGENT'];
					$waktu = date('Y-m-d H:i:s', strtotime(now));
					$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
						
					//header("location:mahasiswa/index.php");
			}else{
				header("location:index.php?pesan=gagal");
			}
	}else{
		//cek apakah yang login dosen
		echo '<script>alert("Dosen Login")</script>'; 
		
		$sql = mysqli_query($dbsiakad,"select * from elearning_user where kode='$username' and pass='$password'");
		$cek = mysqli_num_rows($sql);
		if($cek > 0){
			$row = mysqli_fetch_array($sql);
				$nip = $row['kode'];
				//$gelardepan = $row[1];
				//$namadosen = $row[2];
				//$gelarbelakang = $row[3];
				$nama = $row['nama'];
				$kdjurusan = substr($iduser,0,2);
				
				//cek apakah termasuk kasus khusus
				$sql1 = mysqli_query($dbsurat, "select kdjurusan from khusus where iduser='$iduser'");
				$hasilsql1 = mysqli_num_rows($sql1);
				if ($hasilsql1 > 0) {
					$data1 = mysqli_fetch_array($sql1);
						$kdjurusan = $data1['kdjurusan'];
				}
				
				//dapatkan jurusan dosen
				$sql2 = mysqli_query($dbsurat, "select * from jurusan where kdjurusan = '$kdjurusan'");
				$data2 = mysqli_fetch_array($sql2);
					$jurusan = $data2['jurusan'];
				
				//set session
				$_SESSION['iduser'] = $iduser;
				$_SESSION['nip'] = $nip;
				$_SESSION['nama'] = $nama;
				$_SESSION['jurusan'] = $jurusan;
				$_SESSION['status'] = "login";
				echo "NIP = ".$nip."<br/>";
				echo "ID User = ".$iduser."<br/>";
				echo "Nama = ".$nama."<br/>";
				echo "Jurusan = ".$jurusan."<br/>";
				echo "Status = ".$status."<br/>";
				
				
				//cek apakah yg login pejabat
				$sql = mysqli_query($dbsurat,"select * from pejabat where iddosen='$iduser'");
				$hasil = mysqli_num_rows($sql);
				if ($hasil == 0){
					$role = "Dosen";
					$_SESSION['role'] = $role;
					
					$userip = $_SERVER['REMOTE_ADDR'];
					$browser = $_SERVER['HTTP_USER_AGENT'];
					$waktu = date('Y-m-d H:i:s', strtotime(now));
					$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
					
					//header("location:dosen/index.php");
				}else{
					$data = mysqli_fetch_array($sql);
					$role = $data['kdjabatan'];
					echo "Kode Jabatan = ".$role."<br/>";
					if($role == "kajur" OR $role == "kabag"){
						$_SESSION['role'] = $role;
						$userip = $_SERVER['REMOTE_ADDR'];
						$browser = $_SERVER['HTTP_USER_AGENT'];
						$waktu = date('Y-m-d H:i:s', strtotime(now));
						$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
						header("location:jurusan/index.php");
						}elseif ($role == "wakildekan"){
							$userip = $_SERVER['REMOTE_ADDR'];
							$browser = $_SERVER['HTTP_USER_AGENT'];
							$waktu = date('Y-m-d H:i:s', strtotime(now));
							$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
							$_SESSION['role'] = $role;
							header("location:fakultas/index.php");
						}elseif ($role == "dekan"){
							$userip = $_SERVER['REMOTE_ADDR'];
							$browser = $_SERVER['HTTP_USER_AGENT'];
							$waktu = date('Y-m-d H:i:s', strtotime(now));
							$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
							$_SESSION['role'] = $role;
							header("location:dekan/index.php");
						}elseif($role == "koorpkl"){
							$_SESSION['role'] = "koorpkl";				
							$userip = $_SERVER['REMOTE_ADDR'];
							$browser = $_SERVER['HTTP_USER_AGENT'];
							$waktu = date('Y-m-d H:i:s', strtotime(now));
							$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
							header("location:dosen/index.php");
						}
					}
					
		}else{
			//jika bukan dosen mungkin staff
			$datalogin = mysqli_query($dbsurat,"select * from pengguna where username='$username' and password='$password'");
			$cek = mysqli_num_rows($datalogin);
			if($cek > 0){
				$row = mysqli_fetch_array($datalogin);
					$nip = $row['nip'];
					$nama = $row['nama'];
					$jurusan = $row['jurusan'];
					
					//cek apakah yang login pejabat
					$sql = mysqli_query($dbsurat,"select kdjabatan from pejabat where iddosen='$iduser'");
					$hasil = mysqli_num_rows($sql);
					if ($hasil == 0){
						$role = "Tenaga Kependidikan";
						$userip = $_SERVER['REMOTE_ADDR'];
						$browser = $_SERVER['HTTP_USER_AGENT'];
						$waktu = date('Y-m-d H:i:s', strtotime(now));
						$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
						header("location:staf/index.php");
					}else{
						$data = mysqli_fetch_array($sql);
						$role = $data['kdjabatan'];
						if($role == "kajur" or $role == "kabag"){
							$userip = $_SERVER['REMOTE_ADDR'];
							$browser = $_SERVER['HTTP_USER_AGENT'];
							$waktu = date('Y-m-d H:i:s', strtotime(now));
							$querylog = mysqli_query($dbsurat,"INSERT INTO userlog (waktu,iduser,ipaddress,browser) VALUES ('$waktu','$iduser','$userip','$browser')");
							header("location:jurusan/index.php");
						}
					}
					//set session
					$_SESSION['iduser'] = $iduser;
					$_SESSION['nip'] = $nip;
					$_SESSION['nama'] = $nama;
					$_SESSION['jurusan'] = $jurusan;
					$_SESSION['status'] = "login";
					$_SESSION['role'] = $role;
			}
		}
	}
?>