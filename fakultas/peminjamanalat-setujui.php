<?php
  require_once('../system/dbconn.php');
	require_once('../system/phpmailer/sendmail.php');
	
  $nim = $_POST['nim'];
	$id = $_POST['id'];
	$nodata = $_POST['nodata'];
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	echo "Nim = ".$nim."<br/>";
	echo "Nodata = ".$nodata."<br/>";
	echo "Tanggal validasi dosen = ".$tglvaldos."<br/>";
	
	$tgl = date('Y-m-d',strtotime(now));
	$bulan = date('m', strtotime(now));
	$tahun = date('Y', strtotime(now));
	$nosurat = "B-".$nodata.".O/FST.1/TL.00/".$bulan."/".$tahun."";
	
	//dapatkan nama mahasiswa
	$query = mysqli_query($dbsurat,"SELECT * FROM peminjamanalat WHERE id='$nodata'");
	$data = mysqli_fetch_array($query);
		$namamhs = $data['nama'];
	
	//update approval dosen
  $sql = "UPDATE peminjamanalat
					SET validasifakultas = '1', 
							tglvalidasifakultas = '$tglvaldos',
							keterangan = '$nosurat'
					WHERE id = '$nodata' AND nim = '$nim'";
					
  if (mysqli_query($dbsurat,$sql)) {
	  echo "data terupdate";
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
										Pengajuan Surat Peminjaman Alat anda telah disetujui oleh Wakil Dekan bidang Akademik dengan No. Surat ".$nosurat.".
										<br/>
										Silahkan mengakses sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a> untuk mencetak surat anda.
										<br/>
										Disarankan menggunakan komputer yang memiliki <a href='https://www.makeuseof.com/tag/7-best-tools-print-pdf/' target='_blank'>printer PDF</a> 
										<br/>
										<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
					sendmail($emailuser,$namamhs,$subject,$pesan);
				}			
		}
  }else {
	  "error ".$mysqli_error($dbsurat);
  }
	
	mysqli_close($dbsurat);
	
  header("location:index.php");
	
?>