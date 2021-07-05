<?php
require_once('../system/dbconn.php');
require_once('../system/phpmailer/sendmail.php');

$iduser = mysqli_real_escape_string($dbsurat, $_POST['iduser']);
$nama = mysqli_real_escape_string($dbsurat, $_POST['nama']);
$nip = mysqli_real_escape_string($dbsurat, $_POST['nip']);
$jabatan = mysqli_real_escape_string($dbsurat, $_POST['jabatan']);
$jurusan = mysqli_real_escape_string($dbsurat, $_POST['jurusan']);
$fakultas = mysqli_real_escape_string($dbsurat, $_POST['fakultas']);
$tglsurat = date('Y-m-d');
$tgl1 = mysqli_real_escape_string($dbsurat, $_POST['tgl1']);
//$kegiatan1 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan1']);
$tgl2 = mysqli_real_escape_string($dbsurat, $_POST['tgl2']);
//$kegiatan2 = mysqli_real_escape_string($dbsurat, $_POST['kegiatan2']);


//cari kajur
if ($iduser != '61018') {
	$sql0 = mysqli_query($dbsurat, "select * from pejabat where level = 5 and jurusan = '" . $jurusan . "'");
	$data0 = mysqli_fetch_array($sql0);
	$kdkajur = $data0['iddosen'];
	$namakajur = $data0['nama'];
} else {
	//khusus pak Anas
	$sql0 = mysqli_query($dbsurat, "select * from pejabat where level = 5 and jurusan = 'SAINTEK'");
	$data0 = mysqli_fetch_array($sql0);
	$kdkajur = $data0['iddosen'];
	$namakajur = $data0['nama'];
};

//cari wd2
$sql1 = mysqli_query($dbsurat, "select * from pejabat where level = 3 and jurusan = 'SAINTEK'");
$data1 = mysqli_fetch_array($sql1);
$kdwd = $data1['iddosen'];
$namawd = $data1['nama'];

/*
	echo "ID USer = ".$iduser."<br/>";
  	echo "Nama = ".$nama."<br/>";
	echo "NIP = ".$nip."<br/>";
	echo "Jabatan = ".$jabatan."<br/>";
  	echo "Program Studi = ".$jurusan."<br/>";
	echo "Fakultas = ".$fakultas."<br/>";
  	echo "Tanggal 1 = ".$tgl1."<br/>";
	echo "Kegiatan 1 = ".$kegiatan1."<br/>";
	echo "Tanggal 2 = ".$tgl2."<br/>";
	echo "Kegiatan 2 = ".$kegiatan2."<br/>";
	echo "Kode Kajur = ".$kdkajur."<br/>";
	echo "Nama Kajur = ".$namakajur."<br/>";
	echo "Kode WD = ".$kdwd."<br/>";
	echo "Nama WD = ".$namawd."<br/>";
	*/

//simpan ke table wfh
/*
$sql = "insert into wfh (fakultas, jurusan, tglsurat, iduser, nama, nip, jabatan, tglwfh1, tglwfh2, verifikatorjurusan, verifikasijurusan, verifikatorfakultas, verifikasifakultas) 
				values ('$fakultas','$jurusan','$tglsurat','$iduser','$nama','$nip','$jabatan','$tgl1','$tgl2','$kdkajur',0,'$kdwd',0)";
if (mysqli_query($dbsurat, $sql)) {
	header("location:index.php");
} else {
	echo "error " . $mysqli_error($dbsurat);
	//header("location:wfh-isi.php");
}
*/

//simpan ke table wfh_keternagan
while (strtotime($tgl1) <= strtotime($tgl2)) {
	$kegiatan = $_POST[strtotime($tgl1)];
	//echo $kegiatan;
	//$sql2 = "insert into wfh_keterangan (nip,tglwfh,keterangan) values ('$nip','')"
	$tgl1 = date("Y-m-d", strtotime("+1 days", strtotime($tgl1)));
}

/*
	//cari email kajur
	$sql3 = mysqli_query($dbsurat,"SELECT * FROM notifikasi WHERE iduser = '$kdkajur'");
	$ceksql3 = mysqli_num_rows($sql3);
	if ($ceksql3 > 0){
		$data3 = mysqli_fetch_array($sql3);
			$email = $data3['email'];
			$kirimemail = $data3['kirimemail'];
			
			if($kirimemail > 0){
				$subject = "Notifikasi Pengajuan Ijin Work From Home";
				$pesan = "Yth. ".$namakajur."
									<br/>
									<br/>
									Terdapat pengajuan ijin <i>Work From Home</i> atas nama ".$nama." pada tanggal ".tgl_indo($tglsurat).".
									<br/>
									Silahkan akses sistem perijinan online <a href='https://saintek.uin-malang.ac.id/online' target='_blank'><b>di sini</b></a> untuk melakukan verifikasi.
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				
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
									Pengajuan ijin <i>Work From Home</i> anda sedang menunggu verifikasi atasan.
									<br/>
									<br/>
									<small><i>email notifikasi ini dapat di non-aktifkan dari menu Notifikasi pada program <a href='https://saintek.uin-malang.ac.id/online' target='_blank'>SAINTEK Online</a>.</i></small>";
				//kirim email
				sendmail($email,$nama,$subject,$pesan);
			}
	}
	*/