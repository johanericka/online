<?php
  require_once('../system/dbconn.php');
  require_once('../system/phpmailer/sendmail.php');
	
	$nim = $_POST['nim'];
	$id = $_POST['id'];
	$nodata = $_POST['nodata'];
	$keterangan = mysqli_real_escape_string($dbsurat,$_POST['keterangan']);
	$tglvaldos = date('y-m-d H:i:s', strtotime(now));
	echo "Nim = ".$nim."<br/>";
	echo "ID = ".$id."<br/>";
	echo "Tanggal validasi dosen = ".$tglvaldos."<br/>";
	
	//dapatkan nama mahasiswa
	$query = mysqli_query($dbsurat,"SELECT * FROM peminjamanalat WHERE id='$nodata'");
	$data = mysqli_fetch_array($query);
		$namamhs = $data['nama'];
	
	

	if (!empty($keterangan)){
		$sql = "UPDATE peminjamanalat
						SET validasijurusan = '2', 
								tglvalidasijurusan = '$tglvaldos',
								keterangan = '$keterangan'
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
											Mohon maaf, pengajuan Surat Peminjaman Alat anda ditolak oleh Ketua Program Studi dengan alasan ".$keterangan.".
											<br/>
											<br/>
											<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada sistem <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
						sendmail($emailuser,$namamhs,$subject,$pesan);
					}			
			}
	  }else {
		  echo "error ".$mysqli_error($dbsurat);
	  }
	  mysqli_close($dbsurat);
    header("location:index.php");
	}else{
		echo "Keterangan kosong";
		header("location:peminjamanalat-tampil.php?nodata=$nodata&respon=kosong");
	}
?>