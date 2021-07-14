<?php
	require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
	$nodata = $_POST['nodata']; 	
	$tgl = date('Y-m-d');
	$namalab = $_POST['namalab'];	
	$iduser = $_SESSION['iduser'];
	echo $iduser;
	
	//dapatkan data dari pengajuan mahasiswa
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE no = '$nodata'");
	$data = mysqli_fetch_array($query);
		$nim = $data['nim'];
		$nama = $data['nama'];
		$kdwd = $data['validatorfakultas'];
		$kddosen = $data['validatordosen'];
		$kdkajur = $data['validatorjurusan'];
	
	//cari wd2
	$sql1 = mysqli_query($dbsurat,"SELECT * FROM pejabat WHERE iddosen = '$kdwd'"); 
	$data1 = mysqli_fetch_array($sql1); 
		$namawd = $data1['nama'];
	
	//cari email wd
	$sql3 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kdwd'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0){
		$data3 = mysqli_fetch_array($sql3);
			$emailwd = $data3['email'];
			$kirimemailwd = $data3['kirimemail'];

			if($kirimemailwd == 1){
				$subjectwd = "Notifikasi Pengajuan Ijin Penggunaan Laboratorium";
				$pesanwd = "Yth. ".$namawd."
									<br/>
									<br/>
									Terdapat pengajuan Ijin Penggunaan Laboratorium atas nama ".$nama.".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				//kirim email
				sendmail($emailwd,$namawd,$subjectwd,$pesanwd);
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

			if($kirimemailmhs == 1){
				$subjectmhs = "Notifikasi Pengajuan Ijin Penggunaan Laboratorium";
				$pesanmhs = "Yth. ".$nama."
									<br/>
									<br/>
									Pengajuan Ijin Penggunaan Laboratorium anda telah disetujui oleh Ketua Program Studi.
									<br/>
									Saat ini sedang menunggu persetujuan Wakil Dekan Bidang Akademik.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";

				//kirim email
				sendmail($emailmhs,$nama,$subjectmhs,$pesanmhs);
			}
	}
	
		//update validasi kajur
		mysqli_query($dbsurat,"UPDATE ijinlab
														SET tglvalidasijurusan = '".$tgl."', 
														validasijurusan = '1'
														WHERE no = '".$nodata."'");		
	
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
?>