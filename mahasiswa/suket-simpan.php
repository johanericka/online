<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	if (strlen($nim)==8){
		$kdjurusan = substr($nim,2,2);
		$kdfakultas = substr($nim,2,1);
	}else{
		$kdjurusan = substr($nim,2,5);	
		$kdfakultas = substr($nim,2,2);
	}
  $nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
  $jurusan = mysqli_real_escape_string($dbsurat,$_POST['jurusan']);
  $jenissurat = mysqli_real_escape_string($dbsurat,$_POST['jenissurat']);
  $keperluan = mysqli_real_escape_string($dbsurat,$_POST['keperluan']);
  $buktispp = mysqli_real_escape_string($dbsurat,$_POST['buktispp']);
  $infobeasiswa = mysqli_real_escape_string($dbsurat,$_POST['infobeasiswa']);
	$lokasifile = mysqli_real_escape_string($dbsurat,$_POST['lokasifile']);
  
	/*
	//cari kode dosen dari nama dosen
	$dosen = mysqli_real_escape_string($dbsurat,$_POST['dosen']);
	$sql1 = mysqli_query($dbsiakad,"select * from useraccount where nama = '".$dosen."'");
		$row = mysqli_fetch_row($sql1); 
			$kddosen = $row[0];
			$namadosen = $row[1];
	*/
	
	$kddosen = '00000';
	$validasidosen='1';
	
	//cari kajur
	$sql2 = mysqli_query($dbsurat,"select iddosen from pejabat where level = 5 and jurusan = '".$jurusan."'"); 
	$row2 = mysqli_fetch_row($sql2); 
		$kdkajur = $row2[0];
	
	//cari wd3
	$sql = mysqli_query($dbsurat,"select iddosen from pejabat where level = 4 and jurusan = 'SAINTEK'"); 
	$data = mysqli_fetch_row($sql); 
		$kdwd = $data[0];
	
  $sql = "insert into suket (
	                           kdfakultas,
														 kdjurusan, 
														 nim, 
														 nama, 
														 jurusan, 
														 jenissurat, 
														 keperluan,
														 validatordosen,
														 validasidosen,
														 validatorjurusan,
														 validatorfakultas
														) 
			                values('".$kdfakultas."',
											       '".$kdjurusan."',
														 '".$nim."',
														 '".$nama."',
														 '".$jurusan."',
														 '".$jenissurat."',
														 '".$keperluan."',
														 '".$kddosen."',
														 '".$validasidosen."',
														 '".$kdkajur."',
														 '".$kdwd."'
														)";
	
  if (mysqli_query($dbsurat,$sql)) {
		//kirim email
		$sql3 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kddosen'");
		$ceksql3 = mysqli_num_rows($sql3);
		if ($ceksql3 > 0){
			$data3 = mysqli_fetch_array($sql3);
				$email = $data3['email'];
				$kirimemail = $data3['kirimemail'];
				
				if($kirimemail > 0){
					$subject = "Notifikasi Pengajuan Surat Keterangan / Rekomendasi";
					$pesan = "Yth. ".$namadosen."
										<br/>
										<br/>
										Terdapat pengajuan ".$jenissurat." atas nama ".$nama." pada tanggal ".tgl_indo($tglsurat).".
										<br/>
										Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
										<br/>
										<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
					
					//kirim email
					sendmail($email,$nama,$subject,$pesan);
					}
		}
	
		mysqli_close($dbsurat);
		mysqli_close($dbsiakad);
		header("location:index.php");
  }else {
	  //header("location:suket-isi.php");
		echo mysqli_error($dbsurat);
  }
  
?>

<!-- tanggal indonesia -->
	<?php
    function tgl_indo($tanggal){
        $bulan = array (
        1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
	?>