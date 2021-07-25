<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $nim = $_POST['nim'];
	$nodata = $_POST['nodata'];
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	
  $sql = "UPDATE suket 
					SET validasidosen = 1, 
							tglvalidasidosen = '$tglvaldos' 
					WHERE id = '$nodata' AND nim = '$nim'";
					
  if (mysqli_query($dbsurat,$sql)) {
	 //cari kode kajur
		$sql2 = mysqli_query($dbsurat,"SELECT * FROM suket WHERE id = '$nodata'");
		$data2 = mysqli_fetch_array($sql2);
			$kdkajur = $data2['validatorjurusan'];
		
	  //kirim email
		$sql3 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kdkajur'");
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
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
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