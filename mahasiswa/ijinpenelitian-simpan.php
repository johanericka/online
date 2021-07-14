<?php
  require_once('../system/dbconn.php');
  
	$nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$kdjurusan = substr($nim,2,2);
	$kdfakultas = substr($nim,2,1);
  
	//cari nama jurusan
	$query = mysqli_query($dbsurat,"SELECT * FROM jurusan WHERE kdjurusan = '$kdjurusan'");
	$data = mysqli_fetch_array($query);
		$jurusan = $data['jurusan'];
	
	$nama = $_POST['nama'];
  	$judulskripsi = mysqli_real_escape_string($dbsurat,$_POST['judulskripsi']);
	
	//cari kode dosen dari nama dosen
	$namadosen = mysqli_real_escape_string($dbsurat,$_POST['namadosen']);
	$sql1 = mysqli_query($dbsurat,"SELECT kode FROM useraccount2 WHERE nama = '$namadosen'");
	$hasildosen = mysqli_num_rows($sql1);
		$row = mysqli_fetch_row($sql1); 
			$kddosen = $row[0];
			$dosbing = $namadosen;		
	
  $instansi = mysqli_real_escape_string($dbsurat,$_POST['instansi']);
  $alamat = mysqli_real_escape_string($dbsurat,$_POST['alamat']);
  $tglpelaksanaan = date('y-m-d', strtotime($_POST['tanggal']));
	$tglselesai = date('y-m-d', strtotime($_POST['tglselesai']));
	
	//cari kajur
	$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 5 and jurusan = '".$jurusan."'"); 
	$row2 = mysqli_fetch_row($sql2); 
		$kdkajur = $row2[0];
  
	//cari wd1
	$sql = mysqli_query($dbsurat,"select iddosen from pejabat where level = 2 and jurusan = 'SAINTEK'"); 
	$data = mysqli_fetch_row($sql); 
		$kdwd = $data[0];
	
		echo "Judul skripsi = ".$judulskripsi."<br/>";
		echo "Instansi = ".$instansi."<br/>";
		echo "Alamat = ".$alamat."<br/>";
		echo "Hasil Dosen = ".$hasildosen."<br/>";
		echo "Tgl Mulai = ".$tglpelaksanaan."<br/>";
		echo "Tgl Selesai = ".$tglselesai."<br/>";
		

	if (empty($judulskripsi) 
			OR empty($instansi) 
			OR empty($alamat)
			OR $hasildosen == 0
			OR $tglpelaksanaan == 0
			OR $tglselesai == 0
			){
		echo "<script>alert('ERROR!! ada data yang belum terisi, silahkan cek kembali');
		document.location='ijinpenelitian-isi.php'</script>";		
	}else{
	  $sql = "insert into ijinpenelitian (kdfakultas,
										kdjurusan, 
										nim, 
										nama, 
										judulskripsi, 
										dosbing, 
										instansi, 
										alamat, 
										tglpelaksanaan,
										tglselesai,
										validatordosen,
										validatorjurusan,
										validatorfakultas) 
			                         values('".$kdfakultas."',
										    '".$kdjurusan."',
										    '".$nim."',
										    '".$nama."',
											'".$judulskripsi."',
											'".$dosbing."',
											'".$instansi."',
											'".$alamat."',
											'".$tglpelaksanaan."',
											'".$tglselesai."',
											'".$kddosen."',
											'".$kdkajur."',
											'".$kdwd."')";
		if (mysqli_query($dbsurat,$sql)) {
			echo "data tersimpan";
		}else {
			"error ".$mysqli_error($dbsurat);
		}
  
		header("location:index.php");
	}
	
?>