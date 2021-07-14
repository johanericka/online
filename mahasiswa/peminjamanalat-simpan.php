<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$kdjurusan = substr($nim,2,2);
	$kdfakultas = substr($nim,2,1);
  $nama = mysqli_real_escape_string($dbsurat,$_POST['nama']);
  $judulskripsi = mysqli_real_escape_string($dbsurat,$_POST['judulskripsi']);
	
	//cari kode dosen dari nama dosen
	$namadosen = mysqli_real_escape_string($dbsurat,$_POST['namadosen']);
	$sql1 = mysqli_query($dbsiakad,"select kode from useraccount where nama = '".$namadosen."'"); 
	$row = mysqli_fetch_row($sql1); 
		$kddosen = $row[0];
		$dosbing = $namadosen;
	
	//cari kajur
	$sql2 = mysqli_query($dbsurat,"SELECT * FROM pejabat WHERE level = 5 AND kdjurusan = '".$kdjurusan."'"); 
	$row2 = mysqli_fetch_array($sql2); 
		$kdkajur = $row2['iddosen'];
	
	//cari wd1
	$sql = mysqli_query($dbsurat,"SELECT * FROM pejabat WHERE level = 2 AND kdjurusan = 6"); 
	$cekdata = mysqli_num_rows($sql);
	$data = mysqli_fetch_array($sql); 
		$kdwd = $data['iddosen'];
	
	$pimpinaninstansi = mysqli_real_escape_string($dbsurat,$_POST['pimpinaninstansi']);
  $instansi = mysqli_real_escape_string($dbsurat,$_POST['instansi']);
  $alamat = mysqli_real_escape_string($dbsurat,$_POST['alamat']);
	$namaalat = mysqli_real_escape_string($dbsurat,$_POST['namaalat']);
	$jumlahalat = mysqli_real_escape_string($dbsurat,$_POST['jumlahalat']);
  $tanggalmulai = mysqli_real_escape_string($dbsurat,$_POST['tanggalmulai']);
  $tglmulai = date('y-m-d', strtotime($tanggalmulai));
	$tanggalakhir = mysqli_real_escape_string($dbsurat,$_POST['tanggalakhir']);
  $tglakhir = date('y-m-d', strtotime($tanggalakhir));
  
	
	$sql = "insert into peminjamanalat (kdfakultas,
	                                    jurusan, 
																			nim, 
																			nama, 
																			judulskripsi, 
																			dosbing,
                                      pimpinaninstansi,																			
																			instansi, 
																			alamat,
																			namaalat,
																			jumlahalat,
																			tglpeminjamanmulai,
																			tglpeminjamanakhir,
																			validatordosen,
																			validatorjurusan,
																			validatorfakultas) 
			                         values('".$kdfakultas."',
															        '".$kdjurusan."',
															        '".$nim."',
															        '".$nama."',
																			'".$judulskripsi."',
																			'".$dosbing."',
																			'".$pimpinaninstansi."',
																			'".$instansi."',
																			'".$alamat."',
																			'".$namaalat."',
																			'".$jumlahalat."',
																			'".$tglmulai."',
																			'".$tglakhir."',
																			'".$kddosen."',
																			'".$kdkajur."',
																			'".$kdwd."'
																			)";
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data tersimpan";
  }else {
	  echo "error ".$mysqli_error($dbsurat);
  }
	
	//kirim email notifikasi
	
	//cari email dosen pembimbing
	$sql5 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kddosen'");
	$ceksql5 = mysqli_num_rows($sql5);
	if ($ceksql5 > 0){
		$data5 = mysqli_fetch_array($sql5);
			$emaildosen = $data5['email'];
			$kirimemaildosen = $data5['kirimemail'];
			if($kirimemaildosen == 1){
				$subject = "Notifikasi Pengajuan Surat Peminjaman Alat";
				$pesan = "Yth. ".$namadosen."
									<br/>
									<br/>
									Terdapat pengajuan Surat Peminjaman Alat atas nama ".$nama.".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				sendmail($emaildosen,$namadosen,$subject,$pesan);
				}
				
	}
	
	//cari email user
	$sql4 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$nim'");
	$ceksql4 = mysqli_num_rows($sql4);
	//apabila ada email user
	if ($ceksql4 > 0){ 
		$data4 = mysqli_fetch_array($sql4);
			$emailuser = $data4['email'];
			$kirimemailuser = $data4['kirimemail'];
			if($kirimemailuser > 0){
				$subject = "Notifikasi Pengajuan Surat Peminjaman Alat";
				$pesan = "Yth. ".$nama."
									<br/>
									<br/>
									Pengajuan Surat Peminjaman Alat anda sedang menunggu verifikasi dosen pembimbing.
									<br/>
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				sendmail($emailuser,$nama,$subject,$pesan);
			}			
	}
	
	
	/*
	echo "Kode Fakultas = ".$kdfakultas."<br/>";
	echo "Kode Jurusan = ".$kdjurusan."<br/>";
	echo "NIM = ".$nim."<br/>";
  echo "Nama = ".$nama."<br/>";
	echo "Email = ".$emailuser."<br/>";
	echo "Status email user = ".$kirimemailuser."<br/>";
  echo "Judul Skripsi = ".$judulskripsi."<br/>";
  echo "Dosen pembimbing = ".$dosbing."<br/>";
	echo "Kode Dosen = ".$kddosen."<br/>";
	echo "Email Dosen = ".$emaildosen."<br/>";
	echo "Status Email Dosen = ".$kirimemaildosen."<br/>";
	echo "Kode kajur = ".$kdkajur."<br/>";
	echo "Kode WD = ".$kdwd."<br/>";
	echo "Pimpinan Instansi = ".$pimpinaninstansi."<br/>";
  echo "Instansi = ".$instansi."<br/>";
  echo "Alamat = ".$alamat."<br/>";
	echo "Nama alat = ".$namaalat."<br/>";
	echo "Jumlah alat = ".$jumlahalat."<br/>";
  echo "Tgl. Mulai = ".$tanggalmulai."<br/>";
	echo "Tgl. Akhir = ".$tanggalakhir."<br/>";
	*/
	
	mysqli_close($dbsiakad);
	mysqli_close($dbsurat);
  header("location:index.php");
	
?>