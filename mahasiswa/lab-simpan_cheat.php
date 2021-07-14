<?php
	require_once('../system/dbconn.php');
	 
	session_start();
	if($_SESSION['status']!="login"){
		header("location:../index.php?pesan=belum_login");
	}

	$iduser = $_SESSION['iduser'];
	$tanggal = date('Y-m-d');
	$nodata = $_POST['nodata'];
	$nim = $_POST['nim'];
	$nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
	$ttl = $_POST['ttl'];
	$alamatasal = $_POST['alamatasal'];
	$alamatmalang = $_POST['alamatmalang'];
	if (empty($alamatmalang)){$alamatmalang = 'tidak ada';}
	$nohp = $_POST['nohp'];
	$nohportu = $_POST['nohportu'];
	$riwayatpenyakit = $_POST['riwayatpenyakit'];
	if(empty($riwayatpenyakit)){$riwayatpenyakit = 'tidak ada';}
	$posisi = $_POST['posisi'];
	$prodi = $_POST['jurusan'];
	$namalab = $_POST['namalab'];
	$dosen = mysqli_real_escape_string($dbsurat,$_POST['dosen']);
	$tglmulai = $_POST['tglmulai'];
	$tglselesai = $_POST['tglselesai'];
	
	//cari kode dosen dari nama dosen
	$sql1 = mysqli_query($dbsiakad,"select kode from useraccount where nama = '".$dosen."'"); 
	$row = mysqli_fetch_row($sql1); 
		$kddosen = $row[0];
	
	//cari kaprodi
	$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where jurusan ='$prodi' and level=5");
	$data = mysqli_fetch_row($sql2);
		$kdkaprodi = $data[0];
	/*
	echo "No Data = ".$nodata."<br/>";
	echo "ID User = ".$iduser."<br/>";
	echo "NIM = ".$nim."<br/>";
	echo "Nama = ".$nama."<br/>";
	echo "Tempat Tanggal Lahir = ".$ttl."<br/>";
	echo "Alamat Asal = ".$alamatasal."<br/>";
	echo "Alamat Malang = ".$alamatmalang."<br/>";
	echo "No. HP = ".$nohp."<br/>";
	echo "No. HP Orang Tua = ".$nohportu."<br/>";
	echo "Riwayat penyakit = ".$riwayatpenyakit."<br/>";
	echo "Posisi = ".$posisi."<br/>";
	echo "Program Studi = ".$prodi."<br/>";
	echo "Kode kaprodi = ".$kdkaprodi."<br/>";
	echo "Nama Lab = ".$namalab."<br/>";
	echo "Dosen Pembimbing = ".$dosen."<br/>";
	echo "Kode Dosen = ".$kddosen."<br/>";
	echo "Tanggal Mulai = ".$tglmulai."<br/>";
	echo "Tanggal Selesai = ".$tglselesai."<br/>";
	*/
	//hitung jumlah hari
	$jmlhari = (strtotime($tglselesai) - strtotime($tglmulai))/60/60/24;
	//echo "Jumlah hari = ".$jmlhari	."<br/>";
	//jika jumlah hari >30 maka di potong jadi 1 bulan saja
	if ($jmlhari > 30){
		$tglselesai = date('Y-m-d',strtotime($tglmulai." +1 month"));
		//echo "Tanggal Selesai baru ".$tglselesai;
	}
	
	//cek apakah ada data yang kosong
	if (empty($alamatasal) 
			OR empty($alamatmalang) 
			OR empty($nohp) 
			OR empty($nohportu) 
			OR empty($riwayatpenyakit) 
			OR empty($dosen)
			){
		echo "<script>alert('ERROR!! ada data yang belum terisi, silahkan cek kembali');
		document.location='lab-isi.php'</script>";		
	}else{
		//update kapasitas lab
		$sql = "UPDATE laboratorium
						SET kapasitas = kapasitas - 1 
						WHERE namalab = '".$namalab."'";
						
		if (mysqli_query($dbsurat,$sql)) {
			echo "data terupdate";
		}else {
			"error ".$mysqli_error($dbsurat);
		}
		
		//cek kalo sudah ada datanya ya di update
		if(empty($nodata)){
		$sql = "INSERT INTO ijinlab (
							tanggal, 
							nim, 
							nama, 
							ttl, 
							alamatasal, 
							alamatmalang, 
							nohp, 
							nohportu, 
							riwayatpenyakit, 
							posisi, 
							prodi, 
							namalab, 
							dosen, 
							tglmulai, 
							tglselesai,
							validatordosen,
							validasidosen,
							tglvalidasidosen,
							validatorjurusan,
							validasijurusan,
							tglvalidasijurusan,
							validatorfakultas,
							validasifakultas,
							tglvalidasifakultas) 
							VALUES (
							'$tanggal',
							'$nim',
							'$nama',
							'$ttl',
							'$alamatasal',
							'$alamatmalang',
							'$nohp',
							'$nohportu',
							'$riwayatpenyakit',
							'$posisi',
							'$prodi',
							'$namalab',
							'$dosen',
							'$tglmulai',
							'$tglselesai',
							'$kddosen',
							1,
							'$tglmulai',
							'$kdkaprodi',
							1,
							'$tglmulai',
							'63007',
							1,
							'$tglmulai'
							)";		
		}else{
		$sql = "UPDATE ijinlab SET
							tanggal = '".$tanggal."',
							ttl = '".$ttl."',
							alamatasal = '".$alamatasal."',
							alamatmalang =  '".$alamatmalang."',
							nohp = '".$nohp."', 
							nohportu = '".$nohportu."',
							riwayatpenyakit = '".$riwayatpenyakit."',
							posisi = '".$posisi."',
							namalab = '".$namalab."', 
							tglmulai = '".$tglmulai."', 
							tglselesai = '".$tglselesai."'
						WHERE no = '".$nodata."'";
		};
		if (mysqli_query($dbsurat,$sql)) {
			echo "data tersimpan";
				mysqli_close($dbsiakad);
				mysqli_close($dbsurat);
				header("location:lab-simpanfinal.php");
		}else {
			echo "error ".$mysqli_error($dbsurat);
			header("location:index.php");
		}
	}  
	
?>