<?php

	require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
	$nodata = $_POST['nodata']; 	
	$tgl = date('Y-m-d');
	$namalab = $_POST['namalab'];	
	echo "nodata = ".$nodata;
	echo "namalab = ".$namalab;
	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = "B-".$nodata.".O/FST/PP.00.9/".$bulan."/".$tahun."";
	
	$query = mysqli_query($dbsurat,"SELECT * FROM ijinlab WHERE no = '$nodata'");
	$data = mysqli_fetch_array($query);
		$nim = $data['nim'];
		$nama = $data['nama'];
		echo "NIM = ".$nim."<br/>";
		echo "Nama = ".$nama."<br/>";
	
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
									Pengajuan Ijin Penggunaan Laboratorium anda telah disetujui oleh Wakil Dekan bidang Akademik dengan no. Surat ".$nosurat.".
									<br/>
									Silahkan mengakses <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small> untuk mencetak Surat Ijin & ID Card anda.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				echo "Pesan Email Mahasiswa = ".$pesanmhs."<br/>";
				//kirim email
				sendmail($emailmhs,$nama,$subjectmhs,$pesanmhs);
			}
	}
	
	//update validasi dosen
	$sql = "UPDATE ijinlab
					SET tglvalidasifakultas = '".$tgl."', 
					validasifakultas = '1',
					keterangan = '$nosurat',
					status = 1
					WHERE no = '".$nodata."'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
	header("location:index.php");
	
?>