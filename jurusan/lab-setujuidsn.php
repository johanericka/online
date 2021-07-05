<?php
	require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
	$nodata = $_POST['nodata']; 	
	$tgl = date('Y-m-d');
	$namalab = $_POST['namalab'];	
	
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE no='$nodata'");
	$data = mysqli_fetch_array($query);
		$nim = $data['nim'];
		$nama = $data['nama'];
		$kdkajur = $data['validatorjurusan'];
	
	//cari kajur
	$sql0 = mysqli_query($dbsurat,"select * from pejabat where level = 5 and jurusan = '".$jurusan."'"); 
	$data0 = mysqli_fetch_array($sql0); 
		$kdkajur = $data0['iddosen'];
		$namakajur = $data0['nama'];
	
	//cari email kajur
	$sql3 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kdkajur'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0){
		$data3 = mysqli_fetch_array($sql3);
			$emailkajur = $data3['email'];
			$kirimemailkajur = $data3['kirimemail'];
			echo "Email kajur = ".$emailkajur."<br/>";
			echo "Kirim Email kajur = ".$kirimemailkajur."<br/>";
			if($kirimemailkajur == 1){
				$subjectkajur = "Notifikasi Pengajuan Ijin Penggunaan Laboratorium";
				$pesankajur = "Yth. ".$namakajur."
									<br/>
									<br/>
									Terdapat pengajuan Ijin Penggunaan Laboratorium atas nama ".$nama.".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				echo "Pesan Email Kajur = ".$pesankajur."<br/>";
				//kirim email
				sendmail($emailkajur,$namakajur,$subjectkajur,$pesankajur);
				}
	}
	
	//cari email mahasiswa
	$sql4 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$nim'");
	$ceksql4 = mysqli_num_rows($sql4);
	//apabila ada email user
	if ($ceksql4 > 0){ 
		$data4 = mysqli_fetch_array($sql4);
			$emailmhs = $data4['email'];
			$kirimemailmhs = $data4['kirimemail'];
			echo "Email Mhs = ".$emailmhs."<br/>";
			echo "Kirim Email Mhs = ".$kirimemailmhs."<br/>";
			//apabila status kirim email = 1
			if($kirimemailmhs == 1){
				$subjectmhs = "Notifikasi Pengajuan Ijin Penggunaan Laboratorium";
				$pesanmhs = "Yth. ".$nama."
									<br/>
									<br/>
									Pengajuan Ijin Penggunaan Laboratorium anda telah disetujui oleh Dosen Pembimbing.
									<br/>
									Saat ini sedang menunggu persetujuan Ketua Program Studi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				echo "Pesan Email Mahasiswa = ".$pesanmhs."<br/>";
				//kirim email
				sendmail($emailmhs,$nama,$subjectmhs,$pesanmhs);
			}
	}
	
	
	//update validasi dosen
	$sql = "UPDATE ijinlab
					SET tglvalidasidosen = '".$tgl."', 
					validasidosen = '1'
					WHERE no = '".$nodata."'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
?>