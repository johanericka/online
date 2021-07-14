<?php
	require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
	$nodata = $_GET['nodata']; 	
	$tgl = date('Y-m-d');
	$keterangan = mysqli_real_escape_string($dbsurat,$_POST['keterangan']);
	$namalab = $_POST['namalab'];
	
	//cari data mahasiswa
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE no = '$nodata'");
	$data = mysqli_fetch_array($query);
		$nim = $data['nim'];
		$nama = $data['nama'];
		
	//cari email mahasiswa
	$sql4 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$nim'");
	$ceksql4 = mysqli_num_rows($sql4);
	//apabila ada email user
	if ($ceksql4 > 0){ 
		$data4 = mysqli_fetch_array($sql4);
			$emailmhs = $data4['email'];
			$kirimemailmhs = $data4['kirimemail'];
			//apabila status kirim email = 1
			if($kirimemailmhs == 1){
				$subjectmhs = "Notifikasi Pengajuan Ijin Penggunaan Laboratorium";
				$pesanmhs = "Yth. ".$nama."
									<br/>
									<br/>
									Pengajuan Ijin Penggunaan Laboratorium anda DITOLAK oleh Ketua Program Studi dengan alasan ".$keterangan."
									<br/>
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				//kirim email
				sendmail($emailmhs,$nama,$subjectmhs,$pesanmhs);
			}
	}
	
	
	if (!empty($keterangan)){
		$sql = mysqli_query($dbsurat,"UPDATE ijinlab
																	SET tglvalidasijurusan = '$tgl', 
																	validasijurusan = '2',
																	keterangan = '$keterangan'
																	where no = '$nodata'");
	
		
		//update kapasitas lab
		$sql2 = mysqli_query($dbsurat,"UPDATE laboratorium
																	SET kapasitas = kapasitas + 1 
																	WHERE namalab = '$namalab'");
	
		
		mysqli_close($dbsurat);
		
		header("location:index.php");
	}else{
		header("location:lab-tampil.php?nodata=$nodata&respon=kosong");
	}
	
?>