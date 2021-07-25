<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $nim = mysqli_real_escape_string($dbsurat,$_POST['nim']);
	$id = mysqli_real_escape_string($dbsurat,$_POST['id']);
	$nodata = mysqli_real_escape_string($dbsurat,$_POST['nodata']);
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	//echo "Nim = ".$nim."<br/>";
	//echo "Nodata = ".$nodata."<br/>";
	//echo "Tanggal validasi dosen = ".$tglvaldos."<br/>";
	
	//dapatkan data kajur & mahasiswa
	$qfuery = mysqli_query($dbsurat,"SELECT * FROM peminjamanalat WHERE id='$nodata'");
	$data = mysqli_fetch_array($query);
		$namamhs = $data['nama'];
		$kdkajur = $data['validatorjurusan'];
	
	//dapatkan nama kajur
	$query2 = mysqli_query($dbsurat,"SELECT * FROM pejabat WHERE iddosen = 'kdkajur'");
	$data2 = mysqli_fetch_array($query2);
		$namadosen = $data2['nama'];
	
	//kirim email notifikasi
	
	/*
	//cari email kajur
	$sql5 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kdkajur'");
	$ceksql5 = mysqli_num_rows($sql5);
	if ($ceksql5 > 0){
		$data5 = mysqli_fetch_array($sql5);
			$emaildosen = $data5['email'];
			$kirimemaildosen = $data5['kirimemail'];
			if($kirimemaildosen == 1){
				$subject = "Notifikasi pengajuan Surat Peminjaman Alat";
				$pesan = "Yth. ".$namadosen."
									<br/>
									<br/>
									Terdapat pengajuan Surat Peminjaman Alat atas nama ".$namamhs.".
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
				$pesan = "Yth. ".$namamhs."
									<br/>
									<br/>
									Pengajuan Surat Peminjaman Alat anda telah diverifikasi oleh dosen pembimbing.
									<br/>
									Saat ini sedang menunggu verifikasi dari Ketua Program Studi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				sendmail($emailuser,$nama,$subject,$pesan);
			}			
	}
	*/
	
	//update approval dosen
  $sql = "UPDATE observasi
					SET validasidosen = '1', 
							tglvalidasidosen = '$tglvaldos'
					WHERE id = '$nodata' AND nim = '$nim'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>