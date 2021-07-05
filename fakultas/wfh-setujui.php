<?php
	require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
	$nodata = $_POST['nodata']; 	
	$jabatan = $_POST['jabatan'];
	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = $nodata.".O/FST.2/KP.01.4/".$bulan."/".$tahun."";
	
	
	if ($jabatan == "Ketua Program Studi" or $jabatan="Kepala Bagian"){
		$sql = "update wfh
					set tglverifikasifakultas = '".$tgl."', 
					tglverifikasijurusan = '".$tgl."', 
					verifikasifakultas = '1',
					verifikasijurusan = '1',
					keterangan = '".$nosurat."'
					where no = '".$nodata."'";
	}else{
		$sql = "update wfh
					set tglverifikasifakultas = '".$tgl."', 
					verifikasifakultas = '1',
					keterangan = '".$nosurat."'
					where no = '".$nodata."'";
	}
	
	if (mysqli_query($dbsurat,$sql)) {
		echo "data terupdate";
	}else {
		"error ".$mysqli_error($dbsurat);
	}
	
	//dapatkan data user
	$query = mysqli_query($dbsurat,"SELECT * FROM wfh WHERE no='$nodata'");
	$data = mysqli_fetch_array($query);
		$iduser = $data['iduser'];
		$nama = $data['nama'];
		$kdkajur = $data['verifikatorjurusan'];
	
	
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
									Pengajuan ijin <i>Work From Home</i> anda sudah disetujui oleh Wakil Dekan Bidang AUPK.
									<br/>
									Silahkan mencetak Rencana Kerja dan Surat Tugas anda di program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				//kirim email
				sendmail($email,$nama,$subject,$pesan);
			}
	}
		
	mysqli_close($dbsurat);
	header("location:index.php");
?>