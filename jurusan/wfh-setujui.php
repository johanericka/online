<?php
	require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
	$nodata = $_GET['nodata']; 	
	$tgl = date('Y-m-d');
	
	//dapatkan data user
	$query = mysqli_query($dbsurat,"SELECT * FROM wfh WHERE no='$nodata'");
	$data = mysqli_fetch_array($query);
		$iduser = $data['iduser'];
		$nama = $data['nama'];
		$kdwd = $data['verifikatorfakultas'];
	
	//cari wd2
	$sql = mysqli_query($dbsurat,"select * from pejabat where level = 3 and jurusan = 'SAINTEK'"); 
	$data = mysqli_fetch_array($sql); 
		$kdwd = $data['iddosen'];
		$namawd = $data['nama'];
	
	//cari email wd2
	$sql3 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kdwd'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0){
		$data3 = mysqli_fetch_array($sql3);
			$email = $data3['email'];
			$kirimemail = $data3['kirimemail'];
			if($kirimemail > 0){
				$subject = "Notifikasi Pengajuan Ijin Work From Home";
				$pesan = "Yth. ".$namawd."
									<br/>
									<br/>
									Terdapat pengajuan ijin <i>Work From Home</i> atas nama ".$nama." pada tanggal ".tgl_indo($tgl).".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				echo $pesan."<br/>";
				
				//kirim email
				sendmail($email,$nama,$subject,$pesan);
				}
	}
	
	
	//cari email user
	$sql4 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$iduser'");
	$ceksql4 = mysqli_num_rows($sql4);
	//apabila ada email user
	if ($ceksql4 > 0){ 
		$data4 = mysqli_fetch_array($sql4);
			$email = $data4['email'];
			$kirimemail = $data4['kirimemail'];
			//apabila status kirim email = 1
			if($kirimemail > 0){
				$subject = "Notifikasi Pengajuan Ijin Work From Home";
				$pesan = "Yth. ".$nama."
									<br/>
									<br/>
									Pengajuan ijin <i>Work From Home</i> anda sudah disetujui oleh atasan.
									<br/>
									Saat ini pengajuan ijin <i>Work From Home</i> anda sedang menunggu verifikasi Wakil Dekan Bidang AUPK.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				echo $pesan."<br/>";
				//kirim email
				sendmail($email,$nama,$subject,$pesan);
			}
	}
	
  
	
	$sql = "update wfh
					set tglverifikasijurusan = '".$tgl."', 
					verifikasijurusan = '1'
					where no = '".$nodata."'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
	/*
	echo "NO Data = ".$nodata."<br/>";
	echo "Tanggal = ".$tgl."<br/>";
	echo "ID User = ".$iduser."<br/>";
	echo "Nama = ".$nama."<br/>";
	echo "Kode WD = ".$kdwd."<br/>";
	echo "Nama WD = ".$namawd."<br/>";
	*/
	
	function tgl_indo($tanggal){
			$bulan = array (
			1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
			);
			$pecahkan = explode('-', $tanggal);
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
?>